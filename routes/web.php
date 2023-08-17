<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home.index');
})->name('home.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes
Route::prefix('admin/')->group(function() {
    Route::get('dashboard/', function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::prefix('manage/')->group(function() {
        Route::get('teachers/', function() {
            return view('admin.teachers');
        })->name('admin.teachers');
        Route::get('officers', function() {
            return view('admin.officers');
        })->name('admin.officers');
        Route::get('students', function() {
            return view('admin.students');
        })->name('admin.students');
    });
    Route::get('academic-information', function() {
        return view('admin.academic');
    })->name('admin.academic');
    Route::get('payments', function() {
        return view('admin.payments');
    })->name('admin.payments');
});

// Teacher Routes
Route::prefix('teacher/')->group(function() {
    Route::get('dashboard/', function() {
        return view('teacher.dashboard');
    })->name('teacher.dashboard');
    Route::get('manage/assignments', function() {
        return view('teacher.assignments');
    })->name('teacher.assignments');
    Route::get('manage/notes', function() {
        return view('teacher.notes');
    })->name('teacher.notes');
});

// Student Routes
Route::prefix('student/')->group(function() {
    Route::get('dashboard/', function() {
        return view('student.dashboard');
    })->name('student.dashboard');
    Route::get('assignments/', function() {
        return view('student.assignments');
    })->name('student.assignments');
    Route::get('manage/notes', function() {
        return view('student.notes');
    })->name('student.notes');
    Route::get('manage/payments', function() {
        return view('student.payments');
    })->name('student.payments');
    Route::get('manage/academic-information', function() {
        return view('student.academic');
    })->name('student.academic');
});