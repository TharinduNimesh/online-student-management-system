<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Student;
use App\Models\Teacher;
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
        $ciites = City::all()
            ->sortBy('name');

        $teachers = Teacher::where('is_removed', 0)
            ->with('city')
            ->get()
            ->sortBy('name');

        return view('admin.teachers', [
            'cities' => $ciites,
            'teachers' => $teachers,
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
}
