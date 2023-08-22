@extends('layouts.admin')

@section('title', 'Academic Information')

@section('section')
    {{-- Section Start --}}
    <div class="row">
        {{-- Assignment Start --}}
        <div class="col-12 bg-dark rounded p-3 mt-3">
            <h3 class="text-white mx-3">Information About Assignments</h3>
            <div class="table-responsive mt-3">
                <table class="table table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Status</th>
                            <th>Uploaded By</th>
                            <th>Uploaded At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($assignments) == 0)
                            <tr>
                                <td colspan="8" class="text-center">No Assignments Found</td>
                            </tr>
                        @else
                            @foreach ($assignments as $key => $assignment)
                                <tr>
                                    <td>{{ $assignment->title }}</td>
                                    <td>{{ $assignment->subject->name }}</td>
                                    <td>Grade - {{ $assignment->grade }}</td>
                                    <td>
                                        @if ($assignment->assignment_status == 1 && $assignment->started_at < now())
                                            <span class="text-success">Started</span>
                                        @elseif ($assignment->assignment_status == 2)
                                            <span class="text-warning">Mark Assigned</span>
                                        @elseif ($assignment->assignment_status == 3)
                                            <span class="text-success">Marks Released</span>
                                        @else
                                            <span class="text-danger">Not Started</span>
                                        @endif
                                    </td>
                                    <td>{{ $assignment->teacher->name }}</td>
                                    <td>{{ $assignment->started_at }}</td>
                                    <td class="d-flex gap-2">
                                        <a href="{{ asset('storage/assignments/' . $assignment->file_name) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-download mx-2"></i>
                                            Download</a>
                                        @if ($assignment->assignment_status == 1)
                                            <form action="{{ route('assignment.delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $assignment->id }}">
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash mx-2"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Assigment End --}}

        {{-- Lesson Notes Start --}}
        <div class="col-12 bg-dark rounded p-3 mt-3">
            <h3 class="text-white mx-3">Information About Lesson Notes</h3>
            <div class="table-responsive mt-3">
                <table class="table table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Uploaded By</th>
                            <th>Uploaded At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($notes) == 0)
                            <tr>
                                <td colspan="8" class="text-center">No Notes Found</td>    
                            </tr>                            
                        @else
                            @foreach ($notes as $note)
                                <tr>
                                    <td>{{ $note->title }}</td>
                                    <td>{{ $note->subject->name }}</td>
                                    <td>{{ $note->grade }}</td>
                                    <td>{{ $note->teacher->name }}</td>
                                    <td>{{ $note->uploaded_at }}</td>
                                    <td class="d-flex gap-2 text-center">
                                        <a href="{{ asset('storage/notes/' . $note->file) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-download mx-2"></i>
                                            Download</a>
                                        <form action="{{ route('note.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $note->id }}">
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash mx-2"></i>
                                                Delete
                                            </button>
                                        </form>    
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Lesson Notes End --}}
    </div>
@endsection

@section('scripts')
    <script>
        updateActiveMenu('academic')
    </script>
@endsection
