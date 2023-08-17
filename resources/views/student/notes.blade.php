@extends('layouts.student')

@section('title', 'Notes')

@section('section')
    {{-- Notes Start --}}
    <div class="row mt-3">
        <div class="col-12 p-3 bg-dark">
            <div class="row">
                <h3 class="text-light mx-3">Lesson Notes</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered-table-hover table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Lesson Note</th>
                            <th>Submited At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    {{-- Notes End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('notes');
    </script>
@endsection
