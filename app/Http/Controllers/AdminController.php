<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helper\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        
        if($search = request()->query('search')) {
            $users = User::where('name', 'LIKE', "%$search%")->get();
        } else {
            $users = User::all();
        }
       
        return view('admin.user.index', compact('users'));
    }

    public function create() {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'admin-password' => ['required', 'min:8'],
            'roles' => ['nullable', 'array'],
            'image' => "nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=150,min_height=150,ratio=1/1",
        ]);

        // Get super admin
        $admin = User::role('Super Admin')->first();

        // Verify super admin password
        if(!Hash::check($validated['admin-password'], $admin->password)) {
            return redirect()->route('logout')->with('alert-danger', 'You are not admin himself. We kick you out.');
        }

        // create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);

        // create user image
        if($request->hasFile('image')) {
            ImageHelper::createImage($user, 'image', $request->file('image'), 'profile');
        }
        // give roles to user
        if($validated['roles']) {
           $user->syncRoles($validated['roles']);
        }

        return redirect()->route('admin.user')->with('alert-success', "New User {$user->name} created successfully.");
    }

    public function edit(User $user) {
        $roles = Role::all();
        return view('admin.user.edit', compact('roles', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'admin-password' => ['required', 'min:8'],
            'roles' => ['nullable', 'array'],
            'image' => "nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=150,min_height=150,ratio=1/1",
        ]);

        $admin = User::role('Super Admin')->first();

        if(!Hash::check($validated['admin-password'], $admin->password)) {
            return redirect()->route('logout')->with('alert-danger', 'You are not admin himself. We kick you out.');
        }

        if($request->hasFile('image')) {
            if($user->image) {
                ImageHelper::delete($user->image);
                
                // Delete Old img in db
                $user->image()->delete();
            }

            ImageHelper::createImage($user, 'image', $request->file('image'), 'profile');
        }

        $user->update($validated);
        if(isset($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        }
        

        return redirect()->route('admin.user.show', $user)->with('alert-success', $user->name . '\'s profile updated Successfully.');
    }

    public function show(User $user) {
        $user->load(['posts.likes', 'posts.dislikes']);

        $likesCount = $user->posts->flatMap(function ($post) {
            return $post->likes;
        })->count();

        $dislikesCount = $user->posts->flatMap(function ($post) {
            return $post->dislikes;
        })->count();

        $postCount = $user->posts->count();
        return view('admin.user.show', compact('user', 'likesCount', 'dislikesCount', 'postCount'));
    }

    public function destroy(User $user) {
        // delete user roles

        // delete user image

        // delete user
        $user->delete();
        return redirect()->route('admin.user')->with('alert-success', 'Deleted user successfully.');
    }
}
