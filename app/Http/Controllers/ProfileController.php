<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ExternalUser;

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
}

