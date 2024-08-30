<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Post $post) {
        $unlike = $post->dislikes->where('user_id', auth()->user()->id);

        if($unlike->isNotEmpty()) {
            $unlike->firstOrFail()->delete();
        }
        $post->likes()->create([
            'user_id' => Auth::user()->id,
            'like' => 1
        ]);

        return redirect()->route('post.show', $post)->with('alert-success', 'Liked the post successfully.');
    }

    public function unlike(Post $post, Like $like) {
        if(!($like->post->is($post) && $like->user->is(Auth::user()))) {
            return redirect()->back()->with('alert-fail', 'Invalid Action');
        }
        $like->delete();
        return redirect()->route('post.show', $post)->with('alert-success', 'Unliked the post successfully.');
    }

    public function dislike(Post $post) {
        $like = $post->likes->where('user_id', auth()->user()->id);
        if($like->isNotEmpty()) {
            $like->firstOrFail()->delete();
        }
        $post->dislikes()->create([
            'user_id' => Auth::user()->id,
            'like' => 0
        ]);

        return redirect()->route('post.show', $post)->with('alert-success', 'Disliked the post successfully.');
    }

    public function undislike(Post $post, Like $like) {
        if(!($like->post->is($post) && $like->user->is(Auth::user()))) {
            return redirect()->back()->with('alert-fail', 'Invalid Action');
        }
        $like->delete();

        return redirect()->route('post.show', $post)->with('alert-success', 'Undisliked the post successfully.');
    }
}
