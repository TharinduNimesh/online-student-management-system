@extends('layouts.officer')

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
                    <span class="text-secondary p-0 fs-6 font-bold">Students</span>
                    <span class="text-primary font-bold fs-4 p-0">2300</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-md-6 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-chart-area text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Pending Assignments</span>
                    <span class="text-primary font-bold fs-4 p-0">2300</span>
                </div>
            </div>
        </div>
    </div>
    {{-- Summary End --}}

    @php
        $faker = Faker\Factory::create();
    @endphp

    {{-- Marks Released Assignments Start --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="p-3 bg-dark rounded h-100">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Marks Released Assignments</h5>
                    <a href="#" class="btn btn-danger d-none d-md-block">Show All</a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-dark table-hover">
                        <thead>
                            <th>No</th>
                            <th>Subject</th>
                            <th>Marked By</th>
                            <th>Marked At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $faker->word }}</td>
                                    <td>{{ $faker->date }}</td>
                                    <td>{{ $faker->date }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-danger px-3">
                                            <i class="fa-solid fa-square-share-nodes mx-1"></i>
                                            Release Marks
                                        </button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Marks Released Assignments End --}}

    {{-- Non Verified Students Start --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="p-3 bg-dark rounded h-100">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Non Verified Students</h5>
                    <a href="#" class="btn btn-danger d-none d-md-block">Show All</a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-dark table-hover">
                        <thead>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $faker->name }}</td>
                                    <td>{{ $faker->email }}</td>
                                    <td>077{{ $faker->numberBetween(1000000, 9999999) }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary px-3">
                                            <i class="fa-solid fa-paper-plane"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger px-3">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Non Verified Students End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('dashboard');
    </script>
@endsection
