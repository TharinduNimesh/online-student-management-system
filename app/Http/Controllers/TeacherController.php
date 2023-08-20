<?php

namespace App\Http\Controllers;

use App\Mail\setPassword;
use App\Models\Teacher;
use App\Models\TeacherGrade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{
    public function create(Request $request)
    {
        // check if email exists
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return redirect()->back()->with('error', 'Email already exists');
        }

        // Create teacher
        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'city_id' => $request->city,
            'gender_id' => $request->gender
        ]);

        // Send Email
        $data = [
            'name' => $request->name,
            'role' => 'teacher',
            'id' => $teacher->id,
        ];
        Mail::to($request->email)->send(new setPassword($data));

        return redirect()->back()->with('success', 'Teacher created successfully');
    }

    public function get($id) 
    {
        // Get Teacher And Return
        $teacher = Teacher::with('city')
        ->with('subjects')
        ->with('grades')
        ->find($id);
        return response()->json([
            'status' => 'success',
            'teacher' => $teacher
        ]);
    }

    public function removeSubject(Request $request)
    {
        // Get Teacher
        $teacher = Teacher::find($request->teacher);

        // Remove Subject
        $teacher->subjects()->detach($request->subject);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function removeGrade(Request $request)
    {
        // Get Grade And Delete
        $record = TeacherGrade::find($request->id);
        $record->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
