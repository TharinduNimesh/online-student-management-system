@extends('layouts.student')

@section('title', 'Payments')

@section('section')
    {{-- Online Payment Start --}}
    <div class="row mt-3">
        <div class="col-12 p-3 bg-dark">
            <div class="row">
                <h3 class="text-light mx-3">Online Payments</h3>
            </div>
            <div class="row text-light mt-3 px-3">
                <div class="col-md-6 mb-3">
                    <label class="mx-3">First Name
                        <span class="text-primary">:</span>
                    </label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="mx-3">Last Name
                        <span class="text-primary">:</span>
                    </label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="mx-3">Email
                        <span class="text-primary">:</span>
                    </label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="mx-3">Mobile
                        <span class="text-primary">:</span>
                    </label>
                    <input type="text" class="form-control" maxlength="10" minlength="9">
                </div>
                <div class="col-12 mb-3">
                    <label class="mx-3">Address
                        <span class="text-primary">:</span>
                    </label>
                    <input type="text" class="form-control" maxlength="10" minlength="9">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="mx-3">Grade
                        <span class="text-primary">:</span>
                    </label>
                    <select class="form-control">
                        <option value="">Select A Grade</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="mx-3">City
                        <span class="text-primary">:</span>
                    </label>
                    <select class="form-control">
                        <option value="">Select A City</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-danger">Pay Now</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Online Payment End --}}

    {{-- Upload Pay Reciept Start --}}
    <div class="row mt-3">
        <div class="col-12 bg-dark p-3 rounded">
            <h3 class="text-light mx-3">Upload Paid Receipt</h3>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="alert alert-danger mt-3 text-center">
                        <strong>Warning!</strong> Please Upload Clear Image Of Your Receipt.
                    </div>
                </div>
            </div>
            <div class="row text-light mt-3">
                <div class="col-md-6 mb-3">
                    <label class="mx-3">Grade
                        <span class="text-primary">:</span>
                    </label>
                    <select class="form-control">
                        <option value="">Select A Grade</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="mx-3">Reciept
                        <span class="text-primary">:</span>
                    </label>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupFile01">Upload</label>
                        <input type="file" class="form-control" id="inputGroupFile01">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-danger">Upload Now</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Upload Pay Reciept End --}}

    {{-- Paymend History Start --}}
    <div class="row mt-3">
        <div class="col-12 p-3 bg-dark">
            <h3 class="text-light mx-3">Payment History</h3>
            <div class="table-responsive mt-3">
                <table class="table table-bordered-table-hover table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Grade</th>
                            <th>Status</th>
                            <th>Paid At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    {{-- Paymend History End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('payments');
    </script>
@endsection
