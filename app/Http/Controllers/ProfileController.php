<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Hash;

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

        $user = Auth::user();

        $file = $request->file('profile_picture');
        $filename = 'profile_' . $user->id . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('uploads', $filename, 'shared');

        $user->profile_picture = $filename;
        $user->save();

        return redirect()->back()->with('success', 'Profile picture updated.');
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
        $user = Auth::user();
    
        $user->two_factor_enabled = !$user->two_factor_enabled;
        $user->save();
    
        return redirect()->back()->with('success', 'Two-Factor Authentication has been ' . ($user->two_factor_enabled ? 'enabled' : 'disabled') . '.');
    }
    
}

