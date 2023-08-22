<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\City;
use App\Models\Note;
use App\Models\Officer;
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

    protected function adminManageTeacher(Request $request)
    {
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

    protected function adminManageLearning()
    {
        $assignments = Assignment::where('ended_at', 'like', Carbon::now()->year . '%')
            ->get()
            ->sortByDesc('started_at');

        $notes = Note::where('uploaded_at', 'like', Carbon::now()->year . '%')
            ->get()
            ->sortByDesc('uploaded_at');

        return view('admin.academic', [
            'assignments' => $assignments,
            'notes' => $notes,
        ]);
    }

    protected function adminManageOfficers()
    {
        $cities = City::all()
            ->sortBy('name');

        $officers = Officer::where('is_removed', 0)
            ->get()
            ->sortBy('name');

        return view('admin.officers', [
            'cities' => $cities,
            'officers' => $officers,
        ]);
    }

    protected function admindahsboard()
    {
        $teachers = Teacher::where('is_removed', 0)
            ->take(5)
            ->get()
            ->sortByDesc('id');

        $officers = Officer::where('is_removed', 0)
            ->take(5)
            ->get()
            ->sortByDesc('id');

        $assignments = Assignment::all()
            ->take(5)
            ->sortByDesc('id');

        $students_count = Student::where('is_removed', 0)
            ->count();

        $teachers_count = Teacher::where('is_removed', 0)
            ->count();

        $officers_count = Officer::where('is_removed', 0)
            ->count();

        return view('admin.dashboard', [
            'teachers' => $teachers,
            'officers' => $officers,
            'assignments' => $assignments,
            'students_count' => $students_count,
            'teachers_count' => $teachers_count,
            'officers_count' => $officers_count,
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
            ->assignments()
            ->get()
            ->sortByDesc('started_at');

        //  Get Submissions Of teacher's assignments
        $submissions = collect();
        foreach ($assignments as $assignment) {
            $submissions = $submissions->merge($assignment->submissions()->get());
        }

        return view('teacher.assignments', [
            'subjects' => $subjects,
            'grades' => $grades,
            'assignments' => $assignments,
            'submissions' => $submissions,
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

    protected function teacherDashboard()
    {
        // Get Teacher's Grades
        $grade = Teacher::where('email', auth()->user()->email)
            ->first()
            ->grades()
            ->first();

        // Get Teacher's Assignments
        $assignments = Teacher::where('email', auth()->user()->email)
            ->first()
            ->assignments()
            ->get();

        // Get Teacher's Notes
        $notes_count = Teacher::where('email', auth()->user()->email)
            ->first()
            ->notes()
            ->get()
            ->count();

        // Get Teacher's Submissions
        $submissions = collect();
        foreach ($assignments as $assignment) {
            $submissions = $submissions->merge($assignment->submissions()->get());
            if ($submissions->count() == 5) {
                break;
            }
        }

        return view('teacher.dashboard', [
            'grade' => $grade,
            'assignments' => $assignments,
            'assignments_count' => $assignments->count(),
            'notes_count' => $notes_count,
            'submissions' => $submissions,
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

    protected function studentAssignments()
    {
        // Get student's grades
        $grades = Student::where('email', auth()->user()->email)
            ->first()
            ->grades()
            ->get()
            ->where('year', date('Y'))
            ->first();

        // Get student's assignments
        $assignments = Assignment::where('grade', $grades->grade)
            ->where('started_at', '<=', Carbon::now())
            ->where('ended_at', '>=', Carbon::now())
            ->get()
            ->sortByDesc('started_at');

        // Get student's submissions in last year
        $submissions = Student::where('email', auth()->user()->email)
            ->first()
            ->submissions()
            ->where('submitted_at', '>=', Carbon::now()->subDays(365))
            ->get()
            ->sortByDesc('submitted_at');

        return view('student.assignments', [
            'assignments' => $assignments,
            'submissions' => $submissions,
        ]);
    }

    protected function studentDashboard()
    {
        $submissions = Student::where('email', auth()->user()->email)
            ->first()
            ->submissions()
            ->get();

        $submissions_count = $submissions->count();

        $total = 0;
        foreach ($submissions as $submission) {
            if ($submission->marks) {
                $total += $submission->marks;
            }
        }

        $average = 0;
        if ($submissions_count != 0) {
            $average = $total / $submissions_count;
        }

        // Get student's grades
        $grades = Student::where('email', auth()->user()->email)
            ->first()
            ->grades()
            ->get()
            ->where('year', date('Y'))
            ->first();

        // Get student's assignments
        $assignments = Assignment::where('grade', $grades->grade)
            ->where('started_at', '<=', Carbon::now())
            ->where('ended_at', '>=', Carbon::now())
            ->get()
            ->sortByDesc('started_at');

        $notes = Note::where('grade', $grades)
            ->get()
            ->sortByDesc('uploaded_at');

        return view('student.dashboard', [
            'submissions_count' => $submissions_count,
            'average' => $average,
            'assignments' => $assignments->take(5),
            'notes' => $notes->take(5),
        ]);
    }
}
