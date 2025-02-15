<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;

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
Route::post('users/create', [RegisteredUserController::class, 'store']);

Auth::routes([
    'verify' => true
]);

// Logged in portal... DASHBOARD
Route::get('/dash', function () {
    if (!auth()->user()) {
        return redirect('/');
    }

    return view('/dash');
})->middleware('auth');


//MyInformation 
Route::get('/myinformation/membersMasterlist', function () {
    return view('myinformation.membersMasterlist');
})->name('membersMasterlist');

//Edit Member Details
Route::get('/myinformation/editMemberlist', function () {
    return view('myinformation.editMemberlist');
})->name('editMemberlist');

//Driver List
Route::get('/myinformation/driverMasterlist', function () {
    return view('myinformation.driverMasterlist');
})->name('driverMasterlist');

//Edit Driver List
Route::get('/myinformation/editDriverlist', function () {
    return view('myinformation.editDriverlist');
})->name('editDriverlist');

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
Route::get('/accreditation/', function () {
    return view('accreditation.index');
});
Route::get('/accreditation/create', [ApplicationController::class, 'create']);
Route::post('/accreditation/create', [ApplicationController::class, 'store']);
Route::get('/accreditation/submit', function () {
    return view('accreditation.submit');
});
Route::get('/accreditation/reference', function () {
    return view('accreditation.reference');
});


// PCGC address API 
Route::get('/island-groups/', [AddressController::class, 'getArea']);
Route::get('/island-groups/{islandGroupCode}/regions/', [AddressController::class, 'getRegions']);
Route::get('/regions/{regionCode}/provinces/', [AddressController::class, 'getProvinces']);
Route::get('/regions/{regionCode}/cities-municipalities/', [AddressController::class, 'getCitiesMunicipals']);
Route::get('/cities-municipalities/{cityOrMunicipalityCode}/barangays/', [AddressController::class, 'getBarangays']);

