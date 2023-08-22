@extends('layouts.teacher')

@section('title', 'Dashboard')

@section('section')
    {{-- Summary Start --}}
    <div class="row">
        <div class="summary-box col-12 col-md-6 col-xl-4 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-chalkboard-user text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Grade</span>
                    <span class="text-primary font-bold fs-4 p-0">{{ $grade->grade }}</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-md-6 col-xl-4 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-clipboard-check text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Assignments</span>
                    <span class="text-primary font-bold fs-4 p-0">{{ $assignments_count }}</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-xl-4 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-clipboard-list text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Notes</span>
                    <span class="text-primary font-bold fs-4 p-0">{{ $notes_count }}</span>
                </div>
            </div>
        </div>
    </div>
    {{-- Summary End --}}

    {{-- Answer Submissions Start --}}
    <div class="row mt-3">
        <div class="col-12 p-3 bg-dark">
            <div class="row">
                <div class="col-12 d-flex justify-content-between px-3 my-3">
                    <h3 class="text-light mx-3">Recently Submited Answers</h3>
                    <a href="{{ route('teacher.assignments') }}" class="btn btn-danger">Show All</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered-table-hover table-dark">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Submitted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($submissions->count() == 0)
                            <tr>
                                <td colspan="6" class="text-center">No Submissions Found</td>
                            </tr>
                        @else
                            @foreach ($submissions as $submission)
                                <tr>
                                    <td>{{ $submission->student->name }}</td>
                                    <td>{{ $submission->assignment->title }}</td>
                                    <td>{{ $submission->assignment->subject->name }}</td>
                                    <td>{{ $submission->assignment->grade }}</td>
                                    <td>{{ $submission->submitted_at>format('d M Y h:i A') }}</td>
                                    <td>
                                        <a href="{{ asset('storage/submissions/' . $submission->file) }}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Answer Submissions End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu("home");
    </script>
@endsection
