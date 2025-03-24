<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\ExternalUser;
use App\Models\CoopGeneralInfo;
use App\Models\Application;
use App\Http\Requests\RenewalRequest;
use Biscolab\ReCaptcha\Rules\Recaptcha;

class RenewalController extends Controller 
{

    public function submit(RenewalRequest $request)
    {
        $user = Auth::user();

        $request->validate([
            'g-recaptcha-response' => 'required|recaptcha',
        ], [
            'g-recaptcha-response.required' => 'Please confirm you are not a robot.',
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed, please try again.',
        ]); 

        // Fetching from related models
        $externalUser = ExternalUser::where('id', $user->id)->first();
        $coopInfo = CoopGeneralInfo::where('externaluser_id', $externalUser->id)->first();

        // Handle file upload
        if ($request->hasFile('letter_request')) {
            $file = $request->file('letter_request');
            $filePath = $file->store('uploads', 'public');
        }


        // Generate unique reference number
        do {
            $referenceNumber = 'RNW-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        } while (Application::where('reference_number', $referenceNumber)->exists());

        // Save Application
        $application = new Application();
        $application->tc_name = $externalUser->tc_name;
        $application->cda_reg_no = $externalUser->cda_reg_no;
        $application->cda_reg_date = $coopInfo->cda_registration_date ?? null;
        $application->area = 'area';
        $application->region = 'region';
        $application->province = 'province';
        $application->city_municipality = 'city';
        $application->barangay = 'barangay';
        $application->address = $coopInfo->business_address ?? null;
        $application->status = 'new';
        $application->application_type = 'CGS Renewal';
        $application->file_upload = $filePath;
        $application->consent = $request->consent ? true : false;
        $application->oath = $request->oath ? true : false;
        $application->reference_number = $referenceNumber;
        $application->user_id = $externalUser->id;
        $application->save();

        return redirect()->route('dashboard')->with('success', 'Application submitted successfully! Reference No: ' . $referenceNumber);

    }

}