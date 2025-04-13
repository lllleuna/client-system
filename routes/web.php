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
use App\Http\Controllers\CGSRenewalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\RenewalController;
use App\Http\Controllers\ProfileController;

Route::post('/renewal/submit', [RenewalController::class, 'submit'])->name('renewal.submit');


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


//Profile Setting
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profilesetting');
    Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.updatePicture');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

Route::post('/profile/toggle-2fa', [ProfileController::class, 'toggleTwoFactor'])->name('profile.toggle2fa');


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('users/create', [RegisteredUserController::class, 'show']);
Route::post('users/create', [RegisteredUserController::class, 'store']);


// Logged in portal... DASHBOARD
Route::get('/dash', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


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

Route::get('/verify-email/{token}', [RegisteredUserController::class, 'verifyEmail'])->name('verify-email');

// ------------------------------------------

Route::get('/auth/mfa', function() {
    return view('/auth/mfa');
})->name('verify.contact');
Route::middleware(['auth'])->group(function () {
    Route::post('/send-otp', [RegisteredUserController::class, 'sendOtp'])->name('send.otp');
    Route::post('/verify-otp', [RegisteredUserController::class, 'verifyOtp'])->name('verify.otp');
    Route::post('/auth/resend-otp', [RegisteredUserController::class, 'resendOtp'])->name('resend.otp');
});

Route::get('/verify-contact-otp', [ProfileController::class, 'showVerifyContactOtp'])->name('verify.contact.otp');
Route::post('/verify-contact-otp', [ProfileController::class, 'verifyContactOtp'])->name('verify.contact.otp.submit');
Route::post('/verify-contact/resend', [ProfileController::class, 'resendContactOtp'])->name('resend.contact.otp');


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
Route::get('/myinformation/cooperativeowned', [CoopController::class, 'showCoopOwnedUnits'])->name('cooperativeowned');
Route::get('/myinformation/coopownedunit', [CoopController::class, 'viewCoopOwnedUnit'] )->name('addCoopUnitIndex');
Route::post('/myinformation/coopownedunit', [CoopController::class, 'addCoopOwnedUnit'])->name('addCoopUnit');
Route::get('/myinformation/coopownedunit/{id}/view', [CoopController::class, 'editCoopOwnedUnit'])->name('editCoopUnit');
Route::put('/myinformation/coopownedunit/{id}', [CoopController::class, 'updateCoopOwnedUnit'])->name('coopunit.update');
Route::delete('/myinformation/coopownedunit/{id}', [CoopController::class, 'destroyCoopOwnedUnit'])->name('coopunit.destroy');


//Individually-Owned List
Route::get('/myinformation/individuallyowned', [CoopController::class, 'showIndivOwnedUnits'])->name('individuallyowned');
Route::get('/myinformation/indivownedunit', [CoopController::class, 'viewIndivOwnedUnit'] )->name('addIndivUnitIndex');
Route::post('/myinformation/indivownedunit', [CoopController::class, 'addIndivOwnedUnit'])->name('addIndivUnit');
Route::get('/myinformation/indivownedunit/{id}/view', [CoopController::class, 'editIndivOwnedUnit'])->name('editIndivUnit');
Route::put('/myinformation/indivownedunit/{id}', [CoopController::class, 'updateIndivOwnedUnit'])->name('indivunit.update');
Route::delete('/myinformation/indivownedunit/{id}', [CoopController::class, 'destroyIndivOwnedUnit'])->name('indivunit.destroy');



//Edit Individually-Owned List
Route::get('/myinformation/editindividuallyowned', function () {
    return view('myinformation.editindividuallyowned');
})->name('editindividuallyowned');


// OPERATIONS!
// General Info

Route::get('/myinformation/generalinfo', [CoopController::class, 'showGenInfo'])->name('generalinfo');
Route::get('/myinformation/edit', [CoopController::class, 'editGeneralInfo'])->name('editgeneralinfo');
Route::put('/myinformation/update', [CoopController::class, 'updateGeneralInfo'])->name('updategeneralinfo');


// Membership
Route::get('/myinformation/membership', function () {
    return view('myinformation.membership');
})->name('membership');

// Edit Membership
Route::get('/myinformation/editmembership', function () {
    return view('myinformation.editmembership');
})->name('editmembership');

// Employment
Route::get('/myinformation/employment', [CoopController::class, 'showEmployment'])->name('employment');

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
Route::get('/myinformation/officers', [CoopController::class, 'showOfficers'])->name('officerslist');
Route::get('/myinformation/officer', [CoopController::class, 'viewOfficer'] )->name('addOfficerIndex');
Route::post('/myinformation/officer', [CoopController::class, 'addOfficer'])->name('addOfficer');
Route::get('/myinformation/officer/{id}/view', [CoopController::class, 'editOfficer'])->name('editOfficer');
Route::put('/myinformation/officer/{id}', [CoopController::class, 'updateOfficer'])->name('Officer.update');
Route::delete('/myinformation/officer/{id}', [CoopController::class, 'destroyOfficer'])->name('Officer.destroy');


// Grants
Route::get('/myinformation/grants', [CoopController::class, 'showGrants'])->name('grants');
Route::get('/myinformation/editgrants', [CoopController::class, 'viewGrant'] )->name('editgrants');
Route::post('/myinformation/editgrants', [CoopController::class, 'addGrant'] )->name('addGrant');
Route::get('/myinformation/editgrants/{id}/view', [CoopController::class, 'editGrant'])->name('editGrant');
Route::put('/myinformation/editgrants/{id}', [CoopController::class, 'updateGrant'])->name('grant.update');
Route::delete('/myinformation/editgrants/{id}', [CoopController::class, 'destroyGrant'])->name('grant.destroy');


// Loans
Route::get('/myinformation/loans', [CoopController::class, 'showLoans'])->name('loans');
Route::get('/myinformation/editloans', [CoopController::class, 'viewLoan'] )->name('editloans');
Route::post('/myinformation/editloans', [CoopController::class, 'addLoan'] )->name('addloan');
Route::get('/myinformation/editloans/{id}/view', [CoopController::class, 'editLoan'])->name('editloan');
Route::put('/myinformation/editloans/{id}', [CoopController::class, 'updateLoan'])->name('loan.update');
Route::delete('/myinformation/editloans/{id}', [CoopController::class, 'destroyLoan'])->name('loan.destroy');


// Businesses
Route::get('/myinformation/businesses', [CoopController::class, 'showBusinesses'])->name('businesses');
Route::get('/myinformation/editbusiness', [CoopController::class, 'viewBusiness'] )->name('editbusinesses');
Route::post('/myinformation/editbusiness', [CoopController::class, 'addBusiness'] )->name('addbusiness');
Route::get('/myinformation/editbusiness/{id}/view', [CoopController::class, 'editBusiness'])->name('editbusiness');
Route::put('/myinformation/editbusiness/{id}', [CoopController::class, 'updateBusiness'])->name('business.update');
Route::delete('/myinformation/editbusiness/{id}', [CoopController::class, 'destroyBusiness'])->name('business.destroy');


// Trainings
Route::get('/myinformation/trainings', [CoopController::class, 'showTrainings'])->name('trainings');
Route::get('/myinformation/edittraining', [CoopController::class, 'viewTraining'] )->name('edittrainings'); // add button
Route::post('/myinformation/edittraining', [CoopController::class, 'addTraining'] )->name('addtraining');
Route::get('/myinformation/edittraining/{id}/view', [CoopController::class, 'editTraining'])->name('edittraining'); // edit button
Route::put('/myinformation/edittraining/{id}', [CoopController::class, 'updateTraining'])->name('training.update');
Route::delete('/myinformation/edittraining/{id}', [CoopController::class, 'destroyTraining'])->name('training.destroy');


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

Route::middleware(['auth'])->group(function () {
// Awards
    Route::get('/myinformation/awards', [CoopController::class, 'showAwards'])->name('awards');
    Route::get('/myinformation/award', [CoopController::class, 'viewAward'] )->name('editawards'); // add button
    Route::post('/myinformation/award', [CoopController::class, 'addAward'] )->name('addaward');
    Route::get('/myinformation/award/{id}/view', [CoopController::class, 'editAward'])->name('editaward'); // edit button
    Route::put('/myinformation/award/{id}', [CoopController::class, 'updateAward'])->name('award.update');
    Route::delete('/myinformation/award/{id}', [CoopController::class, 'destroyAward'])->name('award.destroy');
});

// Authentication
Route::post('/', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);



//Services
Route::get('/otcservices/cgsrenewal', [CGSRenewalController::class, 'index'])->name('cgsrenewal');

Route::get('/otcservices/training', function () {
    return view('otcservices.training');
})->name('training');

Route::get('/otcservices/infoupdate', function () {
    return view('otcservices.infoupdate');
})->name('infoupdate');

Route::get('/otcservices/concern', function () {
    return view('otcservices.concern');
})->name('concern');


Route::get('/otcservices/cgshistory', [ServicesController::class, 'cgs'])->name('cgshistory');
Route::get('/download-cgs/{filename}', [ServicesController::class, 'downloadCGS'])->name('download.cgs');

Route::get('/otcservices/accredit', [ServicesController::class, 'accredit'])->name('accreditationcert');
Route::get('/download-accredit/{filename}', [ServicesController::class, 'downloadAccredit'])->name('download.accredit');

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
Route::get('/regions', [AddressController::class, 'getAllRegions']);


Route::get('/province-name/{code}', [AddressController::class, 'getProvinceName']);
Route::get('/city-name/{code}', [AddressController::class, 'getCityMunicipalityName']);
Route::get('/barangay-name/{code}', [AddressController::class, 'getBarangayName']);


Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
