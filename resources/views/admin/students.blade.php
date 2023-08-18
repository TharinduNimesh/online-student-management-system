@extends('layouts.admin')

@section('title', 'Manage Students')

@section('section')
    @php
        $faker = Faker\Factory::create();
    @endphp
    {{-- All Students Start --}}
    <div class="row mt-4">
        <div class="col-12 px-1">
            <div class="p-3 bg-dark rounded-h-100">
                <h3 class="text-light">All Students Informations</h3>
                <div class="row my-2">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end gap-2 px-5">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                                    <i class="fa-solid fa-user-plus mx-2"></i>
                                    Add A New Student</button>
                                <button class="btn btn-primary">
                                    <i class="fa-solid fa-copy mx-2"></i>
                                    Copy Invitation Link</button>
                            </div>
                            <div class="col-12 d-flex justify-content-end gap-2 px-5 mt-3">
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateAllStudentModal">
                                    <i class="fa-solid fa-upload mx-2"></i>
                                    Update All Students Grade</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                        <input type="text" class="form-control" placeholder="Student's name">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-dark">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Current Grade</th>
                            <th>Verified At</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 10; $i++)
                                <tr>
                                    <td>{{ $faker->numberBetween(1000, 9999) }}</td>
                                    <td>{{ $faker->name }}</td>
                                    <td>077{{ $faker->numberBetween(1000000, 9999999) }}</td>
                                    <td>{{ $faker->numberBetween(1, 14) }}</td>
                                    <td>{{ $faker->date }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#viewStudentModal">
                                            <i class="fa-solid fa-eye mx-2"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#updateStudentGrade">
                                            <i class="fa-solid fa-upload mx-2"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editStudentModal">
                                            <i class="fa-solid fa-edit mx-2"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#removeStudentModal">
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
    {{-- All Student End --}}

    {{-- Modals Start --}}

    {{-- Add Student Modal Start --}}
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add A New Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row px-3 py-2" id="add_student_form">
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Full Name</label>
                            <input type="text" name="name" class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Email</label>
                            <input type="text" name="email" class="form-control mb-3" placeholder="Ex: johndoe@example.com">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Mobile</label>
                            <input type="text" name="mobile" class="form-control mb-3" placeholder="Ex: 0771112223">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Date Of Birth</label>
                            <input type="date" name="dob" class="form-control mb-3" placeholder="Ex: 0771112223">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">City</label>
                            <select class="form-control mb-3" name="city">
                                <option value="">Select The City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Gender</label>
                            <select class="form-control mb-3" name="gender">
                                <option value="">Select The Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @php($url = route('student.add'))
                    <button type="button" class="btn btn-danger" onclick="addStudent('{{ $url }}');">Add</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Add Student Modal End --}}

    {{-- View Student Modal Start --}}
    <div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">More Information About Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row px-3 py-2">
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Full Name</label>
                            <input type="text" disabled class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Email</label>
                            <input type="text" disabled class="form-control mb-3"
                                placeholder="Ex: johndoe@example.com">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Mobile</label>
                            <input type="text" disabled class="form-control mb-3" placeholder="Ex: 0771112223">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Date Of Birth</label>
                            <input type="text" disabled class="form-control mb-3" placeholder="Ex: 2023-05-30">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">City</label>
                            <input type="text" disabled class="form-control mb-3" placeholder="Ex: Colombo">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Gender</label>
                            <input type="text" disabled class="form-control mb-3" placeholder="Ex: Male">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 p-3">
                            <h3 class="mx-3 ">Payment Information</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-dark">
                                    <thead>
                                        <th>Year</th>
                                        <th>Grade</th>
                                        <th>Has Paid</th>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 10; $i++)
                                            <tr>
                                                <td>{{ $faker->year }}</td>
                                                <td>Grade {{ $i + 1 }}</td>
                                                <td>{{ $faker->randomElement(['Yes', 'No']) }}</td>
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
    {{-- View Student Modal End --}}

    {{-- Update Students Grade Start --}}
    <div class="modal fade" id="updateStudentGrade" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">CAUTION</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You are about to modify the student's grade by one point. Confirm this action?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Update Students Grade End --}}

    {{-- Edit Student Modal Start --}}
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Student's Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row px-3 py-2">
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Full Name</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Email</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: johndoe@example.com">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Mobile</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: 0771112223">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Date Of Birth</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: 2023-05-30">
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-warning px-4">
                                <i class="fa-solid fa-upload mx-2"></i>
                                Update Student's Grade
                            </button>
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
    {{-- Edit Student Modal End --}}

    {{-- remove Students Grade Start --}}
    <div class="modal fade" id="removeStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">WARNING</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Removing the student will permanently delete their records. Are you sure you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    {{-- remove Students Grade End --}}

    {{-- update all Students Grade Start --}}
    <div class="modal fade" id="updateAllStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">WARNING</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Updating all student grades by one point will affect all records. Confirm this update?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    {{-- update all Students Grade End --}}

    {{-- Modals End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('students')
    </script>
@endsection
