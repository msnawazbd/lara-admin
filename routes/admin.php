<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\Appointments\CreateAppointment;
use App\Http\Livewire\Admin\Appointments\ListAppointments;
use App\Http\Livewire\Admin\Appointments\UpdateAppointment;
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
/** appointments **/
Route::get('appointments', ListAppointments::class)->name('appointments');
Route::get('appointments/create', CreateAppointment::class)->name('appointments.create');
Route::get('appointments/{appointment}/edit', UpdateAppointment::class)->name('appointments.edit');

Route::get('profile', UpdateProfile::class)->name('profile');
Route::get('settings', UpdateSetting::class)->name('settings');
