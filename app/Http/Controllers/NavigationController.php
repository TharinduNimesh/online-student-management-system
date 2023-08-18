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

        // Return view with cities
        return view('admin.students', [
            'cities' => $cities
        ]);
    }

    protected function setPassword($role, $id) {
        $user = null;
        if($role == "student") {
            $user = Student::find($id);
            $role_id = 5;
        } else if($role == "teacher") {
            // $user = Teacher::find($id);
            $role_id = 4;
        } else if($role == "officer") {
            // $user = Officer::find($id);
            $role_id = 3;
        }

        return view('auth.set-password', [
            'user' => $user,
            'role' => $role_id
        ]);
    }
}
