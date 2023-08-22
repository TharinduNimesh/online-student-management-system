@extends('layouts.admin')

@section('title', 'Dashboard')

@section('section')
    {{-- Summary Start --}}
    <div class="row">
        <div class="summary-box col-12 col-md-6 col-xl-4 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-graduation-cap text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Students</span>
                    <span class="text-primary font-bold fs-4 p-0">{{ $students_count }}</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-md-6 col-xl-4 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-chalkboard-user text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Teachers</span>
                    <span class="text-primary font-bold fs-4 p-0">{{ $teachers_count }}</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-xl-4 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-user-tie text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Officers</span>
                    <span class="text-primary font-bold fs-4 p-0">{{ $officers_count }}</span>
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
            <div class="p-3 bg-dark rounded h-100">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Recently Joined Teachers</h5>
                    <a href="{{ route('admin.teachers') }}" class="btn btn-danger d-none d-md-block">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-dark table-hover">
                        <thead>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Verified At</th>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>
                                        @if ($teacher->verified_at)
                                            {{ $teacher->verified_at }}
                                        @else
                                            Not Verified
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-3 mb-lg-0 px-1">
            <div class="p-3 bg-dark rounded h-100">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Recently Joined Officers</h5>
                    <a href="{{ route('admin.officers') }}" class="btn btn-danger d-none d-md-block">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-dark table-hover">
                        <thead>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined At</th>
                        </thead>
                        <tbody>
                            @foreach ($officers as $officer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $officer->name }}</td>
                                    <td>{{ $officer->email }}</td>
                                    <td>
                                        @if ($officer->verified_at)
                                            {{ $officer->verified_at }}
                                        @else
                                            Not Verified
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Recently Joined End --}}

    {{-- Recently Added Assignments Start --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="p-3 bg-dark rounded h-100">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Recently Added Assignments</h5>
                    <a href="{{ route('admin.academic') }}" class="btn btn-danger d-none d-md-block">Show All</a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-dark table-hover">
                        <thead>
                            <th>No</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Uploaded By</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Submissions</th>
                        </thead>
                        <tbody>
                            @foreach ($assignments as $assignment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $assignment->title }}</td>
                                    <td>{{ $assignment->subject->name }}</td>
                                    <td>{{ $assignment->teacher->name }}</td>
                                    <td>{{ $assignment->started_at }}</td>
                                    <td>{{ $assignment->ended_at }}</td>
                                    <td>{{ $assignment->submissions->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Recently Added Assignments End --}}

    {{-- Charts Start ||| Not Working Currently --}} 
    <div class="row mt-4">
        <div class="col-md-6 px-1">
            <div class="p-3 bg-dark rounded h-100">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Monthly Payments</h5>
                </div>
                <div class="p-4">
                    <canvas id="paymentChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 px-1 mt-2 mt-md-0">
            <div class="p-3 bg-dark rounded h-100">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Students By Grade</h5>
                </div>
                <div class="p-4">
                    <canvas id="gradeChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    {{-- Charts End --}}
@endsection

{{-- Scripts Start --}}
@section('scripts')
    <script>
        // active menu
        updateActiveMenu('home');

        // payment chart
        const paymentChart = document.getElementById('paymentChart');
        new Chart(paymentChart, {
            type: 'pie',
            data: {
                labels: [
                    'Red',
                    'Blue',
                    'Yellow'
                ],
                datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
        });

        // grade chart
        const gradeChart = document.getElementById('gradeChart');
        new Chart(gradeChart, {
            type: 'pie',
            data: {
                labels: [
                    'Red',
                    'Blue',
                    'Yellow'
                ],
                datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
        });
    </script>
@endsection
{{-- Scripts End --}}
