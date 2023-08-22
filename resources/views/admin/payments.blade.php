@extends('layouts.admin')

@section('title', 'Payments')

@section('section')
    {{-- Section Start --}}
    <div class="row">
        {{-- Manual Payments Start --}}
        <div class="col-12 bg-dark rounded p-3 mt-3">
            <h3 class="text-white mx-3">Manual Payments</h3>
            <div class="table-responsive mt-3">
                <table class="table table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Grade</th>
                            <th>Receipt</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        {{-- Manual Payments End --}}

        {{-- Non-Payment Students --}}
        <div class="col-12 bg-dark rounded p-3 mt-3">
            <h3 class="text-white mx-3">Non-Payment Students</h3>
            <div class="table-responsive mt-3">
                <table class="table table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Grade</th>
                            <th>Months</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        {{-- Non-Payment Students --}}
    </div>
@endsection

@section('scripts')
    <script>
        updateActiveMenu('payments');
        Swal.fire({
            title: 'Coming Soon!',
            text: 'This feature is not available yet. Please check back later.',
            icon: 'info',
            confirmButtonText: 'OK'
        });
    </script>
@endsection