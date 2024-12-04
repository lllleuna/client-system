<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function create()
    {
        return view('accreditation.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'tc_name' => ['required'],
            'cda_reg_no' => ['required'],
            'cda_reg_date' => ['required'],
            'area' => ['required'],
            'region' => ['required'],
            'province' => ['nullable'],
            'city_municipality' => ['required'],
            'barangay' => ['required'],
            'address' => ['required']
        ]);

        $attributes['user_id'] = auth()->id();
        
        Application::create($attributes);

        return redirect('accreditation/reference');
    }
}
