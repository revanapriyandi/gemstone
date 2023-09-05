<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;

class GoogleSocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $findUser = User::where('social_id', $user->id)
                ->orWhere('email', $user->email)
                ->first();

            if ($findUser) {
                Auth::login($findUser);
                $findUser->update([
                    'social_id' => $user->id,
                    'social_type' => 'google'
                ]);

                return $this->redirectToRoleBasedRoute($findUser->role);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'google',
                    'password' => bcrypt('password')
                ]);

                Auth::login($newUser);

                return $this->redirectToRoleBasedRoute($newUser->role);
            }
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Something went wrong');
        }
    }

    protected function redirectToRoleBasedRoute($role)
    {
        return $role === 'admin' ? redirect()->route('dashboard') : redirect()->route('home');
    }
}
