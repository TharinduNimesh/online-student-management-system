<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Student;
use App\Models\Submission;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    public function create(Request $request) 
    {
        // get file from request and store it in storage
        $file = $request->file('file');
        $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs('public/assignments', $file, $file_name);

        // get logged in teacher
        $teacher = Teacher::where('email', auth()->user()->email)->first();

        // check if file exists in storage
        if(Storage::exists('public/assignments/' . $file_name)) {
            // create assignment
            Assignment::create([
                'title' => $request->title,
                'description' => $request->description,
                'started_at' => $request->start_date,
                'ended_at' => $request->end_date,
                'file_name' => $file_name,
                'subject_id' => $request->subject,
                'grade' => $request->grade,
                'uploaded_by' => $teacher->id,
            ]);

            return redirect()->back()->with('success', 'Assignment Created Successfully');
        } else {
            return redirect()->back()->with('error', 'Error While Uploading File');
        }
    }

    public function updateStatus(Request $request)
    {
        // find assignment
        $assignment = Assignment::find($request->id);

        // update assignment status
        $assignment->update([
            'assignment_status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Assignment Status Updated Successfully');
    }

    public function delete(Request $request)
    {
        // find assignment
        $assignment = Assignment::find($request->id);

        // delete assignment file from storage
        if(Storage::exists('public/assignments/' . $assignment->file_name)) {
            Storage::delete('public/assignments/' . $assignment->file_name);
        }

        // delete assignment db record
        $assignment->delete();

        // redirect back with success message
        return redirect()->back()->with('success', 'Assignment Deleted Successfully');
    }

    public function addSubmission(Request $request)
    {
        // get file from request and store it in storage
        $file = $request->file('file');
        $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs('public/submissions', $file, $file_name);

        // get logged in student
        $student = Student::where('email', auth()->user()->email)->first();

        // check if file exists in storage
        if(Storage::exists('public/submissions/' . $file_name)) {
            // create submission
            Submission::create([
                'assignment_id' => $request->assignment,
                'file' => $file_name,
                'student_id' => $student->id,
                'submitted_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Assignment Submitted Successfully');
        } else {
            return redirect()->back()->with('error', 'Error While Uploading File');
        }
    }

    public function addMarks(Request $request)
    {
        // validate marks is integer and between 0 and 100
        $validator = Validator::make($request->all(), [
            'marks' => 'required|integer|min:0|max:100',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('error_submission', 'Marks Must Be Between 0 and 100');
        }

        // find submission
        $submission = Submission::find($request->submission);

        // update submission marks
        $submission->update([
            'marks' => $request->marks,
        ]);

        return redirect()->back()->with('success_submission', 'Marks Added Successfully');
    }
}
