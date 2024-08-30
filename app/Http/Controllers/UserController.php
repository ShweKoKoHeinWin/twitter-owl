<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helper\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($search = request()->query('search')) {
            $users = User::with(['posts.likes', 'posts.dislikes'])->where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%")->get();
        } else {
            // Load all users along with their posts, likes, and dislikes
            $users = User::with(['posts.likes', 'posts.dislikes'])->get();
        }
       

        // Initialize arrays to store total likes and dislikes for each user
        $totalLikesPerUser = [];
        $totalDislikesPerUser = [];

        // Iterate over all users
        foreach ($users as $user) {
            // Calculate total likes for the user
            $totalLikesCount = $user->posts->flatMap(function ($post) {
                return $post->likes;
            })->count();

            // Calculate total dislikes for the user
            $totalDislikesCount = $user->posts->flatMap(function ($post) {
                return $post->dislikes;
            })->count();

            // Store total likes and dislikes counts for the user
            $totalLikesPerUser[$user->id] = $totalLikesCount;
            $totalDislikesPerUser[$user->id] = $totalDislikesCount;
        }

        return view('user.index', compact('users', 'totalLikesPerUser', 'totalDislikesPerUser'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * 
     */
    public function show(User $user)
    {
        if(Auth::user()->hasPermissionTo('admin user show')){
            return redirect()->route('admin.user.show', $user);
        }
        $user->load(['posts.likes', 'posts.dislikes']);

        $likesCount = $user->posts->flatMap(function ($post) {
            return $post->likes;
        })->count();

        $dislikesCount = $user->posts->flatMap(function ($post) {
            return $post->dislikes;
        })->count();

        return view('user.profile', compact('user', 'likesCount', 'dislikesCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.profile_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'image' => "nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=150,min_height=150,ratio=1/1",
            'name' => ['required', 'max:30'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
                function ($attribute, $value, $fail) use ($request, $user) {
                    // Check if the email is being changed
                    if ($value !== $user->email) {
                        // Validate the password
                        if (!Hash::check($request->password, $user->password)) {
                            $fail('The provided password is incorrect.');
                        }
                    }
                },
            ],
        ]);

        if($request->hasFile('image')) {
            if($user->image) {
                ImageHelper::delete($user->image);
                
                // Delete Old img in db
                $user->image()->delete();
            }

            ImageHelper::createImage($user, 'image', $request->file('image'), 'profile');
        }

        $user->email = $validated['email'];
        $user->save();

        return redirect()->route('profile', $user)->with('alert-success', 'Profile updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
