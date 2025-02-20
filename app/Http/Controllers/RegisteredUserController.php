<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;


use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function store() 
    {
        try {
            $attributes = request()->validate([
                'accreditation_no' => ['nullable', 'unique:'.User::class],
                'tc_name' => ['required'],
                'chair_fname' => ['required'],
                'chair_mname' => ['nullable'],
                'chair_lname' => ['required'],
                'chair_suffix' => ['nullable'],
                'contact_no' => ['required', 'unique:'.User::class],
                'email' => ['required', 'email', 'unique:'.User::class],
                'password' => ['required', Password::min(12), 'confirmed']
            ]);

            $user = User::create($attributes);
            Auth::login($user);

            event(new Registered($user));

            return redirect('/');

        } catch (ValidationException $e) {
            throw ValidationException::withMessages($e->errors())
                ->errorBag('signup');
        }
    }
}