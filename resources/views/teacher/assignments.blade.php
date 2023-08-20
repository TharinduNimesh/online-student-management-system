@extends('layouts.teacher')

@section('title', 'Manage Assignments')

@section('section')
    {{-- Assignments Start --}}
    <div class="row mt-3">
        <div class="col-12 p-3 bg-dark">
            <div class="row">
                <h3 class="text-light mx-3">Information About Assignments</h3>
                <div class="row my-2">
                    <div class="col-12 d-flex justify-content-end gap-2 px-5">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAssignmentModal">
                            <i class="fa-solid fa-notes-medical mx-2"></i>
                            Add A New Assignment</button>
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
            <div class="table-responsive px-4">
                <table class="table table-bordered table-hover table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Duration</th>
                            <th>Submissions</th>
                            <th>Status</th>
                            <th>Assignments</th>
                            <th>Action</th> {{-- Delete, Marks Release --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->subject->name }}</td>
                                <td>Grade - {{ $item->grade }}</td>
                                <td>{{ $item->started_at }} To {{ $item->ended_at }}</td>
                                <td>{{ '10' }}</td>
                                <td>
                                    @if ($item->assignment_status == 1 && $item->started_at < now())
                                        <span class="text-success">Started</span>
                                    @elseif ($item->assignment_status == 2)
                                        <span class="text-warning">Mark Assigned</span>
                                    @elseif ($item->assignment_status == 3)
                                        <span class="text-success">Marks Released</span>
                                    @else
                                        <span class="text-danger">Not Started</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->file_name)
                                        
                                        <a href="{{ asset('storage/assignments/' . $item->file_name) }}" 
                                            target="_blank" class="btn btn-success">
                                            <i class="fa-solid fa-download mx-2"></i>
                                            Download
                                        </a>
                                    @else
                                        <span class="text-danger">No File</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-evenly gap-2">
                                        @if ($item->assignment_status == 1 && $item->ended_at < now())
                                        <form method="POST" action="{{ route('assignment.update.status') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="hidden" name="status" value="2">
                                            <button href="#" class="btn btn-warning">
                                                <i class="fa-solid fa-edit mx-2"></i>
                                                Mark As Marks Assigned
                                            </button>
                                        </form>
                                        @endif
                                        @if ($item->assignment_status == 1)
                                        <form action="{{ route('assignment.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button class="btn btn-danger">
                                                <i class="fa-solid fa-trash mx-2"></i>
                                                Delete
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Assignments End --}}

    {{-- Submissions Start --}}
    <div class="row mt-3">
        <div class="col-12 p-3 bg-dark">
            <div class="row">
                <h3 class="text-light mx-3">Submited Answers</h3>
            </div>
            <div class="table-responsive px-4">
                <table class="table table-bordered table-hover table-dark">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Submitted At</th>
                            <th>Answers</th>
                            <th>Marks</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    {{-- Submissions End --}}

    {{-- Modals Start --}}
    <div class="modal fade" id="addAssignmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Assignments</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" method="POST" id="assignment-form" 
                action="{{ route('teacher.add.assignment') }}" enctype="multipart/form-data">
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
                        <div class="col-12 col-md-6 mt-3">
                            <label for="title" class="form-label">Grade</label>
                            <select class="form-control" name="grade">
                                <option value="">Select A Grade</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">Grade - {{ $grade->grade }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-3 col-md-6">
                            <label for="title" class="form-label">Start At</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="col-12 mt-3 col-md-6">
                            <label for="title" class="form-label">End At</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                        <div class="col-12 mt-3">
                            <label for="title" class="form-label">Upload File</label>
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                                <input type="file" class="form-control" accept=".pdf, .doc, .docx," name="file">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label>Description</label>
                            <textarea class="form-control" name="description" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="uploadAssignment();">Upload</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modals End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('assignments');
    </script>
@endsection
