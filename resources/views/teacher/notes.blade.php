@extends('layouts.teacher')

@section('title', 'Manage Notes')

@section('section')
    {{-- Notes Start --}}
    <div class="row mt-3">
        <div class="col-12 p-3 bg-dark">
            <div class="row">
                <h3 class="text-light mx-3">Information About Notes</h3>
                <div class="row my-2">
                    <div class="col-12 d-flex justify-content-end gap-2 px-5">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNotesModal">
                            <i class="fa-solid fa-notes-medical mx-2"></i>
                            Add A New Lesson Note</button>
                    </div>
                </div>
            </div>
            @if (session('error'))
            <div class="alert alert-danger col-md-8 offset-md-2">
                <h5 class="alert-heading">Error</h5>
                <hr>
                <p>{{ session('error') }}</p>
            </div>
            @elseif (session('success'))
            <div class="alert alert-success col-md-8 offset-md-2">
                <h5 class="alert-heading">Success</h5>
                <hr>
                <p>{{ session('success') }}</p>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered-table-hover table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Submited At</th>
                            <th>Note</th>
                            <th>Action</th> {{-- Delete --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($notes) == 0)
                            <tr>
                                <td colspan="7" class="bg-primary font-bold text-center">No Any Notes Found</td>
                            </tr>
                        @else
                        @foreach ($notes as $note)
                            <tr>
                                <td>{{ $note->id }}</td>
                                <td>{{ $note->title }}</td>
                                <td>{{ $note->subject->name }}</td>
                                <td>Grade - {{ $note->grade }}</td>
                                <td>{{ $note->uploaded_at }}</td>
                                <td>
                                    <a href="{{ asset('storage/notes/' . $note->file) }}" class="btn btn-success">
                                        <i class="fa-solid fa-download mx-2"></i>
                                        Download</a>
                                </td>
                                <td>
                                    <form action="{{ route('note.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $note->id }}">
                                        <button class="btn btn-danger">
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
    </div>
    {{-- Notes End --}}

    {{-- Modals Start --}}
    <div class="modal fade" id="addNotesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" id="note-form" enctype="multipart/form-data" 
                    action="{{ route('teacher.add.note') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter The Title">
                        </div>
                        <div class="col-12 mt-3 col-md-6">
                            <label for="title" class="form-label">Subject</label>
                            <select class="form-control" name="subject">
                                <option value="">Select A Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-3 col-md-6">
                            <label for="title" class="form-label">Grade</label>
                            <select class="form-control" name="grade">
                                <option value="">Select A Grade</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->grade }}">Grade - {{ $grade->grade }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="title" class="form-label">Upload File</label>
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                                <input type="file" class="form-control" accept=".pdf, .doc, .docx" name="file">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="uploadNotes();">Upload</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modals End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('notes');
    </script>
@endsection
