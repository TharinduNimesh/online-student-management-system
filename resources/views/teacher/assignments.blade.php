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
            <div class="table-responsive">
                <table class="table table-bordered-table-hover table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Submissions</th>
                            <th>Status</th>
                            <th>Assignments</th>
                            <th>Action</th> {{-- Delete, Marks Release --}}
                        </tr>
                    </thead>
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
            <div class="table-responsive">
                <table class="table table-bordered-table-hover table-dark">
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
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter The Title">
                        </div>
                        <div class="col-12 mt-3 col-md-6">
                            <label for="title" class="form-label">Subject</label>
                            <select class="form-control">
                                <option value="">Select A Subject</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <label for="title" class="form-label">Grade</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter The Grade">
                        </div>
                        <div class="col-12 mt-3 col-md-6">
                            <label for="title" class="form-label">Start At</label>
                            <input type="date" class="form-control" id="start_date">
                        </div>
                        <div class="col-12 mt-3 col-md-6">
                            <label for="title" class="form-label">End At</label>
                            <input type="date" class="form-control" id="end_date">
                        </div>
                        <div class="col-12 mt-3">
                            <label for="title" class="form-label">Upload File</label>
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                                <input type="file" class="form-control" id="inputGroupFile01">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label>Description</label>
                            <textarea class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Upload</button>
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
