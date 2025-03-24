<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExternalUser;
use App\Models\GeneralInfo;
use Carbon\Carbon;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class CGSRenewalController extends Controller
{
    public function index()
    {
        $externalUser = ExternalUser::findOrFail(auth()->id());

        // Fetch GeneralInfo
        $generalInfo = GeneralInfo::where('cda_registration_no', $externalUser->cda_reg_no)->latest()->first();

        if (!$generalInfo) {
            abort(403, 'No general information found.');
        }

        // Check validity_date
        $validityDate = Carbon::parse($generalInfo->validity_date);
        $now = Carbon::now();
        $twoMonthsAfterNow = $now->copy()->addMonths(2);

        $existingApplication = Application::where('user_id', $externalUser->id)
            ->where('application_type', 'CGS Renewal')
            ->where('status', '!=', 'rejected')
            ->first();

        if ($existingApplication) {
            // Prevent access if conditions met
            return redirect()->route('dashboard')->with('error', 'You already have a pending CGS Renewal application.');
        }

        // Condition: today OR within 2 months after today
        if ($validityDate->lessThanOrEqualTo($twoMonthsAfterNow)) {
            return view('otcservices.cgsrenewal');
        }


        return redirect()->route('dashboard')->with('error', 'CGS is still valid. Renewal not available.');

    }
}
