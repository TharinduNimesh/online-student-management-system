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

    public function update(Request $request) 
    {
        // Get Teacher And Update
        $teacher = Teacher::find($request->id);
        $teacher->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
        ]);

        // Return To Previous Page
        return redirect()->back();
    }

    public function addSubject(Request $request) 
    {
        // Get Teacher
        $teacher = Teacher::find($request->teacher);

        // Add Subject if not exists
        $teacher->subjects()->syncWithoutDetaching($request->subject);

        // Get Teacher Subjects
        $subjects = $teacher->subjects;

        // Return Data To Previous Page
        return response()->json([
            'status' => 'success',
            'subjects' => $subjects
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

    public function addGrade(Request $request)
    {
        // Get Teacher
        $teacher = Teacher::find($request->teacher);
        
        // Check if grade exists
        $grade = $teacher->grades()
        ->where('grade', $request->grade)
        ->where('teacher_id', $request->teacher)
        ->first();


        // Add Grade if not exists
        if (!$grade) {
            $teacher->grades()->create([
                'grade' => $request->grade
            ]);
        }

        // Get Teacher Grades
        $grades = $teacher->grades->sortBy('grade');

        // Return Data To Previous Page
        return response()->json([
            'status' => 'success',
            'grades' => $grades
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

    public function delete($id)
    {
        // Get Teacher And Delete
        $teacher = Teacher::find($id);
        $teacher->update([
            'is_removed' => 1
        ]);

        // Return To Previous Page
        return redirect()->back();
    }
}
