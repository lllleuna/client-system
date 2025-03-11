<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\CoopController;
// use Illuminate\Support\Facades\Auth;

//Login Page
Route::get('/', function () {
    return view('index');
})->name('login');

//Login Page Contact 
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

//Login Page About
Route::get('/about', function () {
    return view('about');
})->name('about');

//Login Page Services
Route::get('/services', function () {
    return view('services');
})->name('services');

//Forgot Password
Route::get('/auth/forgotpassword', function () {
    return view('auth.forgot_password');
})->name('forgotpassword');

//Profile Setting
Route::get('/profilesetting', function () {
    return view('profilesetting');
})->name('profilesetting');


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('users/create', [RegisteredUserController::class, 'show']);
Route::post('users/create', [RegisteredUserController::class, 'store']);


// Logged in portal... DASHBOARD
Route::get('/dash', function () {
    if (!auth()->user()) {
        return redirect('/');
    }

    return view('/dash');
})->middleware(['auth', 'verified']);


// Email Verification ---------------
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// ------------------------------------------

// Setting Up MFA ----------
Route::get('/auth/mfa', function() {
    return view('/auth/mfa');
});
Route::middleware(['auth'])->group(function () {
    Route::post('/send-otp', [RegisteredUserController::class, 'sendOtp'])->name('send.otp');
    Route::post('/verify-otp', [RegisteredUserController::class, 'verifyOtp'])->name('verify.otp');
    Route::post('/auth/resend-otp', [RegisteredUserController::class, 'resendOtp'])->name('resend.otp');
});


//MyInformation 
Route::get('/myinformation/membersMasterlist', [CoopController::class, 'showMembers'])->name('membersMasterlist');
Route::get('/myinformation/member', [CoopController::class, 'viewMember'] )->name('addMemberIndex');
Route::post('/myinformation/member', [CoopController::class, 'addMember'])->name('addMember');
Route::get('/myinformation/member/{id}/view', [CoopController::class, 'editMember'])->name('editMember');
Route::put('/myinformation/member/{id}', [CoopController::class, 'updateMember'])->name('members.update');
Route::delete('/myinformation/member/{id}', [CoopController::class, 'destroyMember'])->name('members.destroy');


//Training List
Route::get('/myinformation/traininglist', function () {
    return view('myinformation.traininglist');
})->name('traininglist');

//Edit Training List
Route::get('/myinformation/editTraining', function () {
    return view('myinformation.editTraining');
})->name('editTraining');

//Cooperative-Owned List
Route::get('/myinformation/cooperativeowned', function () {
    return view('myinformation.cooperativeowned');
})->name('cooperativeowned');

//Edit Cooperative-Owned List
Route::get('/myinformation/editcooperativeowned', function () {
    return view('myinformation.editcooperativeowned');
})->name('editcooperativeowned');

//Individually-Owned List
Route::get('/myinformation/individuallyowned', function () {
    return view('myinformation.individuallyowned');
})->name('individuallyowned');

//Edit Individually-Owned List
Route::get('/myinformation/editindividuallyowned', function () {
    return view('myinformation.editindividuallyowned');
})->name('editindividuallyowned');


// OPERATIONS!
// General Info

Route::get('/myinformation/generalinfo', [CoopController::class, 'showGenInfo'])->name('generalinfo');

// Edit General Info
Route::get('/myinformation/editgeneralinfo', function () {
    return view('myinformation.editgeneralinfo');
})->name('editgeneralinfo');

// Membership
Route::get('/myinformation/membership', function () {
    return view('myinformation.membership');
})->name('membership');

// Edit Membership
Route::get('/myinformation/editmembership', function () {
    return view('myinformation.editmembership');
})->name('editmembership');

// Employment
Route::get('/myinformation/employment', function () {
    return view('myinformation.employment');
})->name('employment');

// Edit Employment
Route::get('/myinformation/editemployment', function () {
    return view('myinformation.editemployment');
})->name('editemployment');

// Units
Route::get('/myinformation/units', function () {
    return view('myinformation.units');
})->name('units');

// Edit Units
Route::get('/myinformation/editunits', function () {
    return view('myinformation.editunits');
})->name('editunits');

// CGS
Route::get('/myinformation/cgs', function () {
    return view('myinformation.cgs');
})->name('cgs');

// Edit CGS
Route::get('/myinformation/editcgs', function () {
    return view('myinformation.editcgs');
})->name('editcgs');

// GOVERNMENT!
// Officers
Route::get('/myinformation/officers', function () {
    return view('myinformation.officers');
})->name('officers');

// Edit Officers
Route::get('/myinformation/editofficers', function () {
    return view('myinformation.editofficers');
})->name('editofficers');

// Grants
Route::get('/myinformation/grants', function () {
    return view('myinformation.grants');
})->name('grants');

// Edit Grants
Route::get('/myinformation/editgrants', function () {
    return view('myinformation.editgrants');
})->name('editgrants');

// Loans
Route::get('/myinformation/loans', function () {
    return view('myinformation.loans');
})->name('loans');

// Edit Loans
Route::get('/myinformation/editloans', function () {
    return view('myinformation.editloans');
})->name('editloans');

// Businesses
Route::get('/myinformation/businesses', function () {
    return view('myinformation.businesses');
})->name('businesses');

// Businesses
Route::get('/myinformation/editbusinesses', function () {
    return view('myinformation.editbusinesses');
})->name('editbusinesses');

// Trainings 
Route::get('/myinformation/trainings', function () {
    return view('myinformation.trainings');
})->name('trainings');

// Edit Trainings 
Route::get('/myinformation/edittrainings', function () {
    return view('myinformation.edittrainings');
})->name('edittrainings');

// Scholarships 
Route::get('/myinformation/scholarships', function () {
    return view('myinformation.scholarships');
})->name('scholarships');

// Edit Scholarship
Route::get('/myinformation/editscholarship', function () {
    return view('myinformation.editscholarship');
})->name('editscholarship');

// CETOS 
Route::get('/myinformation/cetos', function () {
    return view('myinformation.cetos');
})->name('cetos');

// Edit CETOS 
Route::get('/myinformation/editcetos', function () {
    return view('myinformation.editcetos');
})->name('editcetos');

// Awards 
Route::get('/myinformation/awards', function () {
    return view('myinformation.awards');
})->name('awards');

// Edit Awards 
Route::get('/myinformation/editawards', function () {
    return view('myinformation.editawards');
})->name('editawards');


// Authentication 
Route::post('/', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);



//Services
Route::get('/otcservices/cgsrenewal', function () {
    return view('otcservices.cgsrenewal');
})->name('cgsrenewal');

Route::get('/otcservices/training', function () {
    return view('otcservices.training');
})->name('training');

Route::get('/otcservices/infoupdate', function () {
    return view('otcservices.infoupdate');
})->name('infoupdate');

Route::get('/otcservices/concern', function () {
    return view('otcservices.concern');
})->name('concern');

Route::get('/otcservices/accreditationcert', function () {
    return view('otcservices.accreditationcert');
})->name('accreditationcert');

Route::get('/otcservices/cgshistory', function () {
    return view('otcservices.cgshistory');
})->name('cgshistory');

Route::get('/otcservices/traininghistory', function () {
    return view('otcservices.traininghistory');
})->name('traininghistory');




// Accreditation Process
Route::get('/accreditation/form1', [ApplicationController::class, 'showForm1'])->name('form1');
Route::post('/accreditation/form1', [ApplicationController::class, 'processForm1'])->name('processForm1');

Route::get('/accreditation/form2', [ApplicationController::class, 'showForm2'])->name('form2');
Route::post('/accreditation/form2', [ApplicationController::class, 'processForm2'])->name('processForm2');

Route::get('/accreditation/confirmation', [ApplicationController::class, 'showConfirmation'])->name('confirmation');
Route::post('/accreditation/submit', [ApplicationController::class, 'submitForm'])->name('submitForm');

Route::get('/accreditation/success', [ApplicationController::class, 'showSuccess'])->name('success'); // New route for success page


Route::get('/accreditation', function () {
    return view('accreditation.index');
});

// Route::get('/accreditation/create', [ApplicationController::class, 'create']);
// Route::post('/accreditation/create', [ApplicationController::class, 'store']);
// Route::get('/accreditation/submit', function () {
//     return view('accreditation.submit');
// });
// Route::get('/accreditation/reference', function () {
//     return view('accreditation.reference');
// });


// PCGC address API 
Route::get('/island-groups/', [AddressController::class, 'getArea']);
Route::get('/island-groups/{islandGroupCode}/regions/', [AddressController::class, 'getRegions']);
Route::get('/regions/{regionCode}/provinces/', [AddressController::class, 'getProvinces']);
Route::get('/regions/{regionCode}/cities-municipalities/', [AddressController::class, 'getCitiesMunicipals']);
Route::get('/cities-municipalities/{cityOrMunicipalityCode}/barangays/', [AddressController::class, 'getBarangays']);

