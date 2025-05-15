<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExternalUser;
use App\Models\GeneralInfo;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is authenticated (middleware already handles this, optional)
        if (!auth()->user()) {
            return redirect('/');
        }

        // Fetch ExternalUser
        $externalUser = ExternalUser::findOrFail(auth()->id());

        // Fetch GeneralInfo (latest record)
        $generalInfo = GeneralInfo::where('cda_registration_no', $externalUser->cda_reg_no)
            ->latest()
            ->first();

        // Initialize date difference
        $daysDifference = null;

        // Check if $generalInfo exists before accessing properties
        if ($generalInfo) {
            if ($generalInfo->updated_at && $generalInfo->validity_date) {
                $updatedAt = Carbon::parse($generalInfo->updated_at);
                $validityDate = Carbon::parse($generalInfo->validity_date);
                $daysDifference = $updatedAt->diffInDays($validityDate);
            }
        }

        // Even if null, pass safely
        return view('dash', compact('generalInfo', 'daysDifference', 'externalUser'));
    }
}
