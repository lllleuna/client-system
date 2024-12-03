<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AddressController;

Route::get('/', function () {
    return view('index');
})->name('login');


Route::post('users/create', [RegisteredUserController::class, 'store']);

// Logged in portal
Route::get('/dashboard', function () {
    if (!auth()->user()) {
        return redirect('/'); // or any other page
    }

    return view('/dashboard');
})->middleware('auth');

Route::post('/', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/island-groups/', [AddressController::class, 'getArea']);
Route::get('/island-groups/{islandGroupCode}/regions/', [AddressController::class, 'getRegions']);
Route::get('/regions/{regionCode}/provinces/', [AddressController::class, 'getProvinces']);
Route::get('/regions/{regionCode}/cities-municipalities/', [AddressController::class, 'getCitiesMunicipals']);
Route::get('/cities-municipalities/{cityOrMunicipalityCode}/barangays/', [AddressController::class, 'getBarangays']);

