<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function create(Request $request) 
    {
        $file = $request->file('file');
        $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs('public/assignments', $file, $file_name);

        $teacher = Teacher::where('email', auth()->user()->email)->first();

        if(Storage::exists('public/assignments/' . $file_name)) {
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
}
