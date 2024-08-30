<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        
    }

    public function edit(User $user, Comment $comment) {
        return $user->hasRole('Super Admin') || $comment->user()->is($user);
    }

    public function delete(User $user, Comment $comment) {
        return $user->hasRole('Super Admin') || $comment->user()->is($user);
    }
}
