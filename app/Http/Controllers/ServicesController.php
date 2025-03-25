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
    
        // Fetch all related GeneralInfo records
        $generalInfos = GeneralInfo::where('cda_registration_no', $externalUser->cda_reg_no)
            ->latest() // Order by latest records first
            ->get();   // Fetch all related records
    
        // Pass to the view
        return view('otcservices.cgshistory', compact('generalInfos'));
    }
    

    public function downloadCGS($filename)
    {
        $filePath = base_path('shared/certificates/' . $filename);
    
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found.');
        }
    }
    
    
}
