<?php

namespace App\Http\Controllers;

use App\Models\TrainingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrainingRequestConfirmation;

class TrainingRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'training_type' => 'required|in:face-to-face,online',
            'letter_of_intent' => 'required|file|mimes:pdf|max:5120',
        ]);
    
        $file = $request->file('letter_of_intent');
        $timestamp = Carbon::now()->format('Ymd_His');
        $filename = 'training_letter_' . Auth::id() . '_' . $timestamp . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('uploads', $filename, 'shared');
    
        // Generate reference number like TRN-20250415-XYZ123
        $refDate = Carbon::now()->format('Ymd');
        $reference_no = 'TRN-' . $refDate . '-' . strtoupper(Str::random(6));
    
        $trainingRequest = TrainingRequest::create([
            'user_id' => Auth::id(),
            'email' => Auth::user()->email,
            'training_type' => $request->training_type,
            'letter_of_intent' => $filePath,
            'cda_reg_no' => Auth::user()->cda_reg_no ?? null,
            'reference_no' => $reference_no,
        ]);

        if (Auth::check()) {
            $userEmail = Auth::user()->email;
        } else {
            // Handle error, no user authenticated
            return redirect()->route('login')->with('error', 'You must be logged in to submit a training request.');
        }
    
        // Send email
        Mail::to(Auth::user()->email)->send(new TrainingRequestConfirmation(Auth::user(), $reference_no));
    
        return redirect()->route('dashboard')->with('success', 'Training request submitted successfully. Please check your email.');
    }
}