<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{

    public function store()
    {
        try {
            $attributes = request()->validate([
                'email_login' => ['required', 'email'],
                'password' => ['required']
            ]);

            // Modify the Auth::attempt to look for email_login
            if (! Auth::attempt(['email' => $attributes['email_login'], 'password' => $attributes['password']])) {
                throw ValidationException::withMessages([
                    'email' => 'Sorry, those credentials do not match.'
                ])->errorBag('login');
            }

            request()->session()->regenerate();

            return redirect('/dash');
        } catch (ValidationException $e) {
            throw ValidationException::withMessages($e->errors())
                ->errorBag('login');
        }
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
