<?php

use App\Http\Controllers\NavigationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
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
        Route::get('teachers/', [NavigationController::class, 'adminManageTeacher'])
        ->name('admin.teachers');
        Route::get('officers', function() {
            return view('admin.officers');
        })->name('admin.officers');
        Route::get('students', [NavigationController::class, 'adminManageStudents'])
        ->name('admin.students');
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
});

// Officer Routes
Route::prefix('officer/')->group(function() {
    Route::get('dashboard/', function() {
        return view('officer.dashboard');
    })->name('officer.dashboard');
    Route::get('manage/students/', function() {
        return view('officer.students');
    })->name('officer.students');
    Route::get('manage/assignments/', function() {
        return view('officer.assignments');
    })->name('officer.assignments');
});

// auth Route
Route::post('login', [UserController::class, 'login'])
->name('auth.login');
Route::get('logout', [UserController::class, 'logout'])
->name('auth.logout');
Route::post('set-password', [UserController::class, 'setPassword'])
->name('auth.setPassword');
Route::get('register-form/{role}', function() {
    return view('auth.register');
})->name('auth.register.invite');
Route::post('register', [UserController::class, 'register'])
->name('auth.register');

// Register Route
Route::post('add/student', [StudentController::class, 'create'])
->name('student.add');
Route::post('add/teacher', [TeacherController::class, 'create'])
->name('teacher.add');

// set password
Route::get('set-password/{role}/{id}', [NavigationController::class, 'setPassword'])
->name('password.student');

// student's grade
Route::post('assign/grade', [StudentController::class, 'assignGrade'])
->name('student.assign.grade');
Route::get('update/grade/{student}', [StudentController::class, 'updateGrade'])
->name('student.update.grade');

// get routes
Route::get('student/{id}', [StudentController::class, 'get'])
->name('student.get');
Route::get('teacher/{id}', [TeacherController::class, 'get'])
->name('teacher.get');

// update routes
Route::post('student/update', [StudentController::class, 'update'])
->name('student.update');

// delete routes
Route::get('student/delete/{id}', [StudentController::class, 'delete'])
->name('student.delete');
Route::post('/teacher/remove-subject/', [TeacherController::class, 'removeSubject'])
->name('teacher.remove.subject');
Route::post('/teacher/remove-grade/', [TeacherController::class, 'removeGrade'])
->name('teacher.remove.grade');

// Mail Routes
