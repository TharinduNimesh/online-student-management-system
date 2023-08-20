<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Note;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    protected function adminManageStudents()
    {
        // Get all cities
        $cities = City::all()
            ->sortBy('name');

        // Get current year
        $currentYear = date('Y');

        // Get non grade students doesn't have grade in this year
        $non_grade_students = Student::whereDoesntHave('grades', function ($query) use ($currentYear) {
            $query->where('year', $currentYear);
        })
        ->where('is_removed', 0)
        ->get()
        ->sortBy('name');


        // graded students
        $graded_students = Student::whereHas('grades', function ($query) use ($currentYear) {
            $query->where('year', $currentYear);
            })
            ->where('is_removed', 0)
            ->get()
            ->sortBy('grades.grade');

        // Return view with data
        return view('admin.students', [
            'cities' => $cities,
            'non_grade_students' => $non_grade_students,
            'graded_students' => $graded_students,
        ]);
    }

    protected function adminManageTeacher(Request $request) {
        // Get all cities
        $ciites = City::all()
            ->sortBy('name');

        // Get all subjects
        $subjects = Subject::all()
            ->sortBy('name');

        // Get all teachers 
        $teachers = Teacher::where('is_removed', 0)
            ->with('city')
            ->get()
            ->sortBy('name');

        // Return view with data
        return view('admin.teachers', [
            'cities' => $ciites,
            'teachers' => $teachers,
            'subjects' => $subjects,
        ]);
    }

    protected function setPassword($role, $id)
    {
        $user = null;
        if ($role == "student") {
            $user = Student::find($id);
            $role_id = 5;
        } else if ($role == "teacher") {
            $user = Teacher::find($id);
            $role_id = 4;
        } else if ($role == "officer") {
            // $user = Officer::find($id);
            $role_id = 3;
        }

        return view('auth.set-password', [
            'user' => $user,
            'role' => $role_id
        ]);
    }

    protected function teacherManageAssignments()
    {
        // all teacher's subjects
        $subjects = Teacher::where('email', auth()->user()->email)
            ->first()
            ->subjects()
            ->get();

        // Teacher's Grades
        $grades = Teacher::where('email', auth()->user()->email)
            ->first()
            ->grades()
            ->get();

        // Get Teacher's Assignments
        $assignments = Teacher::where('email', auth()->user()->email)
            ->first()
            ->assignments
            ->sortByDesc('started_at');
            
        return view('teacher.assignments', [
            'subjects' => $subjects,
            'grades' => $grades,
            'assignments' => $assignments,
        ]);
    }

    protected function teacherManageNotes()
    {
        // all teacher's subjects
        $subjects = Teacher::where('email', auth()->user()->email)
            ->first()
            ->subjects()
            ->get();

        // Teacher's Grades
        $grades = Teacher::where('email', auth()->user()->email)
            ->first()
            ->grades()
            ->get();

        // // Get Teacher's Notes
        $notes = Teacher::where('email', auth()->user()->email)
            ->first()
            ->notes()
            ->get()
            ->sortByDesc('created_at');

        return view('teacher.notes', [
            'subjects' => $subjects,
            'grades' => $grades,
            'notes' => $notes,
        ]);
    }

    protected function studentNotes() 
    {
        // Get student's grades
        $grades = Student::where('email', auth()->user()->email)
            ->first()
            ->grades()
            ->get()
            ->sortByDesc('year');

        // Get student's notes
        $notes = array();
        foreach ($grades as $grade) {
            $notes = Note::where('grade', $grade->grade)
                ->get()
                ->sortByDesc('uploaded_at');

            $notes = $notes->merge($notes);
        }

        return view('student.notes', [
            'notes' => $notes,
        ]);
    }
}
