<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('schools', SchoolController::class);
Route::middleware(['tenant', 'auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Classes Route
    Route::view('classes', 'school_classes.index')->name('classes.index');
    Route::view('sections', 'sections.index')->name('sections.index');
    Route::view('academic-years', 'academic_years.index')->name('academic.years.index');
    Route::view('subjects', 'subjects.index')->name('subjects.index');
    Route::view('class-sections', 'class_sections.index')->name('class.sections.index');
    Route::view('class-subjects', 'class_subjects.index')->name('class.subjects.index');

    // Students route
    Route::view('students', 'students.index')->name('students.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
