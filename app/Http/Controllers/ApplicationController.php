<?php

namespace App\Http\Controllers;

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
use App\Models\CoopMembership;
use App\Models\AppAward;
use App\Models\CoopAward;
use App\Models\AppGrant;
use App\Models\CoopGrants;

class ApplicationController extends Controller
{
    public function showForm1(Request $request)
    {
        $formData = $request->session()->get('form_data', []);
        return view('accreditation.form1', ['formData' => $formData]);
    }

    public function processForm1(Request $request)
    {
        $validatedData = $request->validate([
            'tc_name' => 'required|string|unique:general_info,name',
            'cda_reg_no' => 'required|string|unique:general_info,cda_registration_no',
            'cda_reg_date' => 'required|date|before:tomorrow',
            'area' => 'required',
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
            'file_upload' => 'required|file|mimes:pdf,jpg,png|max:2048',
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
        return view('accreditation.confirmation', ['formData' => $formData]);
    }

    public function submitForm(Request $request)
    {
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
                'area' => $coopInfo->area,
                'region' => $coopInfo->region,
                'city' => $coopInfo->city,
                'province' => $coopInfo->province,
                'barangay' => $coopInfo->barangay,
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

        $userId = Auth::id();

        // Fetch the membership fee from CoopGeneralInfo
        $membershipFee = CoopGeneralInfo::where('externaluser_id', $userId)->value('membership_fee') ?? 0;

        // Aggregate data by year
        $financialData = DB::table('members_masterlist')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(share_capital) as total_share_capital'),
                DB::raw('COUNT(id) as total_members')
            )
            ->where('externaluser_id', $userId)
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->get();

        foreach ($financialData as $data) {
            $year = $data->year;

            // Calculate total training funds for the year
            $totalTrainingFunds = CoopTraining::where('externaluser_id', $userId)
                ->whereYear('start_date', $year)
                ->sum('total_fund');

            // Calculate total loan amounts for the year
            $totalLoans = CoopLoan::where('externaluser_id', $userId)
                ->whereYear('acquired_at', $year)
                ->sum('amount');

            // Calculate total assets
            $totalAssets = $data->total_share_capital + $totalTrainingFunds;

            // Determine cooperative type based on total assets
            if ($totalAssets < 1000000) {
                $coopType = 'Micro';
            } elseif ($totalAssets < 5000000) {
                $coopType = 'Small';
            } elseif ($totalAssets < 15000000) {
                $coopType = 'Medium';
            } else {
                $coopType = 'Large';
            }

            // Calculate liabilities (assuming total loans represent liabilities)
            $liabilities = $totalLoans;

            // Calculate members' equity
            $membersEquity = $data->total_share_capital;

            // Calculate total gross revenues (assuming training funds as revenue)
            $totalGrossRevenues = $totalTrainingFunds;

            // Calculate total expenses (assuming loans as expenses)
            $totalExpenses = $totalLoans;

            // Calculate net surplus
            $netSurplus = $totalGrossRevenues - $totalExpenses;

            // Insert data into AppFinance
            AppFinance::updateOrCreate(
                [
                    'application_id'  => $application->id, 
                    'entry_year' => $year
                ],
                [
                    'current_assets' => $totalAssets,
                    'noncurrent_assets' => 0, // Adjust as necessary
                    'total_assets' => $totalAssets,
                    'coop_type' => $coopType,
                    'liabilities' => $liabilities,
                    'members_equity' => $membersEquity,
                    'total_gross_revenues' => $totalGrossRevenues,
                    'total_expenses' => $totalExpenses,
                    'net_surplus' => $netSurplus,
                    'initial_auth_capital_share' => 0, // Adjust as necessary
                    'present_auth_capital_share' => 0, // Adjust as necessary
                    'subscribed_capital_share' => 0, // Adjust as necessary
                    'paid_up_capital' => $membersEquity,
                    'capital_build_up_scheme' => 0, // Adjust as necessary
                    'general_reserve_fund' => 0, // Adjust as necessary
                    'education_training_fund' => 0, // Adjust as necessary
                    'community_dev_fund' => 0, // Adjust as necessary
                    'optional_fund' => 0, // Adjust as necessary
                    'share_capital_interest' => 0, // Adjust as necessary
                    'patronage_refund' => 0, // Adjust as necessary
                    'others' => 0, // Adjust as necessary
                    'total' => $netSurplus,
                    'deficit_from_financial_aspect' => $netSurplus < 0 ? abs($netSurplus) : 0,
                ]
            );
        }


        $request->session()->forget('form_data');

        return redirect()->route('success', ['referenceNumber' => $referenceNumber]);
    }

    public function showSuccess(Request $request)
    {
        $referenceNumber = $request->route('referenceNumber');
        return view('accreditation.success', ['referenceNumber' => $referenceNumber]);
    }

}
