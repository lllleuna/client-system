<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Biscolab\ReCaptcha\Rules\Recaptcha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\CoopGeneralInfo; 
use App\Models\AppGeneralInfo;
use App\Models\ExternalUser;
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
use Illuminate\Support\Facades\Mail;
use App\Mail\AccreditationSubmitted;
use Symfony\Component\HttpKernel\Exception\TooLargeException; // Laravel 10+
use Symfony\Component\HttpKernel\Exception\PayloadTooLargeHttpException;
use Illuminate\Http\Exceptions\PostTooLargeException;


class ApplicationController extends Controller
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof PostTooLargeException) {
            return redirect()->route('dashboard')
                ->with('error', 'The uploaded file is too large. Please reduce the file size and try again.');
        }
    
        return parent::render($request, $exception);
    }    
    
    public function showForm1(Request $request)
    {
        $userId = Auth::id(); // Get authenticated user ID

        // Find the coopinfo where externaluser_id matches the authenticated user's ID
        $coopinfo = CoopGeneralInfo::where('externaluser_id', $userId)->first();

        // Retrieve form data from session if available
        $formData = $request->session()->get('form_data', []);

        return view('accreditation.form1', [
            'formData' => $formData,
            'coopinfo' => $coopinfo, // Pass coopinfo to the Blade view
        ]);
    }

    public function processForm1(Request $request)
    {
        $validatedData = $request->validate([
            'tc_name' => 'required|string|unique:general_info,name',
            'cda_reg_no' => 'required|string|unique:general_info,cda_registration_no',
            'cda_reg_date' => 'required|date|before:tomorrow',
            'area' => 'nullable',
            'region' => 'required',
            'province' => 'nullable',
            'city_municipality' => 'required',
            'barangay' => 'required',
            'address' => 'required',
            'application_type' => 'required',
        ]);

        $request->session()->put('form_data', $validatedData);

        return redirect()->route('form2');
    }

    public function showForm2(Request $request)
    {
        $formData = $request->session()->get('form_data', []);
        return view('accreditation.form2', ['formData' => $formData]);
    }

    public function processForm2(Request $request)
    {
            $validatedData = $request->validate([
                'file_upload' => 'required|file|mimes:pdf|max:10240',
                'message' => 'nullable|string|max:300', 
                'consent' => 'required|in:on', 
                'oath' => 'required|in:on', 
            ]);
            
            $validatedData['consent'] = $request->has('consent') ? 1 : 0;
            $validatedData['oath'] = $request->has('oath') ? 1 : 0;
            $filePaths = [];

            if ($request->hasFile('file_upload')) {
                $file = $request->file('file_upload');
            
                $destinationPath = '/var/www/shared_uploads/uploads';
            
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
            
                $filename = time() . '_' . $file->getClientOriginalName();
            
                $file->move($destinationPath, $filename);
            
                $filePaths['file_upload'] = 'uploads/' . $filename;
            }
            

            $allFormData = array_merge($request->session()->get('form_data', []), $validatedData, $filePaths);

            if (!isset($allFormData['tc_name'])) {
                return back()->withErrors(['tc_name' => 'Transportation Cooperative Name is missing.']);
            }
            
            $request->session()->put('form_data', $allFormData); 

            return redirect()->route('confirmation');
        
    }


    public function showConfirmation(Request $request)
    {
        $formData = $request->session()->get('form_data', []);
    
        // Default names in case API fails
        $regionName = 'Unknown Region';
        $cityName = 'Unknown City/Municipality';
        $barangayName = 'Unknown Barangay';
    
        // Fetch Region Name
        if (!empty($formData['region'])) {
            $regionResponse = Http::get("https://psgc.gitlab.io/api/regions/{$formData['region']}/");
            if ($regionResponse->successful()) {
                $regionName = $regionResponse->json()['name'];
            }
        }
    
        // Fetch City/Municipality Name
        if (!empty($formData['city_municipality'])) {
            $cityResponse = Http::get("https://psgc.gitlab.io/api/cities-municipalities/{$formData['city_municipality']}/");
            if ($cityResponse->successful()) {
                $cityName = $cityResponse->json()['name'];
            }
        }
    
        // Fetch Barangay Name
        if (!empty($formData['barangay'])) {
            $barangayResponse = Http::get("https://psgc.gitlab.io/api/barangays/{$formData['barangay']}/");
            if ($barangayResponse->successful()) {
                $barangayName = $barangayResponse->json()['name'];
            }
        }
    
        return view('accreditation.confirmation', [
            'formData' => $formData,
            'regionName' => $regionName,
            'cityName' => $cityName,
            'barangayName' => $barangayName,
        ]);
    }
    

    public function submitForm(Request $request)
    {
        try {
            $request->validate([
                'g-recaptcha-response' => 'required|recaptcha',
            ], [
                'g-recaptcha-response.required' => 'Please confirm you are not a robot.',
                'g-recaptcha-response.recaptcha' => 'Captcha verification failed, please try again.',
            ]);       
            
            $allFormData = $request->session()->get('form_data', []);

            $user = Auth::user();
            $allFormData['user_id'] = $user->id;

            if ($request->hasFile('file_upload')) {
                $file = $request->file('file_upload');
            
                // Generate unique filename
                $filename = time() . '_' . $file->getClientOriginalName();
            
                // Move to shared/uploads folder
                $file->move(public_path('shared/uploads'), $filename);
            
                // Store relative path
                $allFormData['file_path'] = 'shared/uploads/' . $filename;
            }
            

            $application = Application::create($allFormData);
            $referenceNumber = 'APP-' . str_pad($application->id, 6, '0', STR_PAD_LEFT);
            $application->update(['reference_number' => $referenceNumber]);

            $coopInfo = CoopGeneralInfo::where('externaluser_id', $user->id)->first();
            $externaluser = ExternalUser::where('id', $user->id)->first();

            if ($externaluser && $application) {
                $email = $externaluser->email;
                $tcName = $application->tc_name;
        
                // Send the email
                Mail::to($email)->send(new AccreditationSubmitted($tcName, $referenceNumber));
            }

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
                    'city' => $application->city_municipality,
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
                    'validity' => $coopInfo->bir_validity ?? null,
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


            $request->session()->forget('form_data');

            
            return redirect()->route('success', ['referenceNumber' => $referenceNumber]);

        } catch (\Throwable $e) {
            \Log::error($e); // Log the real error for debugging

            return redirect()->route('dashboard')->with('error', 'Something went wrong. Make sure to follow instructions and try again later.');
        }

    }

    public function showSuccess(Request $request)
    {
        $referenceNumber = $request->route('referenceNumber');
        return view('accreditation.success', ['referenceNumber' => $referenceNumber]);
    }

}
