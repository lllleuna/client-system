<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Notifications\SendOtpNotification;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profilesetting', compact('user'));
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png|max:2048',
        ]);
    
        try {
            $user = Auth::user();
    
            $file = $request->file('profile_picture');
            $filename = 'profile_' . $user->id . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $filename, 'shared');
    
            if (!$filePath) {
                return redirect()->back()->with('error', 'File upload failed.');
            }
    
            $user->profile_picture = $filename;
            $user->save();
    
            return redirect()->back()->with('success', 'Profile picture updated.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the profile picture: ' . $e->getMessage());
        }
    }
    

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);
    
        $user = Auth::user();
    
        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
    
        // Update to new password
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        return back()->with('success', 'Password updated successfully.');
    }

    public function toggleTwoFactor(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);
    
        $user = Auth::user();
    
        // Validate password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The password you entered is incorrect.']);
        }
    
        // Redirect if contact number is not verified
        if (is_null($user->contact_no_verified_at)) {
            return redirect()->route('verify.contact')->with('warning', 'Please verify your contact number first.');
        }
    
        // Toggle 2FA
        $user->two_factor_enabled = !$user->two_factor_enabled;
        $user->save();
    
        return redirect()->back()->with('success', 'Two-Factor Authentication has been ' . ($user->two_factor_enabled ? 'enabled' : 'disabled') . '.');
    }

    public function showVerifyContactOtp()
    {
        return view('verify-contact-otp');
    }

    public function verifyContactOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $userId = session('pending_contact_verification_id');
        $user = ExternalUser::find($userId);

        if (!$user || session('pending_contact_otp') !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // OTP is correct
        $user->contact_no_verified_at = now();
        $user->save();

        Session::forget('pending_contact_otp');
        Session::forget('pending_contact_verification_id');

        return redirect()->route('generalinfo')->with('success', 'Contact number verified and updated.');
    }

    public function resendContactOtp()
    {
        $user = Auth::user();
    
        $newOtp = rand(100000, 999999);
        Session::put('contact_otp_code', $newOtp);
    
        $contactNo = Session::get('pending_contact_no');
    
        if (!$contactNo) {
            return redirect()->route('generalinfo')->withErrors('No pending contact number to verify.');
        }
    
        $user->notify(new SendOtpNotification($newOtp, $contactNo));
    
        return redirect()->back()->with('success', 'A new OTP has been sent to your contact number.');
    }
    
}

