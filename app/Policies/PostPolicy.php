<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        
    }

    public function view(User $user, Post $post): bool
    {
        return $user->hasRole('Super Admin') || $post->user()->is($user);
    }

    public function show(User $user, Post $post): bool
    {
        return $user->hasRole('Super Admin') || $post->user()->is($user);
    }

    public function edit(User $user, Post $post): bool
    {
        return $user->hasRole('Super Admin') || $post->user()->is($user);
    }

    public function delete(User $user, Post $post) {
        return $user->hasRole('Super Admin') || $post->user()->is($user);
    }
}
