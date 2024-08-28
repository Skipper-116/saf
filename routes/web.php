<?php

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