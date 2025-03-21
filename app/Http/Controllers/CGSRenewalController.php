<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExternalUser;
use App\Models\GeneralInfo;
use Carbon\Carbon;

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

        // Condition: today OR within 2 months after today
        if ($validityDate->between($now, $twoMonthsAfterNow) || $validityDate->isSameDay($now)) {
            return view('otcservices.cgsrenewal');
        }

        return redirect()->route('dashboard')->with('error', 'CGS is still valid. Renewal not available.');

    }
}
