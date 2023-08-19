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

    public function assignGrade(Request $request) {
        // validate grade is not empty and not a string
        $request->validate([
            'grade' => 'required|integer'
        ]);

        // assign grade
        $student = Student::find($request->student_id);
        $student->grades()->create([
            'year' => date('Y'),
            'grade' => $request->grade,
        ]);

        // return to previous page
        return redirect()->back();
    }

    public function get($id) {
        // get student
        $student = Student::with('grades')
        ->with('city')
        ->find($id);
        
        // return response
        return response()->json([
            'status' => 'success',
            'student' => $student
        ]);
    }

    public function update(Request $request) {
        // get student
        $student = Student::find($request->id);
        
        // check if email exists
        $user = Student::where('email', $request->email)
        ->where('id', '!=', $request->id)
        ->first();

        if($user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email already exists'
            ]);
        }

        // update student all details
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'date_of_birth' => $request->dob,
        ]);

        // return response
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function updateGrade($student) {
        // get student
        $student = Student::find($student);

        // update grade
        $student->grades()->where('year', date('Y'))->update([
            'grade' => $student->grades()->where('year', date('Y'))->first()->grade + 1
        ]);
        
        // return to previous page
        return redirect()->back();
    }

    public function delete($id) {
        // get student
        $student = Student::find($id);

        // delete student
        $student->update([
            'is_removed' => 1
        ]);

        // return response
        return redirect()->back();
    }
}
