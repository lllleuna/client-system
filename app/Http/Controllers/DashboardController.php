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
        // Check if user is authenticated (optional because of middleware)
        if (!auth()->user()) {
            return redirect('/');
        }

        // Fetch ExternalUser
        $externalUser = ExternalUser::findOrFail(auth()->id());

        // Fetch GeneralInfo
        $generalInfo = GeneralInfo::where('cda_registration_no', $externalUser->cda_reg_no)
            ->latest()
            ->first();

        // Initialize date difference
        $daysDifference = null;

        if ($generalInfo && $generalInfo->updated_at && $generalInfo->validity_date) {
            $updatedAt = Carbon::parse($generalInfo->updated_at);
            $validityDate = Carbon::parse($generalInfo->validity_date);
            $daysDifference = $updatedAt->diffInDays($validityDate);
        }

        // Pass to view
        return view('dash', compact('generalInfo', 'daysDifference'));
    }
}
