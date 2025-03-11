<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CoopMembership;
use App\Models\ExternalUser;
use Illuminate\Validation\Rule;
use App\Models\CoopGeneralInfo;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\EmailVerificationMail;

class CoopController extends Controller
{
    // ---------------------------------------------
    // ------------ MEMBERS ------------------------
    // ---------------------------------------------

    public function showMembers() 
    {
        $user = Auth::user();
        $coopMemberships = CoopMembership::where('externaluser_id', $user->id)
            ->orderBy('created_at', 'desc') // Sorts by newest first
            ->paginate(10);
    
        return view('myinformation.membersMasterlist', compact('user', 'coopMemberships'));
    }

    public function viewMember()
    {
        return view('myinformation.addMember', ['membership' => null, 'mode' => 'create']);
    }
    
    public function addMember(Request $request) {
        $validated = $request->validate([
            'firstname'   => 'required|string|max:100',
            'middlename'  => 'nullable|string|max:100',
            'lastname'    => 'required|string|max:100',
            'sex'         => 'required|in:Male,Female',
            'role'        => 'required|string|max:100',
            'email'       => 'required|email|max:255|unique:members_masterlist,email',
            'mobile_no'   => ['required', 'regex:/^63\d{10}$/'], 
            'birthday'    => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'), 
            'joined_date' => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'address'     => 'required|string|max:200',
            'sss_enrolled' => 'nullable|boolean',
            'pagibig_enrolled' => 'nullable|boolean',
            'philhealth_enrolled' => 'nullable|boolean',
        ]);
        
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
        CoopMembership::create($validated);

        $this->updateGeneralInfoCounts();

        return redirect()->route('membersMasterlist')->with('success', 'Member added successfully!');
    }

    public function editMember($id)
    {
        $membership = CoopMembership::findOrFail($id);
        return view('myinformation.addMember', compact('membership'))->with('mode', 'edit');;
    }

    public function updateMember(Request $request, $id)
    {
        $membership = CoopMembership::findOrFail($id);

        $validated = $request->validate([
            'firstname'   => 'required|string|max:100',
            'middlename'  => 'nullable|string|max:100',
            'lastname'    => 'required|string|max:100',
            'sex'         => 'required|in:Male,Female',
            'role'        => 'required|string|max:100',
            'email'       => [
                'required',
                'email',
                'max:255',
                Rule::unique('members_masterlist')->ignore($membership->id),
            ],
            'mobile_no'   => [
                'required',
                'regex:/^63\d{10}$/', 
                Rule::unique('members_masterlist')->ignore($membership->id),
            ], 
            'birthday'    => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'), 
            'joined_date' => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'address'     => 'required|string|max:200',
            'sss_enrolled' => 'boolean', // Now always receives 0 or 1
            'pagibig_enrolled' => 'boolean',
            'philhealth_enrolled' => 'boolean',
        ]);

        // Update member record
        $membership->update($validated);
        $this->updateGeneralInfoCounts();

        return redirect()->route('membersMasterlist')->with('success', 'Member updated successfully.');
    }

    private function updateGeneralInfoCounts()
    {
        $user = Auth::user(); 
    
        $totalSSS = CoopMembership::where('externaluser_id', $user->id)->where('sss_enrolled', 1)->count();
        $totalPagibig = CoopMembership::where('externaluser_id', $user->id)->where('pagibig_enrolled', 1)->count();
        $totalPhilhealth = CoopMembership::where('externaluser_id', $user->id)->where('philhealth_enrolled', 1)->count();
    
        CoopGeneralInfo::updateOrCreate(
            ['externaluser_id' => $user->id], 
            [
                'total_sss_enrolled' => $totalSSS,
                'total_pagibig_enrolled' => $totalPagibig,
                'total_philhealth_enrolled' => $totalPhilhealth,
            ]
        );
    }
    

    public function destroyMember($id)
    {
        $member = CoopMembership::findOrFail($id); // Find the member
        $member->delete(); // Delete the member

        $this->updateGeneralInfoCounts();

        return response()->json([
            'message' => 'Member deleted successfully.'
        ]);
    }

    // ---------------------------------------------
    // ------------ General Info ------------------------
    // ---------------------------------------------
    
    public function showGenInfo()
    {
        $user = Auth::user(); 
    
        $externalUser = ExternalUser::where('id', $user->id)->first();
        $generalInfo = CoopGeneralInfo::where('externaluser_id', $user->id)->first();
    
        // Check if generalInfo exists
        if ($generalInfo) {
            // Fetch location names from PSGC API
            $barangay = Http::get("https://psgc.gitlab.io/api/barangays/{$generalInfo->barangay_code}")->json();
            $city = Http::get("https://psgc.gitlab.io/api/cities/{$generalInfo->city_code}")->json();
            $province = Http::get("https://psgc.gitlab.io/api/provinces/{$generalInfo->province_code}")->json();
            $region = Http::get("https://psgc.gitlab.io/api/regions/{$generalInfo->region_code}")->json();
    
            // Extract names or fallback to "Unknown"
            $barangayName = $barangay['name'] ?? '';
            $cityName = $city['name'] ?? '';
            $provinceName = $province['name'] ?? '';
            $regionName = $region['name'] ?? '';
    
            // Construct full business address
            $fullAddress = "{$generalInfo->business_address} {$barangayName} {$cityName} {$provinceName} {$regionName}";
        } else {
            $fullAddress = "Not Available";
        }
    
        return view('myinformation.generalinfo', compact('externalUser', 'generalInfo', 'fullAddress'));
    }
    
    public function editGeneralInfo()
    {
        $user = Auth::user();
        
        $externalUser = ExternalUser::where('id', $user->id)->first();
        $generalInfo = CoopGeneralInfo::where('externaluser_id', $user->id)->first();

        if (!$generalInfo) {
            return redirect()->route('dashboard')->with('error', 'No general information found.');
        }

        return view('myinformation.editgeneralinfo', compact('externalUser', 'generalInfo'));
    }

    public function updateGeneralInfo(Request $request)
    {
        $user = Auth::user();
    
        $validatedData = $request->validate([
            'tc_name' => 'required|string|max:100',
            'business_address' => 'required|string|max:150',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('externalusers', 'email')->ignore($user->id),
            ],
            'contact_no' => [
                'required',
                'regex:/^(639)\d{9}$/',
                'max:12',
                Rule::unique('externalusers', 'contact_no')->ignore($user->id),
            ],
            'cda_reg_no' => 'nullable|string|max:50',
            'cda_registration_date' => 'nullable|date|before_or_equal:today',
            'common_bond_membership' => 'nullable|string|max:255',
            'membership_fee' => 'nullable|numeric|min:0',
            'employer_sss_reg_no' => 'nullable|string|max:50',
            'employer_pagibig_reg_no' => 'nullable|string|max:50',
            'employer_philhealth_reg_no' => 'nullable|string|max:50',
            'bir_tin' => 'nullable|string|max:50',
            'bir_tax_exemption_no' => 'nullable|string|max:50',
            'bir_validity' => 'required|date|after_or_equal:today|before_or_equal:' . now()->addYears(5)->toDateString(),
        ]);
    
        $externalUser = ExternalUser::where('id', $user->id)->first();
    
        if ($externalUser) {
            if ($externalUser->email !== $validatedData['email']) {
                // Generate a verification token
                $verificationToken = Str::random(32);
    
                // Save pending email and token
                $externalUser->update([
                    'pending_email' => $validatedData['email'],
                    'email_verification_token' => $verificationToken,
                ]);
    
                // Send verification email
                Mail::to($validatedData['email'])->send(new EmailVerificationMail($externalUser));
    
                return redirect()->route('generalinfo')->with('success', 'Verification email sent. Please verify your email before updating.');
            }
    
            // If email is not changed, update normally
            $externalUser->update([
                'tc_name' => $validatedData['tc_name'],
                'cda_reg_no' => $validatedData['cda_reg_no'] ?? null,
                'email' => $validatedData['email'],
                'contact_no' => $validatedData['contact_no'],
            ]);
        }

        $generalInfo = CoopGeneralInfo::updateOrCreate(
            ['externaluser_id' => $user->id], 
            [
                'business_address' => $validatedData['business_address'],
                'email' => $validatedData['email'],
                'contact_no' => $validatedData['contact_no'],
                'cda_registration_date' => $validatedData['cda_registration_date'] ?? null,
                'common_bond_membership' => $validatedData['common_bond_membership'] ?? null,
                'membership_fee' => $validatedData['membership_fee'] ?? null,
                'employer_sss_reg_no' => $validatedData['employer_sss_reg_no'] ?? null,
                'employer_pagibig_reg_no' => $validatedData['employer_pagibig_reg_no'] ?? null,
                'employer_philhealth_reg_no' => $validatedData['employer_philhealth_reg_no'] ?? null,
                'bir_tin' => $validatedData['bir_tin'] ?? null,
                'bir_tax_exemption_no' => $validatedData['bir_tax_exemption_no'] ?? null,
                'bir_validity' => $validatedData['bir_validity'] ?? null,
            ]
        );
        

        return redirect()->route('generalinfo')->with('success', 'General Information updated successfully.');
    }
    
    


}
