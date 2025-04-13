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
    
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $secondsRemaining = RateLimiter::availableIn($key);
            return back()->with('lockout_time', $secondsRemaining);
        }
    
        $user = ExternalUser::where('email', $email)->first();
    
        if (!$user) {
            RateLimiter::hit($key, 60);
            return back()->withErrors(['email_login' => 'Email not found.'], 'login');
        }
    
        if (!Hash::check($password, $user->password)) {
            RateLimiter::hit($key, 60);
            return back()->withErrors(['password' => 'Incorrect password.'], 'login');
        }
    
        // If two-factor is enabled, send OTP and redirect to OTP verify page
        if ($user->two_factor_enabled) {
            // Generate OTP
            $otp = rand(100000, 999999);
            $user->two_factor_login_otp = $otp;
            $user->two_factor_login_expires_at = now()->addMinutes(5);
            $user->save();
    
            // Send OTP via Vonage
            $user->notify(new \App\Notifications\SendOtpNotification($otp, $user->contact_no));
    
            // Store user id in session temporarily for OTP validation
            session([
                '2fa_user_id' => $user->id,
                'remember_login' => request()->has('remember'), // optional if you use "remember me"
            ]);
    
            return redirect()->route('verify.2fa'); // Make sure this route exists
        }
    
        // Normal login if 2FA is not enabled
        RateLimiter::clear($key);
    
        Auth::login($user);
        request()->session()->regenerate();
    
        return redirect('/dash');
    }

    public function showVerify2fa()
    {
        if (!session()->has('2fa_user_id')) {
            return redirect('/login');
        }
    
        return view('auth.verify-2fa'); // Blade file for OTP input
    }
    
    public function verify2fa(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
    
        $user = ExternalUser::find(session('2fa_user_id'));
    
        if (!$user || $user->two_factor_login_otp !== $request->otp || now()->greaterThan($user->two_factor_login_expires_at)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }
    
        // Clear OTP fields
        $user->two_factor_login_otp = null;
        $user->two_factor_login_expires_at = null;
        $user->save();
    
        // Log the user in
        Auth::login($user);
        request()->session()->regenerate();
    
        session()->forget('2fa_user_id');
    
        return redirect('/dash');
    }

    public function resend2fa()
    {
        if (!session()->has('2fa_user_id')) {
            return redirect('/login');
        }
    
        $user = ExternalUser::find(session('2fa_user_id'));
    
        if (!$user) {
            return redirect('/login');
        }
    
        $otp = rand(100000, 999999);
        $user->two_factor_login_otp = $otp;
        $user->two_factor_login_expires_at = now()->addMinutes(5);
        $user->save();
    
        $user->notify(new \App\Notifications\SendOtpNotification($otp, $user->contact_no));
    
        return back()->with('status', 'A new OTP has been sent to your contact number.');
    }
    

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
