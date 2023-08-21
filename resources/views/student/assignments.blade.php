@extends('layouts.student')

@section('title', 'Assignments')

@section('section')
    {{-- Assignments Start --}}
    <div class="row mt-3">
        <div class="col-12 p-3 bg-dark">
            <div class="row">
                <h3 class="text-light mx-3">Recent Assignments</h3>
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
                <table class="table table-bordered table-hover table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Assignments</th>
                            <th>Action</th> {{-- Upload Assignment --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($assignments) == 0)
                            <tr>
                                <td colspan="7" class="bg-primary font-bold text-center">No Assignments Found</td>
                            </tr>
                        @else                            
                        @foreach ($assignments as $assignment)
                            <tr>
                                <td>{{ $assignment->id }}</td>
                                <td>{{ $assignment->title }}</td>
                                <td>{{ $assignment->subject->name }}</td>
                                <td>{{ $assignment->started_at }}</td>
                                <td>{{ $assignment->ended_at }}</td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/assignments/' . $assignment->file_name) }}" target="_blank"
                                        class="btn btn-success">Download</a>
                                </td>
                                <td>
                                    <form class="input-group" action="{{ route('student.add.submission') }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="assignment" value="{{ $assignment->id }}">
                                        <input required accept=".pdf, .doc, .docx" type="file" class="form-control" name="file" 
                                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                        <button class="btn btn-warning" id="inputGroupFileAddon04">Upload</button>
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
    {{-- Assignments End --}}

    {{-- Answers Start --}}
    <div class="row mt-3">
        <div class="col-12 p-3 bg-dark">
            <div class="row">
                <h3 class="text-light mx-3">Submitted Assignments</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Assignments</th>
                            <th>Answer</th>
                            <th>Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($submissions) == 0)
                            <tr>
                                <td colspan="7" class="bg-primary font-bold text-center">No Answers Found</td>
                            </tr>
                        @else                            
                        @foreach ($submissions as $answer)
                            <tr>
                                <td>{{ $answer->id }}</td>
                                <td>{{ $answer->assignment->title }}</td>
                                <td>{{ $answer->assignment->subject->name }}</td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/assignments/' . $answer->assignment->file_name) }}" target="_blank"
                                        class="btn btn-success">Download</a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/submissions/' . $answer->file) }}" target="_blank"
                                        class="btn btn-primary">Download</a>
                                </td>
                                <td>
                                    @if ($answer->assignment->assignment_status == 1)
                                        <span>Pending</span>
                                    @elseif ($answer->assignment->assignment_status == 2)
                                        <span>Marks Assigned</span>
                                    @elseif ($answer->marks)
                                        <span>{{ $answer->marks }}</span>
                                    @else
                                        <span>Rejected</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Answers End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('assignments');
    </script>
@endsection
