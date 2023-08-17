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
            <div class="table-responsive">
                <table class="table table-bordered-table-hover table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Submited At</th>
                            <th>Action</th> {{-- Delete --}}
                        </tr>
                    </thead>
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
                        <div class="col-12 mt-3 col-md-6">
                            <label for="title" class="form-label">Grade</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter The Title">
                        </div>
                        <div class="col-12 mt-3">
                            <label for="title" class="form-label">Upload File</label>
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                                <input type="file" class="form-control" id="inputGroupFile01">
                            </div>
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
        updateActiveMenu('notes');
    </script>
@endsection
