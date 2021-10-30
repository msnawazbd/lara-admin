<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\Profile\UpdateProfile;
use App\Http\Livewire\Admin\Settings\UpdateSetting;
use App\Http\Livewire\Admin\Users\ListUsers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::get('dashboard', DashboardController::class)->name('dashboard');
Route::get('users', ListUsers::class)->name('users');
Route::get('profile', UpdateProfile::class)->name('profile');
Route::get('settings', UpdateSetting::class)->name('settings');

