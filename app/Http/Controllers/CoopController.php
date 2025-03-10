<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CoopMembership;
use App\Models\ExternalUser;

class CoopController extends Controller
{
    public function showMembers() {
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
        ]);
        
        $user = Auth::user();
        $validated['externaluser_id'] = $user->id;
        CoopMembership::create($validated);
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
        'email'       => 'required|email|max:255|unique:members_masterlist,email',
        'mobile_no'   => ['required', 'regex:/^63\d{10}$/'], 
        'birthday'    => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'), 
        'joined_date' => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
        'address'     => 'required|string|max:200',
    ]);

    $membership->update($validated);

    return redirect()->route('membersMasterlist')->with('success', 'Member updated successfully.');
}


}
