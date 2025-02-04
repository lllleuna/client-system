<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ContactController;

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



Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('users/create', [RegisteredUserController::class, 'store']);



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


// Authentication 
Route::post('/', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);



//Services
Route::get('/otcservices/cgsrenewal', function () {
    // Your renewal logic
})->name('cgsrenewal');

Route::get('/otcservices/training', function () {
    return view('otcservices.training');
})->name('training');

Route::get('/otcservices/infoupdate', function () {
    return view('otcservices.infoupdate');
})->name('infoupdate');

Route::get('/otcservices/concern', function () {
    // Your concerns logic
})->name('concern');




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

