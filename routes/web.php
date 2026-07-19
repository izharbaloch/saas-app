<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('schools', SchoolController::class);
Route::middleware(['identify.tenant', 'auth', 'verified'])->prefix('{school}')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Classes Route
    Route::resource('/classes', SchoolClassController::class);
    Route::get('sections', [SectionController::class, 'index'])->name('sections.index');
    Route::get('academic-years', [AcademicYearController::class, 'index'])->name('academic.years.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
