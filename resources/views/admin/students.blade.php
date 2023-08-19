@extends('layouts.admin')

@section('title', 'Manage Students')

@section('section')
    @php
        $faker = Faker\Factory::create();
    @endphp
    {{-- All Graded Students Start --}}
    <div class="row mt-4">
        <div class="col-12 px-1">
            <div class="p-3 bg-dark rounded-h-100">
                <h3 class="text-light">All Graded Students Informations</h3>
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
                                <button class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#updateAllStudentModal">
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
                            @if (count($graded_students) == 0)
                                <tr>
                                    <td colspan="6" class="bg-danger text-light text-center">No Graded Students Found
                                    </td>
                                </tr>
                            @else
                                @foreach ($graded_students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->mobile }}</td>
                                        <td> Grade -
                                            @foreach ($student->grades as $grade)
                                                @if ($grade['year'] == date('Y'))
                                                    {{ $grade['grade'] }}
                                                @break
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($student->verified_at)
                                            <span>{{ $student->verified_at }}</span>
                                        @else
                                            <span class="bg-primary">Not Verified</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-success" onclick="showStudent(this)"
                                            data-student="{{ $student->id }}">
                                            <i class="fa-solid fa-eye mx-2"></i>
                                        </button>
                                        <form  action="{{ route('student.update.grade', [
                                            'student' => $student->id,
                                        ]) }}" class="d-inline-block" id="update-grade-form-{{ $student->id }}">
                                            <button type="button" class="btn btn-sm btn-warning" onclick="updateStudentGrade(this)" 
                                            data-student="{{ $student->id }}">
                                                <i class="fa-solid fa-upload mx-2"></i>
                                            </button>
                                        </form>
                                        <button class="btn btn-sm btn-primary" onclick="showEditStudent(this)"
                                            data-student="{{ $student->id }}">
                                            <i class="fa-solid fa-edit mx-2"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#removeStudentModal" data-student="{{ $student->id }}">
                                            <i class="fa-solid fa-trash mx-2"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- All Graded Student End --}}

{{-- All NON-Graded Students Start --}}
<div class="row mt-4">
    <div class="col-12 px-1">
        <div class="p-3 bg-dark rounded-h-100">
            <h3 class="text-light">All NON-Graded Students Informations</h3>
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
                        <th>Verified At</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @if (count($non_grade_students) == 0)
                            <tr>
                                <td colspan="6" class="bg-danger text-light text-center">
                                    No NON-Graded Students Found
                                </td>
                            </tr>
                        @else
                            @foreach ($non_grade_students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->mobile }}</td>
                                    <td>
                                        @if ($student->verified_at)
                                            <span>{{ $student->verified_at }}</span>
                                        @else
                                            <span class="bg-primary">Not Verified</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form class="input-group mb-3" action="{{ route('student.assign.grade') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                                            <input type="text" class="form-control" name="grade"
                                                placeholder="Enter The Grade" aria-label="Recipient's username"
                                                aria-describedby="button-addon2">
                                            <button type="submit" class="btn btn-success" type="button"
                                                id="button-addon2">Assign</button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#removeStudentModal" data-student="{{ $student->id }}">
                                            <i class="fa-solid fa-trash mx-2"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- All NON-Graded Student End --}}

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
                        <input type="text" name="email" class="form-control mb-3"
                            placeholder="Ex: johndoe@example.com">
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
                <button type="button" class="btn btn-danger"
                    onclick="addStudent('{{ $url }}');">Add</button>
            </div>
        </div>
    </div>
</div>
{{-- Add Student Modal End --}}

{{-- View Student Modal Start --}}
<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                        <input type="text" id="name" disabled class="form-control mb-3"
                            placeholder="Ex: John Doe">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mx-2">Email</label>
                        <input type="text" disabled class="form-control mb-3" id="email"
                            placeholder="Ex: johndoe@example.com">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mx-2">Mobile</label>
                        <input type="text" disabled class="form-control mb-3" id="mobile"
                            placeholder="Ex: 0771112223">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mx-2">Date Of Birth</label>
                        <input type="text" disabled class="form-control mb-3" id="dob"
                            placeholder="Ex: 2023-05-30">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mx-2">City</label>
                        <input type="text" disabled class="form-control mb-3" id="city"
                            placeholder="Ex: Colombo">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mx-2">Gender</label>
                        <input type="text" disabled class="form-control mb-3" id="gender"
                            placeholder="Ex: Male">
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
                                <tbody id="grades-body"></tbody>
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
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirm</button>
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
                        <input type="text" id="name" class="form-control mb-3" placeholder="Ex: John Doe">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mx-2">Email</label>
                        <input type="text" id="email" class="form-control mb-3" placeholder="Ex: johndoe@example.com">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mx-2">Mobile</label>
                        <input type="text" id="mobile" class="form-control mb-3" placeholder="Ex: 0771112223">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mx-2">Date Of Birth</label>
                        <input type="date" id="dob" class="form-control mb-3" placeholder="Ex: 2023-05-30">
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-warning px-4" id="update-grade-button">
                            <i class="fa-solid fa-upload mx-2"></i>
                            Update Student's Grade
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="update-button">Update</button>
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
