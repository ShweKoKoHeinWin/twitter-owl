<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::group(['middleware' => 'auth'], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Users
    Route::get('/user/{user}', [UserController::class, 'show'])->name('profile');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('profile.edit')->can('edit', 'user');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('profile.update')->can('edit', 'user');

    // User Follow
    Route::post('/user/{user}/follow', [FollowerController::class, 'follow'])->name('user.follow');

    // Posts
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts' , [PostController::class, 'store'])->name('post.store');
    Route::get('/posts/{post}' , [PostController::class, 'show'])->name('post.show');
    Route::get('/posts/{post}/edit' , [PostController::class, 'edit'])->name('post.edit')->can('edit', 'post');
    Route::put('/posts/{post}' , [PostController::class, 'update'])->name('post.update')->can('edit', 'post');
    Route::delete('/posts/{post}' , [PostController::class, 'destroy'])->name('post.delete')->can('delete', 'post');
    Route::get('/user/{user}/posts', [PostController::class, 'postsByUser'])->name('user.posts')->can('userPosts', 'user');

    // Post Like Dislike
    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('post.like');
    Route::post('/posts/{post}/unlike/{like}', [LikeController::class, 'unlike'])->name('post.unlike');
    Route::post('/posts/{post}/undislike/{like}', [LikeController::class, 'undislike'])->name('post.undislike');
    Route::post('/posts/{post}/dislike', [LikeController::class, 'dislike'])->name('post.dislike');

    // Post Comment
    Route::get('/posts/{post}/comments', [CommentController::class, 'index'])->name('post.comments');
    Route::get('/posts/{post}/comments/create', [CommentController::class, 'create'])->name('post.comments.create');
    Route::post('/posts/{post}/comments', [CommentController::class, 'postComment'])->name('post.comments.store');
    Route::post('/comments/{comment}/comments', [CommentController::class, 'commentComment'])->name('comment.comments.store');
    
    Route::get('/posts/{post}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('post.comments.edit')->can('edit', 'comment');;
    // Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::post('/posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('post.comments.update')->can('edit', 'comment');;
    Route::get('/posts/{post}/comments/{comment}', [CommentController::class, 'show'])->name('post.comments.show');
    // Route::post('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('post.comments.delete')->can('delete', 'comment');;

    Route::group(['prefix' => 'admin', 'middleware' => 'permission:admin dashboard'], function() {
        Route::group(['middleware' => 'permission:admin users'], function() {
            Route::get('/users', [AdminController::class, 'index'])->name('admin.user');
            Route::get('/users/create', [AdminController::class, 'create'])->name('admin.user.create');
            Route::post('/users', [AdminController::class, 'store'])->name('admin.user.store');
            Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.user.edit');
            Route::put('/users/{user}', [AdminController::class, 'update'])->name('admin.user.update');
            Route::get('/users/{user}', [AdminController::class, 'show'])->name('admin.user.show');
            Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('admin.user.delete');
        });

        Route::group(['middleware' => 'permission:admin roles'], function() {
            Route::get('/roles', [RoleController::class, 'index'])->name('admin.role');
            Route::get('/roles/create', [RoleController::class, 'create'])->name('admin.role.create');
            Route::post('/roles', [RoleController::class, 'store'])->name('admin.role.store');
            Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.role.edit');
            Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.role.update');
            Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('admin.role.delete');  
        });

        Route::group(['middleware' => 'permission:admin permissions'], function() {
            Route::get('/permissions', [PermissionController::class, 'index'])->name('admin.permission');
            Route::get('/permissions/create', [PermissionController::class, 'create'])->name('admin.permission.create');
            Route::post('/permissions', [PermissionController::class, 'store'])->name('admin.permission.store');
            Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('admin.permission.edit');
            Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('admin.permission.update');
            Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('admin.permission.delete');
            Route::delete('/permissions/', [PermissionController::class, 'destroyMany'])->name('admin.permission.delete.many');
        });

        Route::group(['middleware' => 'permission:admin images'], function() {
            Route::get('/images', [ImageController::class, 'index'])->name('admin.image');
            Route::delete('/images/{image}', [ImageController::class, 'destroy'])->name('admin.image.delete');
            Route::delete('/images', [ImageController::class, 'destroyMany'])->name('admin.image.delete.many');
        });
    });
});