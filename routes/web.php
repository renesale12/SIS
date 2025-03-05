<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentViewController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;

// Welcome Page (Public Route)
Route::get('/', function () {
    return view('welcome');
});



// **Admin Dashboard (Only Admins Can Access)**
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD Routes for Admin
    Route::resource('students', StudentController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::resource('grades', GradeController::class);
});

// **Student Dashboard (Only Students Can Access)**
Route::middleware(['auth:student'])->group(function () {
    Route::get('/studentdashboard', function () {
        return view('studentdashboard');
    })->name('studentdashboard');
    Route::get('/mygrades', [StudentViewController::class, 'index'])->name('studentviews.index');
});

// **Profile Routes (For Both Admins & Students)**
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes (Included from auth.php)
require __DIR__.'/auth.php';