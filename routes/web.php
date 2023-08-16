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

// Path: routes/web.php
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