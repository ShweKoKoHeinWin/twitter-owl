<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use App\Models\Image;
use App\Helper\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($search = request()->query('search')) {
            // $posts = Post::where('title', 'LIKE', "%$search%")
            //             ->orWhere('content', 'LIKE', "%$search%")
            //             ->paginate();

            $posts = Post::whereAny([
                'title',
                'content'
            ], 'LIKE', "%$search%")->paginate();
        } else {
            $posts = Post::with('user', 'images', 'likes', 'dislikes')->paginate(8);
        }
        
        return view('post.index', compact('posts'));
    }

    /**
     * Display a listing of the resource by user.
     */
    public function postsByUser(User $user) {
        $posts = $user->posts()->paginate();
         
        return view('post.byuser', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable',
            'content' => 'nullable',
            'privacy' => ['required', 'string', Rule::in(['public', 'friends', 'only_me'])],
            'images' => 'array',
            'images.*' => ["mimes:jpeg,png,jpg", "max:2048"],
            'title' => 'required_without_all:content,images',
        ], [
            'title.required_without_all' => 'Please upload an image or provide a title.',
        ]);

        $post = Auth::user()->posts()->create($validated);
        
        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                ImageHelper::createImage($post, 'images', $image, 'post');
            }
            
        }

        return redirect()->route('home')->with('alert-success', 'Post created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        $old_images_ids = $post->images->pluck('id')->toArray();

        $validated = $request->validate([
            'title' => 'nullable',
            'content' => 'nullable',
            'privacy' => ['required', 'string', Rule::in(['public', 'friends', 'only_me'])],
            'images' => 'array',
            'images.*' => ["mimes:jpeg,png,jpg", "max:2048"],
            'deleted_img_idxs' => ['nullable', 'array'],
            'deleted_img_idxs.*' => ['integer'],
            'title' => [function ($attribute, $value, $fail) use ($old_images_ids) {
                if (empty($value) && empty(request('content')) && empty(request('images')) && (request('deleted_img_idxs')) == $old_images_ids) {
                    $fail('Please upload an image or provide a title.');
                }
            }]
        ]);

        if($request->has('deleted_img_idxs')) {
            foreach($validated['deleted_img_idxs'] as $id) {
                $img = Image::find($id);
                
                ImageHelper::delete($img);
            }
        }

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                ImageHelper::createImage($post, 'images', $image, 'post');
            } 
        }

        $post->update($validated);

        return redirect()->back()->with('alert-success', 'Post updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        if($post->images) {
            foreach($post->images as $image) {
                ImageHelper::delete($image);
            }
        }
        $post->delete();
        if($post->comments->isNotEmpty()) {
            foreach($post->comments as $comment) {
                (new CommentController)->recursive($comment);
                $comment->delete();
            }
        }
        return redirect()->route('home')->with('alert-success', "Post and its related media data are deleted successfully");
    }
}
