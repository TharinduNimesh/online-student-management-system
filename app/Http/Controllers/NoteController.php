<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    public function create(Request $request)
    {
        $file = $request->file('file');
        $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
        
        Storage::putFileAs('public/notes', $file, $file_name);

        $teacher = Teacher::where('email', auth()->user()->email)->first();

        if(Storage::exists('public/notes/' . $file_name)) {
            Note::create([
                'title' => $request->title,
                'file' => $file_name,
                'subject_id' => $request->subject,
                'grade' => $request->grade,
                'uploaded_by' => $teacher->id,
                'uploaded_at' => Carbon::now()->toDate(),
            ]);
            return redirect()->back()->with('success', 'Note Created Successfully');
        } else {
            return redirect()->back()->with('error', 'Error While Uploading File');
        }
    }

    public function delete(Request $request)
    {
        $note = Note::where('id', $request->id)->first();
        if(Storage::exists('public/notes/' . $note->file)) {
            Storage::delete('public/notes/' . $note->file);
            $note->delete();
            return redirect()->back()->with('success', 'Note Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Error While Deleting Note');
        }
    }
}
