<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\ExternalUser;
use App\Notifications\ExternalUserResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:externalusers,email',
        ]);

        $user = ExternalUser::where('email', $request->email)->first();

        $token = Str::random(60);

        // Insert token into password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        // Send notification
        $user->notify(new ExternalUserResetPassword($token));

        return back()->with(['status' => 'We have emailed your password reset link!']);
    }
}
