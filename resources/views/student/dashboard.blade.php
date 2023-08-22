@extends('layouts.student')

@section('title', 'Dashboard')

@section('section')
    {{-- Summary Start --}}
    <div class="row">
        <div class="summary-box col-12 col-md-6 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-clipboard-check text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Submissions</span>
                    <span class="text-primary font-bold fs-4 p-0">{{ $submissions_count }}</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-md-6 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-chart-area text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Average Marks</span>
                    <span class="text-primary font-bold fs-4 p-0">{{ $average }}%</span>
                </div>
            </div>
        </div>
    </div>
    {{-- Summary End --}}

    @php
        $faker = Faker\Factory::create();
    @endphp

    {{-- Recently Added Assignments Start --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="p-3 bg-dark rounded h-100">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Recently Added Assignments</h5>
                    <a href="{{ route('student.assignments') }}" class="btn btn-danger d-none d-md-block">Show All</a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-dark table-hover">
                        <thead>
                            <th>No</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Download</th>
                        </thead>
                        <tbody>
                            @if ($assignments->count() == 0)
                                <tr>
                                    <td colspan="6" class="bg-primary font-bold text-center">No Assignments Found</td>
                                </tr>
                            @else
                                @foreach ($assignments as $assignment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $assignment->title }}</td>
                                        <td>{{ $assignment->subject->name }}</td>
                                        <td>{{ $assignment->started_at }}</td>
                                        <td>{{ $assignment->ended_at }}</td>
                                        <td>
                                            <a href="{{ asset('storage/assignments/' . $assignment->file_name) }}" 
                                                class="btn btn-success px-3">
                                                <i class="fa-solid fa-circle-down mx-1"></i>
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Recently Added Assignments End --}}

    {{-- Recently Added Assignments Start --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="p-3 bg-dark rounded h-100">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Recently Added Note Lessons</h5>
                    <a href="{{ route('student.notes') }}" class="btn btn-danger d-none d-md-block">Show All</a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-dark table-hover">
                        <thead>
                            <th>No</th>
                            <th>Title</th>
                            <th>Grade</th>
                            <th>Subject</th>
                            <th>Uploaded At</th>
                            <th>Download</th>
                        </thead>
                        <tbody>
                            @if ($notes->count() == 0)
                                <tr>
                                    <td colspan="6" class="bg-primary font-bold text-center">No Note Lessons Found</td>
                                </tr>
                            @else
                                @foreach ($notes as $note)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $note->title }}</td>
                                        <td>{{ $note->grade }}</td>
                                        <td>{{ $note->subject->name }}</td>
                                        <td>{{ $note->uploaded_at }}</td>
                                        <td>
                                            <a href="{{ asset('storage/notes/' . $note->file) }}" 
                                                class="btn btn-success px-3">
                                                <i class="fa-solid fa-circle-down mx-1"></i>
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Recently Added Assignments End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('dashboard');
    </script>
@endsection
