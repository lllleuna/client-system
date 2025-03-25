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
    
        // Fetch paginated GeneralInfo records related to the user
        $generalInfos = GeneralInfo::where('cda_registration_no', $externalUser->cda_reg_no)
            ->latest() // Order by latest records first
            ->paginate(2); // Paginate with 5 records per page
    
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
