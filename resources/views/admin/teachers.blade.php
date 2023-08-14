@extends('admin.layouts.main')

@section('title', 'Manage Teachers')

@section('section')
    {{-- Charts Start --}}
    <div class="row mt-4">
        <div class="col-md-6 px-1">
            <div class="p-3 bg-dark rounded h-100">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Teachers By Subjects</h5>
                </div>
                <div class="p-4">
                    <canvas id="subjectChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 px-1 mt-2 mt-md-0">
            <div class="p-3 bg-dark rounded h-100">
                <div class="w-100 mb-3 d-flex justify-content-between align-items-center px-2">
                    <h5 class="text-secondary mx-3">Teachers By Grade</h5>
                </div>
                <div class="p-4">
                    <canvas id="gradeChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    {{-- Charts End --}}

    @php
        $faker = Faker\Factory::create();
    @endphp

    {{-- All Teachers Start --}}
    <div class="row mt-4">
        <div class="col-12 px-1">
            <div class="p-3 bg-dark rounded-h-100">
                <h3 class="text-light">All Teachers Informations</h3>
                <div class="row my-2">
                    <div class="col-12 d-flex justify-content-end gap-2 px-5">
                        <button class="btn btn-success">
                            <i class="fa-solid fa-user-plus mx-2"></i>
                            Add A New Teacher</button>
                        <button class="btn btn-primary">
                            <i class="fa-solid fa-copy mx-2"></i>
                            Copy Invitation Link</button>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                        <input type="text" class="form-control" placeholder="Teacher's name">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-dark">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Subjects</th>
                            <th>Grades</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 10; $i++)
                                <tr>
                                    <td>{{ $faker->numberBetween(1000, 9999) }}</td>
                                    <td>{{ $faker->name }}</td>
                                    <td>{{ $faker->email }}</td>
                                    <td>{{ $faker->city }}</td>
                                    <td>{{ $faker->word }}</td>
                                    <td>{{ $faker->numberBetween(0, 13) }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-success">
                                            <i class="fa-solid fa-eye mx-2"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-edit mx-2"></i>
                                            </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash mx-2"></i>
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
    {{-- All Teachers End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('teachers');

        // subject chart
        const subjectChart = document.getElementById('subjectChart');
        new Chart(subjectChart, {
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
