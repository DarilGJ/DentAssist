<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
use App\Http\Controllers\ClinicalRecordController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/expedientes/crear', [ClinicalRecordController::class, 'create'])->name('expedientes.create');
    Route::post('/expedientes', [ClinicalRecordController::class, 'store'])->name('expedientes.store');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
