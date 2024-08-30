<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
         // Get the route name
         $routeName = $request->route()->getName();

         // Define custom messages for specific routes
         $messages = [
             'profile' => 'You need to login to see the user profile.',
             'profile.edit' => 'You need to login to edit the profile.',

             'user.follow' => 'Please login to follow the user.',

             'post.create' => 'Please Login to create a post.',
             'post.show' => 'Please Login to see the post.',
             'post.edit' => 'Please Login to edit a post.',
             'post.delete' => 'Please Login to delete a post.',
             // Add more routes and messages as needed
         ];
 
         // Check if the route has a custom message
         if (array_key_exists($routeName, $messages)) {
            session()->flash('alert-warning' ,$messages[$routeName]);
             return $request->expectsJson() ? null : route('login');
         }
 
        return $request->expectsJson() ? null : route('login');
    }
}
