<?php

namespace App\Http\Controllers;
use App\Models\ExternalUser;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;
use App\Models\GeneralInfo;
use Illuminate\Http\Request;
use App\Notifications\SendOtpNotification;
use App\Models\CoopGeneralInfo;


class RegisteredUserController extends Controller
{
    public function store() 
    {
        try {
            $validatedData = request()->validate([
                'cda_reg_no'   => ['required', 'unique:externalusers,cda_reg_no'],
                'tc_name'      => ['required'],
                'chair_fname'  => ['required'],
                'chair_mname'  => ['nullable'],
                'chair_lname'  => ['required'],
                'chair_suffix' => ['nullable'],
                'contact_no'   => ['required', 'unique:externalusers,contact_no'],
                'id_type'      => ['required'],
                'id_number'    => ['required', 'string', 'max:25'],
                'email'        => ['required', 'email', 'unique:externalusers,email'],
                'password'     => ['required', 'confirmed',
                    Password::min(12)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols(),
                ],
            ]);
        
            // Determine accreditation status
            $existsInGeneralInfo = GeneralInfo::where('cda_registration_no', request()->cda_reg_no)->exists();
            $validatedData['accreditation_status'] = $existsInGeneralInfo ? 'Active' : 'New';
        
            // Create ExternalUser
            $user = ExternalUser::create($validatedData);
        
            // Log in user
            Auth::login($user);
        
            // Store email to CoopGeneralInfo
            CoopGeneralInfo::updateOrCreate(
                ['externaluser_id' => $user->id],
                ['email' => $validatedData['email']]
            );
        
            // Trigger event
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

    public function sendOtp(Request $request)
    {
        try {
            
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            $contactNo = $request->input('contact_no');
            
            $otp = rand(100000, 999999);
            session(['otp' => $otp, 'verified_contact_no' => $contactNo]);
            
            try {
                $user->notify(new SendOtpNotification($otp, $contactNo));
            } catch (\Exception $notificationException) {
                return response()->json(['error' => 'SMS service error: ' . $notificationException->getMessage()], 500);
            }
            
            return response()->json(['message' => 'OTP sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $enteredOtp = $request->otp;
        $storedOtp = session('otp');
        $verifiedContactNo = session('verified_contact_no');

        if ($enteredOtp == $storedOtp) {
            session()->forget(['otp', 'verified_contact_no']); 
            
            $user = Auth::user();
            
            \DB::table('externalusers')
                ->where('id', $user->id)
                ->update([
                    'contact_no' => $verifiedContactNo,
                    'contact_no_verified_at' => now()
                ]);

            return redirect('/dash')->with('success', 'Mobile Number Verified!');
        } else {
            return redirect('/auth/mfa')->with('error', 'Invalid OTP!');
        }
    }


    public function resendOtp(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $contactNo = session('verified_contact_no');
            
            if (!$contactNo && $user->phone) {
                $contactNo = $user->phone;
                session(['verified_contact_no' => $contactNo]);
            }
            
            if (!$contactNo) {
                return response()->json(['error' => 'Contact number not found'], 400);
            }
            
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            session(['otp' => $otp]);
            $user->notify(new SendOtpNotification($otp, $contactNo));
            
            return response()->json(['success' => true, 'message' => 'OTP resent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to resend OTP. Please try again.'], 500);
        }
    }

    public function verifyEmail($token)
    {
        $user = ExternalUser::where('email_verification_token', $token)->first();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid or expired verification token.');
        }
    
        $user->update([
            'email' => $user->pending_email,
            'pending_email' => null,
            'email_verified_at' => now(),
            'email_verification_token' => null,
        ]);
    
        Auth::login($user); // Auto login
    
        return redirect()->route('generalinfo')->with('success', 'Email verified and logged in successfully!');
    }



}