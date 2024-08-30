<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment(Post $post) {
        $validated = request()->validate([
            'comment' => ['required', 'max:500']
        ]);
        $this->createComment($post, $validated['comment']);
        return redirect()->route('post.show', $post)->with('alert-success', 'Commented Successfully.');
    }

    public function commentComment(Comment $comment) {
        $validated = request()->validate([
            'comment' => ['required', 'max:500']
        ]);
        $this->createComment($comment, $validated['comment']);
        return redirect()->back()->with('alert-success', 'Commented Successfully.');
    }

    protected function createComment($model, $comment) {
        $model->comments()->create(['comment' => $comment, 'user_id' => Auth::user()->id]);
    }

    public function edit(Post $post, Comment $comment) {
        $route = 'post.comments.update';
        return view('comment.edit', compact('post', 'comment', 'route'));
    }

    public function update(Post $post, Comment $comment) {
        $validated = request()->validate([
            'comment' => ['required', 'max:500']
        ]);

        $comment->update($validated);
        return redirect()->route('post.show', $post)->with('alert-success', "Updated Comment Successfully.");
    }

    public function destroy(Post $post, Comment $comment) {
        $this->recursive($comment);
        $comment->delete();
        return redirect()->route('post.show', $post)->with('alert-success', "Delete Comment Successfully.");
    }

    // as long as a comment has relative comments it will delete all
    public function recursive(Comment $comment) {
        if($comment->comments->isNotEmpty()) {
            foreach($comment->comments as $item) {
                $item->delete();
                $this->recursive($item);
            }
        }
    }
}