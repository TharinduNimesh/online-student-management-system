@extends('layouts.admin')

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
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
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
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 10; $i++)
                                <tr>
                                    <td>{{ $faker->numberBetween(1000, 9999) }}</td>
                                    <td>{{ $faker->name }}</td>
                                    <td>{{ $faker->email }}</td>
                                    <td>{{ $faker->city }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#viewTeacherModal">
                                            <i class="fa-solid fa-eye mx-2"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editTeacherModal">
                                            <i class="fa-solid fa-edit mx-2"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#removeTeacherModal">
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

    {{-- Modals Start --}}

    {{-- Add Teacher Modal Start --}}
    <div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add A New Teacher</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row px-3 py-2">
                        <div class="col-12">
                            <label class="mx-2">Full Name</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12">
                            <label class="mx-2">Email</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: johndoe@example.com">
                        </div>
                        <div class="col-12">
                            <label class="mx-2">Mobile</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: 0771112223">
                        </div>
                        <div class="col-12">
                            <label class="mx-2">City</label>
                            <select class="form-control mb-3">
                                <option value="">Select A City</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="mx-2">Gender</label>
                            <select class="form-control mb-3">
                                <option value="">Select The Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Add</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Add Teacher Modal End --}}

    {{-- View Teacher Modal Start --}}
    <div class="modal fade" id="viewTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Information Of Teachers</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row px-3 py-2">
                        <div class="col-12">
                            <label class="mx-2">Full Name</label>
                            <input type="text" disabled class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Email</label>
                            <input type="text" disabled class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Mobile</label>
                            <input type="text" disabled class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">City</label>
                            <input type="text" disabled class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Gender</label>
                            <input type="text" disabled class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6 p-3">
                            <h1 class="fs-5 mx-3">Subjects</h1>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 5; $i++)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>Subject {{ $i + 1 }}</td>
                                                <td class="text-center">
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

                        <div class="col-12 col-md-6 p-3">
                            <h1 class="fs-5 mx-3">Grade</h1>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Grade</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 5; $i++)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>Grade - {{ $i + 1 }}</td>
                                                <td class="text-center">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- View Teacher Modal End --}}

    {{-- Edit Teacher Modal Start --}}
    <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Teacher's Informations</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row px-3 py-2">
                        <div class="col-12">
                            <label class="mx-2">Full Name</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Email</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Mobile</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6 p-3">
                            <h1 class="fs-5 mx-3">Subjects</h1>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 5; $i++)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>Subject {{ $i + 1 }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fa-solid fa-trash mx-2"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            <div class="px-3  input-group">
                                <select class="form-control">
                                    <option value="">Select Subject</option>
                                    <option value="">Subject 1</option>
                                    <option value="">Subject 2</option>
                                    <option value="">Subject 3</option>
                                </select>
                                <button class="btn btn-success mx-2">Add</button>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 p-3">
                            <h1 class="fs-5 mx-3">Grade</h1>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Grade</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 5; $i++)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>Grade - {{ $i + 1 }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fa-solid fa-trash mx-2"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            <div class="px-3  input-group">
                                <input type="number" class="form-control" />
                                <button class="btn btn-success mx-2">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Teacher Modal End --}}

    {{-- Delete Teacher Modal Start --}}
    <div class="modal fade" id="removeTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">&#9888; WARNING</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        You are about to remove a teacher from the management system. Please be aware that this action can
                        have
                        consequences on other teacher-related data, including courses, assignments, and student records
                        associated with this teacher.
                    </p>
                    Before proceeding, consider the following:
                    <ol>
                        <li>Student Records: Removing a teacher may result in orphaned student records without proper
                            instructor assignments.</li>
                        <li>Course Continuity: Courses taught by this teacher might be disrupted, affecting students'
                            learning progress.</li>
                        <li>Assignment Ownership: Assignments linked to this teacher may become unassigned, causing
                            confusion among students and fellow teachers.</li>
                    </ol>
                    <p>
                        If you are certain about removing this teacher and have accounted for the potential consequences,
                        click
                        "Confirm" below. Otherwise, click "Cancel" to go back and review your decision.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete Teacher Modal End --}}

    {{-- Modals End --}}
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
