<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;
use App\Models\GeneralInfo;
use Illuminate\Http\Request;

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
}