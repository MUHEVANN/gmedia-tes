<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\RegisterJob;
use App\Models\Cart;
use App\Models\User;
use App\Notifications\RegisterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login_page()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('Auth.login');
    }

    public function login()
    {

        $validated = Validator::make(request()->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated->messages())->withInput();
        }
        $user = User::where('username', request('username'))->first();

        if ($user) {
            if (!Hash::check(request('password'), $user->password)) {
                return redirect()->back()->with('error', 'Invalid credentials');
            }
            Auth::login($user);
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login-page');
    }

    public function register()
    {
        $validated = Validator::make(request()->all(), [
            'username' => 'required|unique:users',
            'password' => 'required'
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated->messages())->withInput();
        }

        $user = User::create([
            'username' => request('username'),
            'password' => Hash::make(request('password')),
            'email' => 'tes@gmail.com'
        ]);

        if ($user) {
            RegisterJob::dispatch($user);
            Cart::firstOrCreate([
                "user_id" => $user->id,
            ]);
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors('error', 'Failed to create user');
    }

    public function register_page()
    {
        if (Auth::check()) {
            return redirect()->back()->with('error', 'You are already logged in');
        }

        return view('Auth.register');
    }
}
