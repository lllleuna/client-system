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
        // Ensure the user is authenticated before proceeding
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit a training request.');
        }

        // Validate incoming request
        $request->validate([
            'training_type' => 'required|in:face-to-face,online',
            'letter_of_intent' => 'required|file|mimes:pdf|max:5120',
        ]);
        
        // Retrieve the authenticated user
        $user = Auth::user();
        $userEmail = $user->email; // Retrieve the user's email

        // Handle file upload for the letter of intent
        $file = $request->file('letter_of_intent');
        $timestamp = Carbon::now()->format('Ymd_His');
        $filename = 'training_letter_' . $user->id . '_' . $timestamp . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('uploads', $filename, 'shared');
        
        // Generate reference number like TRN-20250415-XYZ123
        $refDate = Carbon::now()->format('Ymd');
        $reference_no = 'TRN-' . $refDate . '-' . strtoupper(Str::random(6));

        // Create the training request record in the database
        $trainingRequest = TrainingRequest::create([
            'user_id' => $user->id,
            'email' => $userEmail, // Store user's email
            'training_type' => $request->training_type,
            'letter_of_intent' => $filePath,
            'cda_reg_no' => $user->cda_reg_no ?? null, // If CDA reg no exists, use it
            'reference_no' => $reference_no,
        ]);

        // Send confirmation email to the user
        Mail::to($userEmail)->send(new TrainingRequestConfirmation($user, $reference_no));
    
        // Redirect the user with a success message
        return redirect()->route('dashboard')->with('success', 'Training request submitted successfully. Please check your email.');
    }
}
