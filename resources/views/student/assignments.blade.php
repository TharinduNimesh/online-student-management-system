@extends('layouts.student')

@section('title', 'Assignments')

@section('section')
    {{-- Assignments Start --}}
    <div class="row mt-3">
        <div class="col-12 p-3 bg-dark">
            <div class="row">
                <h3 class="text-light mx-3">Recent Assignments</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered-table-hover table-dark">
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
                <table class="table table-bordered-table-hover table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Assignments</th>
                            <th>Answer</th>
                            <th>Status</th>
                            <th>Marks</th>
                        </tr>
                    </thead>
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
