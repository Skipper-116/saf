<?php

use App\Http\Controllers\CountyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // we neeed to show login page if user is not logged in otherwise show home page
    return Auth::check() ? redirect()->route('home') : view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/applications', [App\Http\Controllers\ApplicationController::class, 'index'])->name('applications.index');
Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
Route::get('/counties', [CountyController::class, 'getCounties']);
Route::get('/sub_counties', [App\Http\Controllers\SubCountyController::class, 'getSubCounties']);
Route::get('/sub_counties/{county_id}', [App\Http\Controllers\SubCountyController::class, 'getSubCounty']);
Route::get('/sub_counties_by_county/{county_id}', [App\Http\Controllers\SubCountyController::class, 'getSubCountiesByCounty']);
Route::get('/locations', [App\Http\Controllers\LocationController::class, 'getLocations']);
Route::get('/locations/{id}', [App\Http\Controllers\LocationController::class, 'getLocation']);
Route::get('/locations_by_sub_county/{sub_county_id}', [App\Http\Controllers\LocationController::class, 'getLocationsBySubCounty']);
Route::get('/sub_locations', [App\Http\Controllers\SubLocationController::class, 'getSubLocations']);
Route::get('/sub_locations/{id}', [App\Http\Controllers\SubLocationController::class, 'getSubLocation']);
Route::get('/sub_locations_by_location/{location_id}', [App\Http\Controllers\SubLocationController::class, 'getSubLocationsByLocation']);
Route::get('/villages', [App\Http\Controllers\VillageController::class, 'getVillages']);
Route::get('/villages/{id}', [App\Http\Controllers\VillageController::class, 'getVillage']);
Route::get('/villages_by_sub_location/{subLocationId}', [App\Http\Controllers\VillageController::class, 'getVillagesBySubLocation']);
Route::get('/genders', [App\Http\Controllers\GenderController::class, 'getGenders']);
Route::get('/marital_statuses', [App\Http\Controllers\MaritalStatusController::class, 'getMaritalStatuses']);
Route::get('/indentifier_types', [App\Http\Controllers\IdentifierTypeController::class, 'getIdentifierTypes']);
Route::get('/fetch_users', [App\Http\Controllers\UsersController::class, 'getUsers']);
Route::get('/fetch_social_programs', [App\Http\Controllers\SocialProgramController::class, 'getSocialPrograms']);