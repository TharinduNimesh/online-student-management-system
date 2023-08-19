<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Student;
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
        })->get()
        ->sortBy('name');


        // graded students
        $graded_students = Student::whereHas('grades', function ($query) use ($currentYear) {
            $query->where('year', $currentYear);
            })->get()
            ->sortBy('grades.grade');

        // Return view with data
        return view('admin.students', [
            'cities' => $cities,
            'non_grade_students' => $non_grade_students,
            'graded_students' => $graded_students,
        ]);
    }

    protected function setPassword($role, $id)
    {
        $user = null;
        if ($role == "student") {
            $user = Student::find($id);
            $role_id = 5;
        } else if ($role == "teacher") {
            // $user = Teacher::find($id);
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
