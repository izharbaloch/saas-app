<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\ClassSectionController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
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
    Route::get('classes', [SchoolClassController::class, 'index'])->name('classes.index');
    Route::get('sections', [SectionController::class, 'index'])->name('sections.index');
    Route::get('academic-years', [AcademicYearController::class, 'index'])->name('academic.years.index');
    Route::get('subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('class-sections', [ClassSectionController::class, 'index'])->name('class.sections.index');
    Route::get('class-subjects', [ClassSubjectController::class, 'index'])->name('class.subjects.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
