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
                    <span class="text-secondary p-0 fs-6 font-bold">Assignments</span>
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
                    <span class="text-secondary p-0 fs-6 font-bold">Average Marks</span>
                    <span class="text-primary font-bold fs-4 p-0">2300</span>
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
                    <a href="#" class="btn btn-danger d-none d-md-block">Show All</a>
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
                            <th>Marks</th>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $faker->sentence }}</td>
                                    <td>{{ $faker->word }}</td>
                                    <td>{{ $faker->name }}</td>
                                    <td>{{ $faker->date }}</td>
                                    <td>
                                        <button class="btn btn-success px-3">
                                            <i class="fa-solid fa-circle-down mx-1"></i>
                                            Download
                                        </button>
                                    </td>
                                    <td>{{ $faker->numberBetween(0, 100) }}</td>
                                </tr>
                            @endfor
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
                    <a href="#" class="btn btn-danger d-none d-md-block">Show All</a>
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
                            @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $faker->sentence }}</td>
                                    <td>{{ $faker->numberBetween(1, 15) }}</td>
                                    <td>{{ $faker->word }}</td>
                                    <td>{{ $faker->date }}</td>
                                    <td>
                                        <button class="btn btn-success px-3">
                                            <i class="fa-solid fa-circle-down mx-1"></i>
                                            Download
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
    {{-- Recently Added Assignments End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('dashboard');
    </script>
@endsection
