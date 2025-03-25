<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\ExternalUser;
use App\Models\CoopGeneralInfo;
use App\Models\Application;
use App\Http\Requests\RenewalRequest;
use Biscolab\ReCaptcha\Rules\Recaptcha;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\AppGeneralInfo;
use App\Models\AppUnit;
use App\Models\CoopUnit;
use App\Models\AppFranchise;
use App\Models\CoopFranchise;
use App\Models\AppGovernance;
use App\Models\CoopGovernance;
use App\Models\AppFinance;
use App\Models\CoopFinance;
use App\Models\AppLoan;
use App\Models\CoopLoan;
use App\Models\AppBusiness;
use App\Models\CoopBusiness;
use App\Models\AppCetos;
use App\Models\CoopTraining;
use App\Models\AppTrainingsList;
use App\Models\CoopMembership;
use App\Models\AppAward;
use App\Models\CoopAward;
use App\Models\AppGrant;
use App\Models\CoopGrants;

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
        
            // Generate unique filename
            $filename = time() . '_' . $file->getClientOriginalName();
        
            // Move file to shared storage location
            $file->move(public_path('shared/uploads'), $filename);
        
            // Store relative path
            $filePath = 'shared/uploads/' . $filename;
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

// ---------------- Save data of Coop from the client system to Application Record

        $coopInfo = CoopGeneralInfo::where('externaluser_id', $user->id)->first();
        $externaluser = ExternalUser::where('id', $user->id)->first();

        if ($coopInfo) {
            // Transfer data to AppGeneralInfo
            AppGeneralInfo::create([
                'application_id' => $application->id,
                'entry_year' => $application->created_at->year,
                'name' => $application->tc_name,
                'short_name' => $coopInfo->short_name ?? null,
                'accreditation_type' => null,
                'cda_registration_no' => $externaluser->cda_reg_no,
                'cda_registration_date' => $coopInfo->cda_registration_date, 
                'common_bond_membership' => $coopInfo->common_bond_membership ?? null,
                'membership_fee' => $coopInfo->membership_fee ?? 0,
                'area' => $application->area,
                'region' => $application->region,
                'city' => $application->city,
                'province' => $application->province,
                'barangay' => $application->barangay,
                'business_address' => $coopInfo->business_address,
                'email' => $externaluser->email ?? null, 
                'contact_no' => $coopInfo->contact_no ?? null,
                'employer_sss_reg_no' => $coopInfo->employer_sss_reg_no ?? null,
                'employer_pagibig_reg_no' => $coopInfo->employer_pagibig_reg_no ?? null,
                'employer_philhealth_reg_no' => $coopInfo->employer_philhealth_reg_no ?? null,
                'sss_enrolled' => $coopInfo->total_sss_enrolled, 
                'pagibig_enrolled' => $coopInfo->total_pagibig_enrolled, 
                'philhealth_enrolled' => $coopInfo->total_philhealth_enrolled, 
                'bir_tin' => $coopInfo->bir_tin ?? null,
                'bir_tax_exemption_no' => $coopInfo->bir_tax_exemption_no ?? null,
            ]);
        }

        $coopUnitsGrouped = CoopUnit::where('externaluser_id', $user->id)
            ->select('type')
            ->selectRaw("SUM(CASE WHEN owned_by = 'coop' THEN 1 ELSE 0 END) as cooperatively_owned")
            ->selectRaw("SUM(CASE WHEN owned_by = 'individual' THEN 1 ELSE 0 END) as individually_owned")
            ->groupBy('type')
            ->get();

        foreach ($coopUnitsGrouped as $unit) {
            AppUnit::create([
                'application_id' => $application->id,
                'entry_year' => $application->created_at->year,
                'mode_of_service' => null, // Add logic if needed
                'type_of_unit' => $unit->type,
                'cooperatively_owned' => $unit->cooperatively_owned,
                'individually_owned' => $unit->individually_owned,
            ]);
        }

        $coopUnits = CoopUnit::where('externaluser_id', $user->id)->get();

        foreach ($coopUnits as $unit) {
            AppFranchise::create([
                'application_id' => $application->id,
                'entry_year' => $application->created_at->year,
                'route' => $unit->origin . ' - ' . $unit->destination,
                'cpc_case_number' => $unit->ltfrb_case_no,
                'type_of_franchise' => null,
                'mode_of_service' => null,
                'type_of_unit' => $unit->type,
                'validity' => $unit->date_of_expiry,
                'remarks' => null,
            ]);
        }

        $coopGovernances = CoopGovernance::where('externaluser_id', $user->id)->get();

        foreach ($coopGovernances as $gov) {
            AppGovernance::create([
                'application_id' => $application->id,
                'entry_year' => $application->created_at->year,
                'role_name' => $gov->role,
                'first_name' => $gov->firstname,
                'middle_name' => $gov->middlename,
                'last_name' => $gov->lastname,
                'suffix' => null,
                'term_start' => $gov->start_term,
                'term_end' => $gov->end_term,
                'mobile_number' => $gov->mobile_no,
                'email' => $gov->email,
            ]);
        }

        $coopTrainings = CoopTraining::where('externaluser_id', $user->id)->get();

        foreach ($coopTrainings as $train) {
            AppTrainingsList::create([
                'application_id' => $application->id,
                'entry_year' => $train->created_at->year,
                'title_of_training' => $train->title_of_training,
                'no_of_attendees' => $train->no_of_attendees,
                'total_fund' => $train->total_fund,
            ]);
        }

        $businesses = CoopBusiness::where('externaluser_id', $user->id)->get();

        foreach ($businesses as $business) {
            AppBusiness::create([
                'application_id' => $application->id,
                'entry_year' => $business->created_at->year,
                'type' => $business->type,
                'nature_of_business' => $business->nature_of_business,
                'starting_capital' => $business->starting_capital,
                'capital_to_date' => $business->capital_to_date,
                'years_of_existence' => $business->years_of_existence,
            ]);
        }

        $coopLoans = CoopLoan::where('externaluser_id', $user->id)->get();

        foreach ($coopLoans as $loan) {
            AppLoan::create([
                'application_id' => $application->id,
                'entry_year' => $application->created_at->year,
                'financing_institution' => $loan->financing_institution,
                'acquired_at' => $loan->acquired_at,
                'amount' => $loan->amount,
                'utilization' => $loan->utilization,
                'remarks' => $loan->remarks,
            ]);
        }

        $coopTrainings = CoopTraining::where('externaluser_id', $user->id)->get();

        // Group training records by year and calculate members with training
        $trainingsByYear = $coopTrainings->groupBy(function($training) {
            return \Carbon\Carbon::parse($training->start_date)->year;
        });

        foreach ($trainingsByYear as $year => $trainings) {
            // Calculate the total number of unique attendees for the year
            $membersWithTraining = $trainings->sum('no_of_attendees');

            // Retrieve the total number of members for the user
            $totalMembers = CoopMembership::where('externaluser_id', $user->id)->count();
            $totalMembers += CoopGovernance::where('externaluser_id', $user->id)->count();

            // Calculate members without training
            $membersWithoutTraining = $totalMembers - $membersWithTraining;

            // Ensure non-negative value for members without training
            $membersWithoutTraining = max($membersWithoutTraining, 0);

            // Insert or update the AppCetos record for the year
            AppCetos::updateOrCreate(
                [
                    'application_id' => $application->id,
                    'entry_year' => $year,
                ],
                [
                    'members_with' => $membersWithTraining,
                    'members_without' => $membersWithoutTraining,
                    'total' => $totalMembers,
                ]
            );
        }

        $coopAwards = CoopAward::where('externaluser_id', $user->id)->get();

        foreach ($coopAwards as $award) {
            AppAward::create([
                'application_id'   => $application->id,
                'entry_year'       => $application->created_at->year,
                'awarding_body'    => $award->awarding_body,
                'nature_of_award'  => $award->nature_of_award,
                'date_received'    => $award->date_received,
            ]);
        }

        $coopGrants = CoopGrants::where('externaluser_id', $user->id)->get();

        foreach ($coopGrants as $grant) {
            AppGrant::create([
                'application_id'  => $application->id, // assuming $application is your submitted application
                'entry_year'       => $application->created_at->year,
                'date_acquired'   => $grant->date_acquired,
                'amount'          => $grant->amount,
                'source'          => $grant->source,
                'status_remarks'  => $grant->status_remarks,
            ]);
        }
// ---------------- Save data of Coop from the client system to Application Record


        return redirect()->route('dashboard')->with('success', 'Application submitted successfully! Reference No: ' . $referenceNumber);

    }

}