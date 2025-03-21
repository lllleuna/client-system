<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\ExternalUser; // Use ExternalUser Model

class SessionController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'email_login' => ['required', 'email'],
            'password' => ['required']
        ]);

        $email = $attributes['email_login'];
        $password = $attributes['password'];

        $key = 'login-attempts:' . $email;

        // Check if user is locked out
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $secondsRemaining = RateLimiter::availableIn($key);
            return back()->with('lockout_time', $secondsRemaining); // Keep only the session variable
        }

        // Check if the email exists
        $user = ExternalUser::where('email', $email)->first();
        if (!$user) {
            RateLimiter::hit($key, 60);
            return back()->withErrors([
                'email_login' => 'Email not found.'
            ], 'login');
        }

        // Check password
        if (!Hash::check($password, $user->password)) {
            RateLimiter::hit($key, 60);
            return back()->withErrors([
                'password' => 'Incorrect password.'
            ], 'login');
        }

        // Reset attempts after successful login
        RateLimiter::clear($key);

        Auth::login($user);
        request()->session()->regenerate();

        return redirect('/dash');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
