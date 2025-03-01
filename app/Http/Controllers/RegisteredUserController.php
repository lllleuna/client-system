<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;
use App\Models\GeneralInfo;
use Illuminate\Http\Request;
use App\Notifications\SendOtpNotification;
use Illuminate\Support\Facades\Cache;

class RegisteredUserController extends Controller
{
    public function store() 
    {
        try {
            $attributes = request()->validate([
                'cda_reg_no' => ['required', 'unique:'.User::class],
                'tc_name' => ['required'],
                'chair_fname' => ['required'],
                'chair_mname' => ['nullable'],
                'chair_lname' => ['required'],
                'chair_suffix' => ['nullable'],
                'contact_no' => ['required', 'unique:'.User::class],
                'id_type' => ['required'],
                'id_number' => ['required', 'string', 'max:25'],
                'email' => ['required', 'email', 'unique:'.User::class],
                'password' => ['required', 'confirmed',
                                Password::min(12) 
                                ->letters() 
                                ->mixedCase() 
                                ->numbers() 
                                ->symbols(),
                            ],
            ]);

            $existsInGeneralInfo = GeneralInfo::where('cda_registration_no', request()->cda_reg_no)->exists();
            $attributes['accreditation_status'] = $existsInGeneralInfo ? 'Active' : 'New';

            $user = User::create($attributes);
            Auth::login($user);

            event(new Registered($user));

            return redirect('/')->with('success', 'Account Created Successfully!');

        } catch (ValidationException $e) {
            throw ValidationException::withMessages($e->errors())
                ->errorBag('signup');
        }
    }

    public function show() 
    {
        return view('/users/create');
    }

    /**
     * Show the two-factor authentication options page
     */
    public function showAuthOptions()
    {
        return view('auth.index');
    }

    /**
     * Show the SMS verification page
     */
    public function showSmsVerification()
    {
        return view('auth.sms');
    }

    /**
     * Show the Google Authenticator page
     */
    public function showGoogleAuthenticator()
    {
        return view('auth.google');
    }

    /**
     * Verify phone number and send OTP
     */
    public function verifyPhone(Request $request)
    {
        $user = Auth::user(); // Get the logged-in user
        $otp = rand(100000, 999999); // Generate a 6-digit OTP

        // Store OTP in the session or database for verification
        session(['otp' => $otp]);

        // Send OTP notification
        $user->notify(new SendOtpNotification($otp));

        return response()->json(['message' => 'OTP sent successfully!']);
    }
    
    /**
     * Verify the OTP entered by the user
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);
        
        $user = Auth::user();
        $storedOtp = Cache::get('otp_' . $user->id);
        
        if (!$storedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please request a new one.'
            ], 400);
        }
        
        if ($request->otp !== $storedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP. Please try again.'
            ], 400);
        }
        
        // OTP is valid, mark user as verified
        $user->phone_verified_at = now();
        $user->save();
        
        // Clear the OTP from cache
        Cache::forget('otp_' . $user->id);
        
        return response()->json([
            'success' => true,
            'message' => 'Phone number verified successfully'
        ]);
    }
    
    /**
     * Resend OTP to the user's phone
     */
    public function resendOtp(Request $request)
    {
        $user = Auth::user();
        
        // Generate a new random 6-digit OTP
        $otp = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store OTP in cache with expiration (10 minutes)
        Cache::put('otp_' . $user->id, $otp, now()->addMinutes(10));
        
        // Send OTP notification
        $user->notify(new SendOtpNotification($otp));
        
        return response()->json([
            'success' => true,
            'message' => 'OTP resent successfully'
        ]);
    }
    
    /**
     * Setup Google Authenticator for the user
     */
    public function setupGoogleAuth(Request $request)
    {
        $user = Auth::user();
        
        // In a real app, you would use a library like pragmarx/google2fa to generate secrets and QR codes
        // This is just a placeholder implementation
        
        // Generate a secret key
        $secret = 'ABCDEFGHIJKLMNOP'; // In production, use a proper generation method
        
        // Store the secret key
        $user->google_2fa_secret = $secret;
        $user->save();
        
        return view('auth.google', [
            'secret' => $secret,
            // QR code URL would be generated here
        ]);
    }
    
    /**
     * Verify Google Authenticator code
     */
    public function verifyGoogleAuth(Request $request)
    {
        $request->validate([
            'auth_code' => 'required|string|size:6',
        ]);
        
        $user = Auth::user();
        
        // In a real app, you would verify the code using a library like pragmarx/google2fa
        // This is just a placeholder implementation
        $isValid = true; // Replace with actual verification
        
        if (!$isValid) {
            return back()->withErrors(['auth_code' => 'Invalid authentication code']);
        }
        
        // Mark user as verified
        $user->google_2fa_verified_at = now();
        $user->save();
        
        return redirect('/')->with('success', 'Two-factor authentication enabled successfully');
    }
}