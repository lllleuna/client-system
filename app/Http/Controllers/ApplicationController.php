<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function showForm1(Request $request)
    {
        $formData = $request->session()->get('form_data', []);
        return view('accreditation.form1', ['formData' => $formData]);
    }

    public function processForm1(Request $request)
    {
        $validatedData = $request->validate([
            'tc_name' => 'required|string|unique:general_info,name',
            'cda_reg_no' => 'required|string|unique:general_info,cda_registration_no',
            'cda_reg_date' => 'required|date|before:tomorrow',
            'area' => 'required',
            'region' => 'required',
            'province' => 'nullable',
            'city_municipality' => 'required',
            'barangay' => 'required',
            'address' => 'required',
        ]);

        $request->session()->put('form_data', $validatedData);

        return redirect()->route('form2');
    }

    public function showForm2(Request $request)
    {
        $formData = $request->session()->get('form_data', []);
        return view('accreditation.form2', ['formData' => $formData]);
    }

    public function processForm2(Request $request)
    {
        $validatedData = $request->validate([
            'file_upload' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'message' => 'nullable|string|max:300', 
            'consent' => 'required|in:on', 
        ]);
        $validatedData['consent'] = $request->has('consent') ? 1 : 0;
        $filePaths = [];

        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filePath = $file->store('uploads', 'public');
            $filePaths['file_upload'] = $filePath;
        }

        $allFormData = array_merge($request->session()->get('form_data', []), $validatedData, $filePaths);
        $request->session()->put('form_data', $allFormData); 

        return redirect()->route('confirmation');
    }


    public function showConfirmation(Request $request)
    {
        $formData = $request->session()->get('form_data', []);
        return view('accreditation.confirmation', ['formData' => $formData]);
    }

    public function submitForm(Request $request)
    {
        $allFormData = $request->session()->get('form_data', []);

        $user = Auth::user();
        $allFormData['user_id'] = $user->id;

        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filePath = $file->store('uploads', 'public');
            $allFormData['file_path'] = $filePath;
        }

        $application = Application::create($allFormData);
        $referenceNumber = 'APP-' . str_pad($application->id, 6, '0', STR_PAD_LEFT);
        $application->update(['reference_number' => $referenceNumber]);
        $request->session()->forget('form_data');

        return redirect()->route('success', ['referenceNumber' => $referenceNumber]);
    }

    public function showSuccess(Request $request)
    {
        $referenceNumber = $request->route('referenceNumber');
        return view('accreditation.success', ['referenceNumber' => $referenceNumber]);
    }

}
