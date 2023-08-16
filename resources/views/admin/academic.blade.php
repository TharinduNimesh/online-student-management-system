@extends('layouts.admin')

@section('title', 'Academic Information')
    
@section('section')
    {{-- Section Start --}}
    <div class="row">
        {{-- Assignment Start --}}
        <div class="col-12 bg-dark rounded p-3 mt-3">
            <h3 class="text-white mx-3">Information About Assignments</h3>
            <div class="row px-3">
                <div class="col-12 px-3">
                    <label class="text-light mx-3">Filter By Grade</label>
                    <input type="text" class="form-control" placeholder="Ex: 9" />
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
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

                    </tbody>
                </table>
            </div>
        </div>
        {{-- Assigment End --}}

        {{-- Lesson Notes Start --}}
        <div class="col-12 bg-dark rounded p-3 mt-3">
            <h3 class="text-white mx-3">Information About Lesson Notes</h3>
            <div class="row px-3">
                <div class="col-12 px-3">
                    <label class="text-light mx-3">Filter By Grade</label>
                    <input type="text" class="form-control" placeholder="Ex: 9" />
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Uploaded By</th>
                            <th>Uploaded At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

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