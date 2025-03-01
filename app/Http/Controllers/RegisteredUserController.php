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

    public function sendOtp(Request $request)
    {
        try {
            // Log the incoming request data
            \Log::info('OTP Request received with data:', $request->all());
            
            $user = Auth::user();
            if (!$user) {
                \Log::error('Send OTP failed: User not authenticated');
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            
            // Get the contact number
            $contactNo = $request->input('contact_no');
            \Log::info('Contact number received: ' . $contactNo);
            
            // Generate OTP
            $otp = rand(100000, 999999);
            session(['otp' => $otp, 'verified_contact_no' => $contactNo]);
            
            \Log::info('About to send OTP ' . $otp . ' to ' . $contactNo . ' for user ID: ' . $user->id);
            
            // THIS IS THE PART THAT'S LIKELY FAILING
            try {
                $user->notify(new SendOtpNotification($otp, $contactNo));
                \Log::info('OTP notification sent successfully');
            } catch (\Exception $notificationException) {
                \Log::error('Notification error: ' . $notificationException->getMessage());
                \Log::error('Notification error trace: ' . $notificationException->getTraceAsString());
                return response()->json(['error' => 'SMS service error: ' . $notificationException->getMessage()], 500);
            }
            
            return response()->json(['message' => 'OTP sent successfully!']);
        } catch (\Exception $e) {
            \Log::error('OTP Send Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $enteredOtp = $request->otp;
        $storedOtp = session('otp');
        $verifiedContactNo = session('verified_contact_no');

        if ($enteredOtp == $storedOtp) {
            // Remove OTP after successful verification
            session()->forget(['otp', 'verified_contact_no']); 
            
            // Update the user's verification timestamp and contact number
            $user = Auth::user();
            
            // Update the externalusers table
            \DB::table('externalusers')
                ->where('id', $user->id) // Assuming user id matches the externalusers id
                ->update([
                    'contact_no' => $verifiedContactNo,
                    'contact_no_verified_at' => now()
                ]);

            return redirect('/dash')->with('success', 'Mobile Number Verified!');
        } else {
            return response()->json(['error' => 'Invalid OTP. Try again.'], 400);
        }
    }


    public function resendOtp(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                \Log::error('Resend OTP failed: User not authenticated');
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            
            // Get the stored contact number from session or from user model
            $contactNo = session('verified_contact_no');
            
            // If contact number not found in session, try to get from user model
            if (!$contactNo && $user->phone) {
                $contactNo = $user->phone;
                // Save to session for future use
                session(['verified_contact_no' => $contactNo]);
            }
            
            if (!$contactNo) {
                \Log::error('Resend OTP failed: Contact number not found for user ' . $user->id);
                return response()->json(['error' => 'Contact number not found'], 400);
            }
            
            // Generate and store OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            session(['otp' => $otp]);
            
            // Debugging Log
            \Log::info('Resent OTP for user ' . $user->id . ': ' . $otp . ' to number: ' . $contactNo);
            
            // Send OTP notification with the contact number
            $user->notify(new SendOtpNotification($otp, $contactNo));
            
            return response()->json(['success' => true, 'message' => 'OTP resent successfully!']);
        } catch (\Exception $e) {
            \Log::error('Resend OTP error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to resend OTP. Please try again.'], 500);
        }
    }


}