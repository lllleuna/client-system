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
use App\Models\GeneralInfo;
use App\Models\CoopBusiness;
use App\Notifications\SendOtpNotification;
use Illuminate\Support\Facades\Session;
use App\Models\MemberArchive;
use App\Models\UnitArchive;
use App\Models\GovernanceArchive;

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
        // Find the member to be archived
        $member = CoopMembership::findOrFail($id);

        // Archive the member by copying its data to the archive table
        $archivedMember = new MemberArchive();
        $archivedMember->externaluser_id = $member->externaluser_id;
        $archivedMember->firstname = $member->firstname;
        $archivedMember->middlename = $member->middlename;
        $archivedMember->lastname = $member->lastname;
        $archivedMember->sex = $member->sex;
        $archivedMember->role = $member->role;
        $archivedMember->email = $member->email;
        $archivedMember->mobile_no = $member->mobile_no;
        $archivedMember->birthday = $member->birthday;
        $archivedMember->joined_date = $member->joined_date;
        $archivedMember->address = $member->address;
        $archivedMember->sss_enrolled = $member->sss_enrolled;
        $archivedMember->pagibig_enrolled = $member->pagibig_enrolled;
        $archivedMember->philhealth_enrolled = $member->philhealth_enrolled;
        $archivedMember->employment_type = $member->employment_type;
        $archivedMember->share_capital = $member->share_capital;
        $archivedMember->deleted_at = now(); // Store the timestamp of when it was archived
        $archivedMember->table_name = 'members_masterlist';
        $archivedMember->save(); // Save the archived member record

        // Delete the member from the original table
        $member->delete(); 

        // You can call a method to update general counts or other logic if needed
        $this->updateGeneralInfoCounts();

        return response()->json([
            'message' => 'Member archived successfully.'
        ]);
    }

    public function restore($id)
    {
        try {
            // Try to find in MemberArchive first
            $archive = MemberArchive::find($id);
    
            if ($archive) {
                if ($archive->table_name == 'members_masterlist') {
                    // Restore to members_masterlist
                    DB::table('members_masterlist')->insert([
                        'externaluser_id' => $archive->externaluser_id,
                        'firstname' => $archive->firstname,
                        'middlename' => $archive->middlename,
                        'lastname' => $archive->lastname,
                        'sex' => $archive->sex,
                        'role' => $archive->role,
                        'email' => $archive->email,
                        'mobile_no' => $archive->mobile_no,
                        'birthday' => $archive->birthday,
                        'joined_date' => $archive->joined_date,
                        'address' => $archive->address,
                        'sss_enrolled' => $archive->sss_enrolled,
                        'pagibig_enrolled' => $archive->pagibig_enrolled,
                        'philhealth_enrolled' => $archive->philhealth_enrolled,
                        'employment_type' => $archive->employment_type,
                        'share_capital' => $archive->share_capital,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
    
                // Delete from archive
                $archive->delete();
    
            } else {
                // If not found in MemberArchive, try UnitArchive
                $archive = UnitArchive::findOrFail($id);
    
                if ($archive->table_name == 'coop_units') {
                    // Restore to coopunits
                    DB::table('coopunits')->insert([
                        'externaluser_id' => $archive->externaluser_id,
                        'type' => $archive->type,
                        'plate_no' => $archive->plate_no,
                        'mv_file_no' => $archive->mv_file_no,
                        'engine_no' => $archive->engine_no,
                        'chassis_no' => $archive->chassis_no,
                        'ltfrb_case_no' => $archive->ltfrb_case_no,
                        'date_granted' => $archive->date_granted,
                        'date_of_expiry' => $archive->date_of_expiry,
                        'origin' => $archive->origin,
                        'via' => $archive->via,
                        'destination' => $archive->destination,
                        'owned_by' => $archive->owned_by,
                        'member_id' => $archive->member_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
    
                    // Delete from unit archive
                    $archive->delete();

                } elseif ($archive->table_name == 'governance') {
                    $archive = GovernanceArchive::find($id);
                    DB::table('governance_list')->insert([
                        'externaluser_id' => $archive->externaluser_id,
                        'firstname' => $archive->firstname,
                        'middlename' => $archive->middlename,
                        'lastname' => $archive->lastname,
                        'sex' => $archive->sex,
                        'role' => $archive->role,
                        'email' => $archive->email,
                        'mobile_no' => $archive->mobile_no,
                        'birthday' => $archive->birthday,
                        'start_term' => $archive->start_term,
                        'end_term' => $archive->end_term,
                        'address' => $archive->address,
                        'sss_enrolled' => $archive->sss_enrolled,
                        'pagibig_enrolled' => $archive->pagibig_enrolled,
                        'philhealth_enrolled' => $archive->philhealth_enrolled,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $archive->delete();

                }
    
            } 
    
            return redirect()->back()->with('success', 'Record restored successfully.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while restoring the record. Please try again.');
        }
    }
    
    
    public function restoreIndex()
    {
        // Fetch archives from each table
        $memberArchives = MemberArchive::latest()->get();
        $unitArchives = UnitArchive::latest()->get();
        $governanceArchives = GovernanceArchive::latest()->get(); // Fetch Governance Archives
        
        // Merge all archive collections
        $archives = $memberArchives->merge($unitArchives)->merge($governanceArchives);
        
        // Sort all archives by deleted_at descending
        $archives = $archives->sortByDesc('deleted_at');
        
        // Return the view with all the archives
        return view('archives.index', compact('archives'));
    }
    
    
    public function permanentDelete(Request $request)
    {
        $id = $request->id;
        $tableName = $request->table_name;
    
        if ($tableName == 'members_masterlist') {
            $archive = MemberArchive::findOrFail($id);
        } elseif ($tableName == 'coop_units') {
            $archive = UnitArchive::findOrFail($id);
        } elseif ($tableName == 'governance') {
            $archive = GovernanceArchive::findOrFail($id);
        } else {
            // Handle case where table_name is not valid or supported
            return redirect()->back()->with('error', 'Invalid table name.');
        }
    
        $archive->delete();
    
        return redirect()->back()->with('success', 'Record permanently deleted.');
    }
    

    // ---------------------------------------------
    // ------------ General Info ------------------------
    // ---------------------------------------------
    
    public function showGenInfo()
    {
        $user = Auth::user(); 
    
        $externalUser = ExternalUser::where('id', $user->id)->first();
        $generalInfo = CoopGeneralInfo::where('externaluser_id', $user->id)->first();

        $mainrecord = GeneralInfo::where('cda_registration_no', $externalUser->cda_reg_no)->first();

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
    
        return view('myinformation.generalinfo', compact('externalUser', 'generalInfo', 'fullAddress', 'mainrecord'));
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
                'regex:/^(9)\d{9}$/',
                'max:11',
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
            // Check if email has changed
            if ($externalUser->email !== $validatedData['email']) {
                // Generate verification token
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
        
            // Check if contact number has changed
            $updateData = [
                'tc_name' => $validatedData['tc_name'],
                'cda_reg_no' => $validatedData['cda_reg_no'] ?? null,
                'email' => $validatedData['email'],
                'contact_no' => $validatedData['contact_no'],
            ];
        
            if ($externalUser->contact_no !== $validatedData['contact_no']) {
                $otp = rand(100000, 999999); // 6-digit OTP
            
                $externalUser->update([
                    'pending_contact_no' => $validatedData['contact_no'],
                    'contact_otp' => $otp,
                    'contact_otp_expires_at' => now()->addMinutes(10),
                    'contact_no_verified_at' => null, // Reset verification
                ]);
            
                // Send OTP using Vonage
                $contactWithCountryCode = '63' . ltrim($validatedData['contact_no'], '0');
            
                Session::put('pending_contact_verification_id', $externalUser->id);
            
                return redirect()->route('verify.contact')->with('success', 'OTP sent to your new number. Please verify it.');
            }
        
            // Update external user info
            $externalUser->update($updateData);
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

    public function addCoopOwnedUnit(Request $request) 
    {
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
                'max:15',
                Rule::unique('coopunits')->where(fn ($query) => $query->where('externaluser_id', Auth::id())),
            ],
            'chassis_no' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('coopunits')->where(fn ($query) => $query->where('externaluser_id', Auth::id())),
            ],
            'plate_no' => [
                'nullable',
                'string',
                'max:10',
                Rule::unique('coopunits')->where(fn ($query) => $query->where('externaluser_id', Auth::id())),
            ],
            'ltfrb_case_no' => 'nullable|string|max:20', // No uniqueness required
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
        $coopunit = CoopUnit::findOrFail($id);
    
        // Archive the coop owned unit
        $archive = new UnitArchive();
        $archive->externaluser_id = $coopunit->externaluser_id;
        $archive->type = $coopunit->type;
        $archive->plate_no = $coopunit->plate_no;
        $archive->mv_file_no = $coopunit->mv_file_no;
        $archive->engine_no = $coopunit->engine_no;
        $archive->chassis_no = $coopunit->chassis_no;
        $archive->ltfrb_case_no = $coopunit->ltfrb_case_no;
        $archive->date_granted = $coopunit->date_granted;
        $archive->date_of_expiry = $coopunit->date_of_expiry;
        $archive->origin = $coopunit->origin;
        $archive->via = $coopunit->via;
        $archive->destination = $coopunit->destination;
        $archive->owned_by = $coopunit->owned_by;
        $archive->member_id = $coopunit->member_id;
        $archive->deleted_at = now();
        $archive->table_name = 'coop_units';
        $archive->save();
    
        // Delete the coop unit
        $coopunit->delete();
    
        return response()->json([
            'message' => 'Unit archived and deleted successfully.'
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
        $indivunit = CoopUnit::findOrFail($id);
    
        // Archive the individual owned unit
        $archive = new UnitArchive();
        $archive->externaluser_id = $indivunit->externaluser_id;
        $archive->type = $indivunit->type;
        $archive->plate_no = $indivunit->plate_no;
        $archive->mv_file_no = $indivunit->mv_file_no;
        $archive->engine_no = $indivunit->engine_no;
        $archive->chassis_no = $indivunit->chassis_no;
        $archive->ltfrb_case_no = $indivunit->ltfrb_case_no;
        $archive->date_granted = $indivunit->date_granted;
        $archive->date_of_expiry = $indivunit->date_of_expiry;
        $archive->origin = $indivunit->origin;
        $archive->via = $indivunit->via;
        $archive->destination = $indivunit->destination;
        $archive->owned_by = $indivunit->owned_by;
        $archive->member_id = $indivunit->member_id;
        $archive->deleted_at = now();
        $archive->table_name = 'coop_units';
        $archive->save();
    
        // Delete the individual unit
        $indivunit->delete();
    
        return response()->json([
            'message' => 'Unit archived and deleted successfully.'
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
        // Find the officer to delete
        $officer = CoopGovernance::findOrFail($id);
    
        // Archive the officer first
        $archive = new GovernanceArchive();
        $archive->externaluser_id = $officer->externaluser_id;
        $archive->firstname = $officer->firstname;
        $archive->middlename = $officer->middlename;
        $archive->lastname = $officer->lastname;
        $archive->sex = $officer->sex;
        $archive->role = $officer->role;
        $archive->email = $officer->email;
        $archive->mobile_no = $officer->mobile_no;
        $archive->birthday = $officer->birthday;
        $archive->start_term = $officer->start_term;
        $archive->end_term = $officer->end_term;
        $archive->address = $officer->address;
        $archive->sss_enrolled = $officer->sss_enrolled;
        $archive->pagibig_enrolled = $officer->pagibig_enrolled;
        $archive->philhealth_enrolled = $officer->philhealth_enrolled;
        $archive->deleted_at = now();  // Indicating the officer was deleted
        $archive->table_name = 'governance';  // Mark the table name as governance for reference
        $archive->save();  // Save the archive record
    
        // Delete the officer from the original table
        $officer->delete();
    
        // Optional: Update any related data or counts after deletion
        $this->updateGeneralInfoCounts();
    
        return response()->json([
            'message' => 'Officer archived and deleted successfully.'
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

    public function addGrant(Request $request) 
    {
        $validated = $request->validate([
            'date_acquired'   => 'required|date|before_or_equal:today',
            'amount'          => 'required|numeric',
            'source'          => 'required|string|max:200',
            'file_upload'     => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'status_remarks'  => 'nullable|string|max:255',
        ]);        
    
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
    
        // Handle file upload
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
    
            // Create a custom filename (optional)
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Store the file in 'shared/uploads' folder
            $filePath = $file->storeAs('uploads', $filename, 'shared');
    
            // Save the path in database
            $validated['file_upload'] = $filePath;
        }
    
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
            'file_upload'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // Make it nullable for updates
            'status_remarks'  => 'nullable|string|max:255',
        ]); 
    
        // Handle file upload
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
    
            // Create a custom filename
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
    
            // Store the file in 'uploads' folder using 'shared' disk
            $filePath = $file->storeAs('uploads', $filename, 'shared');
    
            // Update the validated array
            $validated['file_upload'] = $filePath;
        } else {
            // If no new file uploaded, keep the old file path
            $validated['file_upload'] = $grant->file_upload;
        }
    
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

    public function addLoan(Request $request)
    {
        $validated = $request->validate([
            'financing_institution' => 'required|string|max:100',
            'acquired_at'           => 'required|date|before_or_equal:today',
            'amount'                => 'required|numeric',
            'utilization'           => 'required',
            'file_upload'           => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'remarks'               => 'nullable|string|max:255',
        ]);
    
        // Handle file upload
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
    
            // Create a custom filename
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
    
            // Store the file in 'uploads' folder using 'shared' disk
            $filePath = $file->storeAs('uploads', $filename, 'shared');
    
            // Add the file path to validated data
            $validated['file_upload'] = $filePath;
        }
    
        // Get the authenticated user and add their ID
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
    
        // Create a new record in the CoopLoan model
        CoopLoan::create($validated);
    
        // Redirect with a success message
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
            'acquired_at'           => 'required|date|before_or_equal:today',
            'amount'                => 'required|numeric',
            'utilization'           => 'required',
            'file_upload'           => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',  // Make file upload optional for updates
            'remarks'               => 'nullable|string|max:255',
        ]);
    
        // Handle file upload (if a new file is uploaded)
        if ($request->hasFile('file_upload')) {
            // Delete the old file if it exists
            if ($loan->file_upload && file_exists(storage_path('app/shared/' . $loan->file_upload))) {
                unlink(storage_path('app/shared/' . $loan->file_upload));
            }
    
            // Handle the new file
            $file = $request->file('file_upload');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $filePath = $file->storeAs('uploads', $filename, 'shared');
    
            // Add the file path to the validated data
            $validated['file_upload'] = $filePath;
        } else {
            // If no file was uploaded, retain the original file path
            $validated['file_upload'] = $loan->file_upload;
        }
    
        // Update the loan with the validated data
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

    public function addTraining(Request $request) 
    {
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
    
        $totalMembers = CoopMembership::where('externaluser_id', $user->id)->count();
    
        $validated['total_members'] = $totalMembers;
    
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

    // --------------------------------------------
    //  -------------- BUSINESS -----------------
    // --------------------------------------------

    public function showBusinesses() 
    {
        $user = Auth::user();

        // Fetch paginated trainings
        $businesses = CoopBusiness::where('externaluser_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('myinformation.businesses', compact('user', 'businesses'));
    }

    // When button Add Grant is clicked
    public function viewBusiness()
    {
        return view('myinformation.editbusinesses', ['business' => null, 'mode' => 'create']);
    }

    public function addBusiness(Request $request)
    {
        $validated = $request->validate([
            'type'                 => 'nullable|string|max:200',
            'nature_of_business'   => 'nullable|string|max:200',
            'starting_capital'     => 'nullable|numeric|min:0',
            'capital_to_date'      => 'nullable|integer|min:0',
            'years_of_existence'   => 'nullable|numeric|min:0',
            'file_upload'          => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'status'               => 'nullable|string|max:200',
            'remarks'              => 'nullable|string|max:200',
        ]);
    
        // Handle file upload
        if ($request->hasFile('file_upload')) {
            // Get the uploaded file
            $file = $request->file('file_upload');
            
            // Generate a unique filename using the current timestamp and the original filename
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            // Store the file in the 'uploads' folder, using the 'shared' disk
            $filePath = $file->storeAs('uploads', $filename, 'shared');
            
            // Add the file path to the validated data
            $validated['file_upload'] = $filePath;
        }
    
        // Add the user ID to the validated data
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
    
        // Create the business record with the validated data
        CoopBusiness::create($validated);
    
        // Redirect with success message
        return redirect()->route('businesses')->with('success', 'Added successfully!');
    }
    
    public function editBusiness($id)
    {
        $business = CoopBusiness::findOrFail($id);
        return view('myinformation.editbusinesses', compact('business'))->with('mode', 'edit');;
    }

    public function updateBusiness(Request $request, $id)
    {
        $business = CoopBusiness::findOrFail($id);
    
        $validated = $request->validate([
            'type'                 => 'nullable|string|max:200',
            'nature_of_business'   => 'nullable|string|max:200',
            'starting_capital'     => 'nullable|numeric|min:0',
            'capital_to_date'      => 'nullable|numeric|min:0',
            'years_of_existence'   => 'nullable|numeric|min:0',
            'file_upload'          => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // Changed to nullable
            'status'               => 'nullable|string|max:200',
            'remarks'              => 'nullable|string|max:200',
        ]);
    
        // Check if the file is being uploaded
        if ($request->hasFile('file_upload')) {
            // Get the uploaded file
            $file = $request->file('file_upload');
            
            // Generate a unique filename using the current timestamp and the original filename
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            // Store the file in the 'uploads' folder using the 'shared' disk
            $filePath = $file->storeAs('uploads', $filename, 'shared');
            
            // Add the new file path to the validated data
            $validated['file_upload'] = $filePath;
        } else {
            // If no new file is uploaded, keep the existing file path
            $validated['file_upload'] = $business->file_upload;
        }
    
        // Update the business record with the validated data
        $business->update($validated);
    
        // Redirect with success message
        return redirect()->route('businesses')->with('success', 'Updated successfully.');
    }
    
    public function destroyBusiness($id)
    {
        $business = CoopBusiness::findOrFail($id); 
        $business->delete(); 


        return response()->json([
            'message' => 'Deleted successfully.'
        ]);
    }

}
