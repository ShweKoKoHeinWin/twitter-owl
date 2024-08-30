<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register() {
        $validated = request()->validate([
            'name' => ['required', 'max:30'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $user = User::create($validated);
        Auth::login($user);
        return redirect('/')->with('alert-success', "Hi " . Auth::user()->name . " Welcome to " . config('app.name'));
    }

    public function login() {
        $validated = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);
        if(!Auth::attempt($validated)) {
            throw ValidationException::withMessages([
                'email' => "Sorry, These credential are not validate."
            ]);
        }
        request()->session()->regenerate();
        return redirect('/')->with('alert-success', "Hi " . Auth::user()->name . ". Welcome back to " . config('app.name'));
    }

    public function logout() {
        Auth::logout();
        $name = config('app.name');
        return redirect('/')->with('alert-success', "Want to login back? Just <a href='" . route('login') ."'>click here</a>");
    }
}
