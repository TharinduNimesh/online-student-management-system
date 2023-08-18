<?php

namespace App\Http\Controllers;

use App\Mail\setPassword;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    public function create(Request $request) {
        // check if email exists
        $user = User::where('email', $request->email)->first();
        if($user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email already exists'
            ]);
        }

        // Create Student
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'date_of_birth' => $request->dob,
            'city_id' => $request->city,
            'gender_id' => $request->gender
        ]);

        // Send Email
        $data = [
            'name' => $request->name,
            'role' => 'student',
            'id' => $student->id,
        ];
        Mail::to($request->email)->send(new setPassword($data));

        return response()->json([
            'status' => 'success',
        ]);
    }
}
