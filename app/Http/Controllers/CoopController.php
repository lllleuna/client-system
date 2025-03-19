<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\EmailVerificationMail;
use App\Models\ExternalUser;
use App\Models\CoopMembership;
use App\Models\CoopGeneralInfo;
use App\Models\CoopUnit; // invidividually and coop owned
use App\Models\CoopGovernance;
use App\Models\CoopGrants;
use App\Models\CoopLoan;
use App\Models\CoopTraining;
use App\Models\CoopAward;

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
            'mobile_no'   => ['required', 'regex:/^639\d{9}$/'], 
            'birthday'    => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'), 
            'joined_date' => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'address'     => 'required|string|max:200',
            'sss_enrolled' => 'nullable|boolean',
            'pagibig_enrolled' => 'nullable|boolean',
            'philhealth_enrolled' => 'nullable|boolean',
            'employment_type' => 'nullable|string',
            'share_capital' => 'nullable|numeric',
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
                'regex:/^639\d{9}$/', 
                Rule::unique('members_masterlist')->ignore($membership->id),
            ], 
            'birthday'    => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'), 
            'joined_date' => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'address'     => 'required|string|max:200',
            'sss_enrolled' => 'boolean', // Now always receives 0 or 1
            'pagibig_enrolled' => 'boolean',
            'philhealth_enrolled' => 'boolean',
            'employment_type' => 'nullable|string',
            'share_capital' => 'nullable|numeric',
        ]);

        // Update member record
        $membership->update($validated);
        $this->updateGeneralInfoCounts();

        return redirect()->route('membersMasterlist')->with('success', 'Member updated successfully.');
    }

    private function updateGeneralInfoCounts()
    {
        $user = Auth::user(); 
    
        // Count SSS, Pag-IBIG, and PhilHealth from CoopMembership
        $totalSSS = CoopMembership::where('externaluser_id', $user->id)->where('sss_enrolled', 1)->count();
        $totalPagibig = CoopMembership::where('externaluser_id', $user->id)->where('pagibig_enrolled', 1)->count();
        $totalPhilhealth = CoopMembership::where('externaluser_id', $user->id)->where('philhealth_enrolled', 1)->count();
    
        // Add counts from CoopGovernance (instead of overwriting)
        $totalSSS += CoopGovernance::where('externaluser_id', $user->id)->where('sss_enrolled', 1)->count();
        $totalPagibig += CoopGovernance::where('externaluser_id', $user->id)->where('pagibig_enrolled', 1)->count();
        $totalPhilhealth += CoopGovernance::where('externaluser_id', $user->id)->where('philhealth_enrolled', 1)->count();
    
         /** COUNT MEMBERS MASTERLIST **/
    
        $roles = ['Driver', 'Operator', 'Allied'];
        $employmentTypes = ['Regular', 'Probationary'];
        $sexes = ['Male', 'Female'];

        $counts = [];

        foreach ($roles as $role) {
            foreach ($employmentTypes as $employmentType) {
                foreach ($sexes as $sex) {
                    $count = CoopMembership::where('externaluser_id', $user->id)
                        ->where('role', $role)
                        ->where('employment_type', $employmentType)
                        ->where('sex', $sex)
                        ->count();

                    // Format the key e.g., driver_regular_male
                    $key = strtolower(str_replace(' ', '_', $role)) . '_' . strtolower($employmentType) . '_' . strtolower($sex);
                    $counts[$key] = $count;
                }
            }
        }
        
        // Update or create the general info record
        CoopGeneralInfo::updateOrCreate(
            ['externaluser_id' => $user->id], 
            [
                'total_sss_enrolled' => $totalSSS,
                'total_pagibig_enrolled' => $totalPagibig,
                'total_philhealth_enrolled' => $totalPhilhealth,
            ]
        );

        CoopGeneralInfo::updateOrCreate(
            ['externaluser_id' => $user->id],
            $counts
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

        $this->updateGeneralInfoCounts();

        return redirect()->route('generalinfo')->with('success', 'General Information updated successfully.');
    }
    
    // --------------------------------------------
    //  ------- COOPERATIVE OWNED UNITS -----------
    // --------------------------------------------

    public function showCoopOwnedUnits() {
        $user = Auth::user();
    
        $coopUnits = CoopUnit::where('externaluser_id', $user->id)
            ->where('owned_by', 'coop') // Only fetch units owned by cooperatives
            ->orderBy('created_at', 'desc') // Sort by newest first
            ->paginate(10);
    
        return view('myinformation.cooperativeowned', compact('user', 'coopUnits'));
    }
    
    public function viewCoopOwnedUnit()
    {
        return view('myinformation.editcooperativeowned', ['coopunit' => null, 'mode' => 'create']);
    }

    public function addCoopOwnedUnit(Request $request) {
        $validated = $request->validate([
            'type' => 'nullable|string|max:50',
            'mv_file_no' => [
                'nullable',
                'string',
                'max:15',
                Rule::unique('coopunits')->where(fn ($query) => $query->where('externaluser_id', Auth::id())),
            ],
            'engine_no' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('coopunits')->where(fn ($query) => $query->where('externaluser_id', Auth::id())),
            ],
            'chassis_no' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('coopunits')->where(fn ($query) => $query->where('externaluser_id', Auth::id())),
            ],
            'plate_no' => [
                'nullable',
                'string',
                'max:10',
                Rule::unique('coopunits')->where(fn ($query) => $query->where('externaluser_id', Auth::id())),
            ],
            'ltfrb_case_no' => 'nullable|string|max:50', // No uniqueness required
            'date_granted' => 'nullable|date|before_or_equal:today',
            'date_of_expiry' => 'nullable|date',
            'origin' => 'nullable|string|max:100',
            'via' => 'nullable|string|max:100',
            'destination' => 'nullable|string|max:100',
        ]);
        
        
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
        $validated['owned_by'] = "coop";
        CoopUnit::create($validated);

        return redirect()->route('cooperativeowned')->with('success', 'Unit added successfully!');
    }

    public function editCoopOwnedUnit($id)
    {
        $coopunit = CoopUnit::findOrFail($id);
        return view('myinformation.editcooperativeowned', compact('coopunit'))->with('mode', 'edit');;
    }

    public function updateCoopOwnedUnit(Request $request, $id)
    {
        $coopunit = CoopUnit::findOrFail($id);

        $validated = $request->validate([
            'type' => 'nullable|string|max:50',
            'mv_file_no' => [
                'nullable',
                'string',
                'max:15',
                Rule::unique('coopunits')
                    ->where(fn ($query) => $query->where('externaluser_id', Auth::id()))
                    ->ignore($id), // Ignore the current record
            ],
            'engine_no' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('coopunits')
                    ->where(fn ($query) => $query->where('externaluser_id', Auth::id()))
                    ->ignore($id),
            ],
            'chassis_no' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('coopunits')
                    ->where(fn ($query) => $query->where('externaluser_id', Auth::id()))
                    ->ignore($id),
            ],
            'plate_no' => [
                'nullable',
                'string',
                'max:10',
                Rule::unique('coopunits')
                    ->where(fn ($query) => $query->where('externaluser_id', Auth::id()))
                    ->ignore($id),
            ],
            'ltfrb_case_no' => 'nullable|string|max:50', // No uniqueness required
            'date_granted' => 'nullable|date|before_or_equal:today',
            'date_of_expiry' => 'nullable|date',
            'origin' => 'nullable|string|max:100',
            'via' => 'nullable|string|max:100',
            'destination' => 'nullable|string|max:100',
        ]);

        // Update the record
        $coopunit->update($validated);

        return redirect()->route('cooperativeowned')->with('success', 'Unit updated successfully.');
    }

    public function destroyCoopOwnedUnit($id)
    {
        $coopunit = CoopUnit::findOrFail($id); // Find the member
        $coopunit->delete(); // Delete the member


        return response()->json([
            'message' => 'Unit deleted successfully.'
        ]);
    }

    // --------------------------------------------
    //  ------- INDIVIDUALLY OWNED UNITS ----------
    // --------------------------------------------

    public function showIndivOwnedUnits() {

        $user = Auth::user();
    
        $indivUnits = CoopUnit::where('externaluser_id', $user->id)
            ->where('owned_by', 'individual') // Only fetch units owned by cooperatives
            ->orderBy('created_at', 'desc') // Sort by newest first
            ->paginate(10);
    
        return view('myinformation.individuallyowned', compact('user', 'indivUnits'));

    }

    public function viewIndivOwnedUnit()
    {
        $user = Auth::user(); // Get logged-in user
        $members = CoopMembership::where('externaluser_id', $user->id)->get();
    
        return view('myinformation.editindividuallyowned', [
            'indivunit' => null,
            'mode' => 'create',
            'members' => $members
        ]);
    }

    public function addIndivOwnedUnit(Request $request) {
        $validated = $request->validate([
            'type' => 'nullable|string|max:50',
            'mv_file_no' => [
                'nullable',
                'string',
                'max:15',
                Rule::unique('coopunits')->where(fn ($query) => $query->where('externaluser_id', Auth::id())),
            ],
            'engine_no' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('coopunits')->where(fn ($query) => $query->where('externaluser_id', Auth::id())),
            ],
            'chassis_no' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('coopunits')->where(fn ($query) => $query->where('externaluser_id', Auth::id())),
            ],
            'plate_no' => [
                'nullable',
                'string',
                'max:10',
                Rule::unique('coopunits')->where(fn ($query) => $query->where('externaluser_id', Auth::id())),
            ],
            'ltfrb_case_no' => 'nullable|string|max:50', // No uniqueness required
            'date_granted' => 'nullable|date|before_or_equal:today',
            'date_of_expiry' => 'nullable|date',
            'origin' => 'nullable|string|max:100',
            'via' => 'nullable|string|max:100',
            'destination' => 'nullable|string|max:100',
            'member_id' => 'required',
        ]);
        
        
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
        $validated['owned_by'] = "individual";
        CoopUnit::create($validated);

        return redirect()->route('individuallyowned')->with('success', 'Unit added successfully!');
    }

    public function editIndivOwnedUnit($id)
    {
        $user = Auth::user();
        $indivunit = CoopUnit::findOrFail($id);
        $members = CoopMembership::where('externaluser_id', $user->id)->get();

        return view('myinformation.editindividuallyowned', compact('indivunit', 'members'))->with('mode', 'edit');
    }

    public function updateIndivOwnedUnit(Request $request, $id)
    {
        $indivunit = CoopUnit::findOrFail($id);

        $validated = $request->validate([
            'type' => 'nullable|string|max:50',
            'mv_file_no' => [
                'nullable',
                'string',
                'max:15',
                Rule::unique('coopunits')
                    ->where(fn ($query) => $query->where('externaluser_id', Auth::id()))
                    ->ignore($id), // Ignore the current record
            ],
            'engine_no' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('coopunits')
                    ->where(fn ($query) => $query->where('externaluser_id', Auth::id()))
                    ->ignore($id),
            ],
            'chassis_no' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('coopunits')
                    ->where(fn ($query) => $query->where('externaluser_id', Auth::id()))
                    ->ignore($id),
            ],
            'plate_no' => [
                'nullable',
                'string',
                'max:10',
                Rule::unique('coopunits')
                    ->where(fn ($query) => $query->where('externaluser_id', Auth::id()))
                    ->ignore($id),
            ],
            'ltfrb_case_no' => 'nullable|string|max:50', // No uniqueness required
            'date_granted' => 'nullable|date|before_or_equal:today',
            'date_of_expiry' => 'nullable|date',
            'origin' => 'nullable|string|max:100',
            'via' => 'nullable|string|max:100',
            'destination' => 'nullable|string|max:100',
            'member_id' => 'required',
        ]);

        // Update the record
        $indivunit->update($validated);

        return redirect()->route('individuallyowned')->with('success', 'Unit updated successfully.');
    }

    public function destroyIndivOwnedUnit($id)
    {
        $indivunit = CoopUnit::findOrFail($id); // Find the member
        $indivunit->delete(); // Delete the member


        return response()->json([
            'message' => 'Unit deleted successfully.'
        ]);
    }

    // --------------------------------------------
    //  -------------- Employment -------------------
    // --------------------------------------------

    public function showEmployment() 
    {
        $user = Auth::user();
        $coopEmployment = CoopGeneralInfo::where('externaluser_id', $user->id)->first();
    
        return view('myinformation.employment', compact('user', 'coopEmployment'));
    }

    // --------------------------------------------
    //  -------------- GOVERNANCE -------------------
    // --------------------------------------------

    public function showOfficers() 
    {
        $user = Auth::user();
        $coopOfficers = CoopGovernance::where('externaluser_id', $user->id)
            ->orderBy('created_at', 'desc') // Sorts by newest first
            ->paginate(10);
    
        return view('myinformation.officers', compact('user', 'coopOfficers'));
    }

    public function viewOfficer()
    {
        return view('myinformation.editofficers', ['officer' => null, 'mode' => 'create']);
    }

    public function addOfficer(Request $request) {
        $validated = $request->validate([
            'firstname'   => 'required|string|max:100',
            'middlename'  => 'nullable|string|max:100',
            'lastname'    => 'required|string|max:100',
            'sex'         => 'required|in:Male,Female',
            'role'        => 'required|string|max:100',
            'email'       => 'required|email|max:255|unique:governance_list,email',
            'mobile_no'   => ['required', 'regex:/^639\d{9}$/'], 
            'birthday'    => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'), 
            'start_term' => 'required|date',  
            'end_term' => 'required|date|after_or_equal:' . now()->format('Y-m-d'),

            'address'     => 'required|string|max:200',
            'sss_enrolled' => 'nullable|boolean',
            'pagibig_enrolled' => 'nullable|boolean',
            'philhealth_enrolled' => 'nullable|boolean',

        ]);
        
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
        CoopGovernance::create($validated);

        $this->updateGeneralInfoCounts();

        return redirect()->route('officerslist')->with('success', 'Officer added successfully!');
    }
    public function editOfficer($id)
    {
        $officer = CoopGovernance::findOrFail($id);
        return view('myinformation.editofficers', compact('officer'))->with('mode', 'edit');;
    }

    public function updateOfficer(Request $request, $id)
    {
        $governance = CoopGovernance::findOrFail($id);

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
                Rule::unique('governance_list')->ignore($governance->id),
            ],
            'mobile_no'   => [
                'required',
                'regex:/^639\d{9}$/', 
                Rule::unique('governance_list')->ignore($governance->id),
            ], 
            'birthday'    => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'), 
            'start_term' => 'required|date',  
            'end_term' => 'required|date|after_or_equal:' . now()->format('Y-m-d'),

            'address'     => 'required|string|max:200',
            'sss_enrolled' => 'boolean',
            'pagibig_enrolled' => 'boolean',
            'philhealth_enrolled' => 'boolean',
        ]);

        // Update member record
        $governance->update($validated);
        $this->updateGeneralInfoCounts();

        return redirect()->route('officerslist')->with('success', 'Officer updated successfully.');
    }

    public function destroyOfficer($id)
    {
        $officer = CoopGovernance::findOrFail($id); // Find the member
        $officer->delete(); // Delete the member

        $this->updateGeneralInfoCounts();

        return response()->json([
            'message' => 'Officer deleted successfully.'
        ]);
    }

    // --------------------------------------------
    //  ----------- GRANTS AND DONATIONS ----------
    // --------------------------------------------

    public function showGrants() 
    {
        $user = Auth::user();

        // Fetch grants/donations paginated
        $coopGrants = CoopGrants::where('externaluser_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get totals per year
        $grantsPerYear = CoopGrants::selectRaw('YEAR(date_acquired) as year, SUM(amount) as total_amount, COUNT(*) as total_grants')
            ->where('externaluser_id', $user->id)
            ->groupByRaw('YEAR(date_acquired)')
            ->orderBy('year', 'desc')
            ->get();

        return view('myinformation.grants', compact('user', 'coopGrants', 'grantsPerYear'));
    }

    // When button Add Grant is clicked
    public function viewGrant()
    {
        return view('myinformation.editgrants', ['grant' => null, 'mode' => 'create']);
    }

    public function addGrant(Request $request) {
        $validated = $request->validate([
            'date_acquired' => 'required|date|before_or_equal:today',
            'amount'          => 'required|numeric',
            'source'          => 'required|string|max:200',
            'status_remarks'  => 'nullable|string|max:255',
        ]);        
        
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
        CoopGrants::create($validated);

        return redirect()->route('grants')->with('success', 'Added successfully!');
    }

    public function editGrant($id)
    {
        $grant = CoopGrants::findOrFail($id);
        return view('myinformation.editgrants', compact('grant'))->with('mode', 'edit');;
    }

    public function updateGrant(Request $request, $id)
    {
        $grant = CoopGrants::findOrFail($id);

        $validated = $request->validate([
            'date_acquired'   => 'required|date',
            'amount'          => 'required|numeric',
            'source'          => 'required|string|max:200',
            'status_remarks'  => 'nullable|string|max:255',
        ]); 

        $grant->update($validated);

        return redirect()->route('grants')->with('success', 'Updated successfully.');
    }

    public function destroyGrant($id)
    {
        $grant = CoopGrants::findOrFail($id); 
        $grant->delete(); 


        return response()->json([
            'message' => 'Deleted successfully.'
        ]);
    }

    // --------------------------------------------
    //  --------------- LOANS --------------------
    // --------------------------------------------

    public function showLoans() 
    {
        $user = Auth::user();

        // Fetch paginated loans
        $Loans = CoopLoan::where('externaluser_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Group by year, total amount & count
        $loansPerYear = CoopLoan::selectRaw('YEAR(acquired_at) as year, SUM(amount) as total_amount, COUNT(*) as total_loans')
            ->where('externaluser_id', $user->id)
            ->groupByRaw('YEAR(acquired_at)')
            ->orderBy('year', 'desc')
            ->get();

        return view('myinformation.loans', compact('user', 'Loans', 'loansPerYear'));
    }

    // When button Add Grant is clicked
    public function viewLoan()
    {
        return view('myinformation.editloans', ['loan' => null, 'mode' => 'create']);
    }

    public function addLoan(Request $request) {
        $validated = $request->validate([
            'financing_institution' => 'required|string|max:100',
            'acquired_at'          => 'required|date|before_or_equal:today',
            'amount'          => 'required|numeric',
            'utilization'  => 'required',
            'remarks'  => 'nullable|string|max:255',
        ]);        
        
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
        CoopLoan::create($validated);

        return redirect()->route('loans')->with('success', 'Added successfully!');
    }

    public function editLoan($id)
    {
        $loan = CoopLoan::findOrFail($id);
        return view('myinformation.editloans', compact('loan'))->with('mode', 'edit');;
    }

    public function updateLoan(Request $request, $id)
    {
        $loan = CoopLoan::findOrFail($id);

        $validated = $request->validate([
            'financing_institution' => 'required|string|max:100',
            'acquired_at'          => 'required|date|before_or_equal:today',
            'amount'          => 'required|numeric',
            'utilization'  => 'required',
            'remarks'  => 'nullable|string|max:255',
        ]); 

        $loan->update($validated);

        return redirect()->route('loans')->with('success', 'Updated successfully.');
    }

    public function destroyLoan($id)
    {
        $loan = CoopLoan::findOrFail($id); 
        $loan->delete(); 


        return response()->json([
            'message' => 'Deleted successfully.'
        ]);
    }

    // --------------------------------------------
    //  ------- TRAININGS AND SEMINAR --------------
    // --------------------------------------------

    public function showTrainings() 
    {
        $user = Auth::user();

        // Fetch paginated trainings
        $trainings = CoopTraining::where('externaluser_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Group total funds by year (from start_date)
        $yearlyTotals = CoopTraining::select(
                DB::raw('YEAR(start_date) as year'),
                DB::raw('SUM(total_fund) as total_fund')
            )
            ->where('externaluser_id', $user->id)
            ->groupBy(DB::raw('YEAR(start_date)'))
            ->orderBy('year', 'desc')
            ->get();

        return view('myinformation.trainings', compact('user', 'trainings', 'yearlyTotals'));
    }

    // When button Add Grant is clicked
    public function viewTraining()
    {
        return view('myinformation.edittrainings', ['training' => null, 'mode' => 'create']);
    }

    public function addTraining(Request $request) {
        $validated = $request->validate([
            'title_of_training' => 'required|string|max:300',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'no_of_attendees'   => 'required|integer|min:1',
            'total_fund'        => 'required|numeric|min:0',
            'remarks'           => 'nullable|string|max:255',
        ]);               
        
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
        CoopTraining::create($validated);

        return redirect()->route('trainings')->with('success', 'Added successfully!');
    }

    public function editTraining($id)
    {
        $training = CoopTraining::findOrFail($id);
        return view('myinformation.edittrainings', compact('training'))->with('mode', 'edit');;
    }

    public function updateTraining(Request $request, $id)
    {
        $train = CoopTraining::findOrFail($id);

        $validated = $request->validate([
            'title_of_training' => 'required|string|max:300',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'no_of_attendees'   => 'required|integer|min:1',
            'total_fund'        => 'required|numeric|min:0',
            'remarks'           => 'nullable|string|max:255',
        ]);
        

        $train->update($validated);

        return redirect()->route('trainings')->with('success', 'Updated successfully.');
    }

    public function destroyTraining($id)
    {
        $train = CoopTraining::findOrFail($id); 
        $train->delete(); 


        return response()->json([
            'message' => 'Deleted successfully.'
        ]);
    }

    // --------------------------------------------
    //  --------------- AWARDS --------------------
    // --------------------------------------------

    public function showAwards() 
    {
        $user = Auth::user();

        // Fetch paginated trainings
        $awards = CoopAward::where('externaluser_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('myinformation.awards', compact('user', 'awards'));
    }

    // When button Add Grant is clicked
    public function viewAward()
    {
        return view('myinformation.editawards', ['award' => null, 'mode' => 'create']);
    }

    public function addAward(Request $request) {
        $validated = $request->validate([
            'awarding_body' => 'required|string|max:300',
            'nature_of_award'        => 'required|string|max:300',
            'date_received'          => 'required|date',
        ]);               
        
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
        CoopAward::create($validated);

        return redirect()->route('awards')->with('success', 'Added successfully!');
    }

    public function editAward($id)
    {
        $award = CoopAward::findOrFail($id);
        return view('myinformation.editawards', compact('award'))->with('mode', 'edit');;
    }

    public function updateAward(Request $request, $id)
    {
        $award = CoopAward::findOrFail($id);

        $validated = $request->validate([
            'awarding_body' => 'required|string|max:300',
            'nature_of_award'        => 'required|string|max:300',
            'date_received'          => 'required|date',
        ]); 
        

        $award->update($validated);

        return redirect()->route('awards')->with('success', 'Updated successfully.');
    }

    public function destroyAward($id)
    {
        $award = CoopAward::findOrFail($id); 
        $award->delete(); 


        return response()->json([
            'message' => 'Deleted successfully.'
        ]);
    }

}
