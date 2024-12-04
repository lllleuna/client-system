<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ApplicationController;

Route::get('/', function () {
    return view('index');
})->name('login');


Route::post('users/create', [RegisteredUserController::class, 'store']);

// Logged in portal
Route::get('/dash', function () {
    if (!auth()->user()) {
        return redirect('/');
    }

    return view('/dash');
})->middleware('auth');

// Authentication
Route::post('/', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);


// Accreditation Process
Route::get('/accreditation/', function () {
    return view('accreditation.index');
});
Route::get('/accreditation/create', [ApplicationController::class, 'create']);
Route::post('/accreditation/create', [ApplicationController::class, 'store']);
Route::get('/accreditation/reference', function () {
    return view('accreditation.reference');
});

// PCGC address API 
Route::get('/island-groups/', [AddressController::class, 'getArea']);
Route::get('/island-groups/{islandGroupCode}/regions/', [AddressController::class, 'getRegions']);
Route::get('/regions/{regionCode}/provinces/', [AddressController::class, 'getProvinces']);
Route::get('/regions/{regionCode}/cities-municipalities/', [AddressController::class, 'getCitiesMunicipals']);
Route::get('/cities-municipalities/{cityOrMunicipalityCode}/barangays/', [AddressController::class, 'getBarangays']);

