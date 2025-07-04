<?php

use App\Http\Controllers\CreateAppointmentPatientController;
use App\Http\Controllers\CreatePatientController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('links', fn () => dd('aqui'))->name('appointments.confirmation');

Route::resource('/patients', CreatePatientController::class)->only(['create', 'store'])->names('simple.patient');

Route::resource('/patients/{patient}/appointment', CreateAppointmentPatientController::class)->only(['create', 'store'])->names('simple.appointment');

Route::resource('/patients/confirm-appointment', CreateAppointmentPatientController::class)->only(['edit', 'update', 'destroy'])->names('simple.confirm-appointment');

require __DIR__.'/auth.php';
