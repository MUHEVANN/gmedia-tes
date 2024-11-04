<?php

namespace App\Http\Controllers;

use App\Models\SocialLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback($driver)
    {
        $socialUser = Socialite::driver($driver)->user();

        $user = SocialLogin::where('driver', $driver)->where('driver_id', $socialUser->getId())->first();

        if ($user) {
            Auth::login($user->user);
            return redirect()->route('dashboard');
        }

        $db_user = User::where('email', $socialUser->getEmail())->first();

        if ($db_user) {
            SocialLogin::create([
                'driver_id' => $socialUser->getId(),
                'driver' => $driver,
                'user_id' => $db_user->id,
            ]);
        } else {
            $db_user = User::create([
                'username' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make('password'),
            ]);
 
            SocialLogin::create([
                'driver_id' => $socialUser->getId(),
                'driver' => $driver,
                'user_id' => $db_user->id,
            ]);
        }

        Auth::login($db_user);
        return redirect()->route('dashboard');
    }
}