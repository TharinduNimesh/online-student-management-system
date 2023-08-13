@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('section')
    {{-- Summary Start --}}
    <div class="row">
        <div class="summary-box col-12 col-md-6 col-xl-3 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-graduation-cap text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Students</span>
                    <span class="text-primary font-bold fs-4 p-0">2300</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-md-6 col-xl-3 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-chalkboard-user text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Teachers</span>
                    <span class="text-primary font-bold fs-4 p-0">2300</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-md-6 col-xl-3 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-user-tie text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Officers</span>
                    <span class="text-primary font-bold fs-4 p-0">2300</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-md-6 col-xl-3 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-user-secret text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Admins</span>
                    <span class="text-primary font-bold fs-4 p-0">2300</span>
                </div>
            </div>
        </div>
    </div>
    {{-- Summary End --}}

    @php
        $faker = Faker\Factory::create();
    @endphp

    {{-- Recent Joined Start --}}
    <div class="row mt-4">
        <div class="col-lg-6 mb-3 mb-lg-0 px-1">
            <div class="p-3 bg-dark rounded">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Recently Joined Teachers</h5> 
                    <a href="#" class="btn btn-danger d-none d-md-block">Show All</a>                   
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-dark">
                        <thead>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined At</th>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $faker->name }}</td>
                                    <td>{{ $faker->email }}</td>
                                    <td>{{ $faker->date }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-3 mb-lg-0 px-1">
            <div class="p-3 bg-dark rounded">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Recently Joined Officers</h5> 
                    <a href="#" class="btn btn-danger d-none d-md-block">Show All</a>                   
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-dark">
                        <thead>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined At</th>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $faker->name }}</td>
                                    <td>{{ $faker->email }}</td>
                                    <td>{{ $faker->date }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Recently Joined End --}}
@endsection