<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralInfo;
use App\Models\ExternalUser;

class ServicesController extends Controller
{
    public function cgs() {
        // Fetch ExternalUser
        $externalUser = ExternalUser::findOrFail(auth()->id());
    
        // Fetch GeneralInfo
        $generalInfo = GeneralInfo::where('cda_registration_no', $externalUser->cda_reg_no)
            ->latest()
            ->first();
    
        // Pass generalInfo to view
        return view('otcservices.cgshistory', compact('generalInfo'));
    }

    public function downloadCGS($filename)
    {
        $filePath = public_path('storage/certificates/' . $filename);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found.');
        }
    }

    
}
