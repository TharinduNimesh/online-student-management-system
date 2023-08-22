<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\OfficerController;
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
Route::prefix('admin/')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('dashboard/', [NavigationController::class, 'admindahsboard'])
    ->name('admin.dashboard');
    Route::prefix('manage/')->group(function() {
        Route::get('teachers/', [NavigationController::class, 'adminManageTeacher'])
        ->name('admin.teachers');
        Route::get('officers', [NavigationController::class, 'adminManageOfficers'])
        ->name('admin.officers');
        Route::get('students', [NavigationController::class, 'adminManageStudents'])
        ->name('admin.students');
    });
    Route::get('academic-information', [NavigationController::class, 'adminManageLearning'])
    ->name('admin.academic');
    Route::get('payments', function() {
        return view('admin.payments');
    })->name('admin.payments');
});

// Teacher Routes
Route::prefix('teacher/')->middleware(['auth', 'isTeacher'])->group(function() {
    Route::get('dashboard/', [NavigationController::class, 'teacherDashboard'])
    ->name('teacher.dashboard');
    Route::get('manage/assignments', [NavigationController::class, 'teacherManageAssignments'])
    ->name('teacher.assignments');
    Route::get('manage/notes', [NavigationController::class, 'teacherManageNotes'])
    ->name('teacher.notes');
});

// Student Routes
Route::prefix('student/')->middleware(['auth', 'isStudent'])->group(function() {
    Route::get('dashboard/', [NavigationController::class, 'studentDashboard'])
    ->name('student.dashboard');
    Route::get('assignments/', [NavigationController::class, 'studentAssignments'])
    ->name('student.assignments');
    Route::get('manage/notes', [NavigationController::class, 'studentNotes'])
    ->name('student.notes');
    Route::get('manage/payments', function() {
        return view('student.payments');
    })->name('student.payments');
});

// Officer Routes
Route::prefix('officer/')->middleware(['auth', 'isOfficer'])->group(function() {
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

// add Route
Route::post('add/student', [StudentController::class, 'create'])
->name('student.add');
Route::post('add/teacher', [TeacherController::class, 'create'])
->name('teacher.add');
Route::post('/teacher/add-subject/', [TeacherController::class, 'addSubject'])
->name('teacher.add.subject');
Route::post('/teacher/add-grade/', [TeacherController::class, 'addGrade'])
->name('teacher.add.grade');
Route::post('/teacher/add-assignment/', [AssignmentController::class, 'create'])
->name('teacher.add.assignment');
Route::post('/teacher/add-note/', [NoteController::class, 'create'])
->name('teacher.add.note');
Route::post('/add/submission/', [AssignmentController::class, 'addSubmission'])
->name('student.add.submission');
Route::post('/add/marks/', [AssignmentController::class, 'addMarks'])
->name('teacher.add.marks');
Route::post('/add/officer/', [OfficerController::class, 'create'])
->name('officer.add');

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
Route::post('teacher/update', [TeacherController::class, 'update'])
->name('teacher.update');
Route::post('assignment/update/status', [AssignmentController::class, 'updateStatus'])
->name('assignment.update.status');

// delete routes
Route::get('student/delete/{id}', [StudentController::class, 'delete'])
->name('student.delete');
Route::post('/teacher/remove-subject/', [TeacherController::class, 'removeSubject'])
->name('teacher.remove.subject');
Route::post('/teacher/remove-grade/', [TeacherController::class, 'removeGrade'])
->name('teacher.remove.grade');
Route::get('teacher/delete/{id}', [TeacherController::class, 'delete'])
->name('teacher.delete');
Route::post('assignment/delete/', [AssignmentController::class, 'delete'])
->name('assignment.delete');
Route::post('note/delete/', [NoteController::class, 'delete'])
->name('note.delete');
Route::post('officer/remove', [OfficerController::class, 'delete'])
->name('officer.remove');
    

// Mail Routes
