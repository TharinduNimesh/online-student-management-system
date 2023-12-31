@extends('layouts.admin')

@section('title', 'Manage Teachers')

@section('section')
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
                            <button 
                                class="btn btn-primary" 
                                data-toggle="popover" 
                                data-bs-custom-class="custom-popover"
                                data-bs-trigger="focus"
                                data-bs-title="Success!"
                                data-bs-content="Invitation Link Copied Successfully !!!" 
                                data-bs-placement="top"
                                data-link="{{ route('auth.register.invite', [
                                    'role' => 'teacher',
                                ]) }}"
                            onclick="copyLink(this)"
                            >
                            <i class="fa-solid fa-copy mx-2"></i>
                            Copy Invitation Link</button>
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-dark">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Verified At</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @if ($teachers->isEmpty())
                                <tr>
                                    <td colspan="6" class="bg-primary font-bold text-center">No Teachers Found</td>
                                </tr>
                            @else
                            @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->city->name }}</td>
                                <td>
                                    @if ($teacher->verified_at)
                                        {{ $teacher->verified_at }}
                                    @else
                                        <span class="text-danger">Not Verified</span>                                        
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-teacher="{{ $teacher->id }}"
                                        onclick="showTeacher(this);">
                                        <i class="fa-solid fa-eye mx-2"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" data-teacher="{{ $teacher->id }}"
                                        onclick="showTeacherToEdit(this)">
                                        <i class="fa-solid fa-edit mx-2"></i>
                                    </button>
                                    <form action="{{ route('teacher.delete', [
                                        'id' => $teacher->id,
                                    ]) }}" method="get" id="remove-form-{{ $teacher->id }}" 
                                        class="d-inline-block">
                                        <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="removeTeacher({{ $teacher->id }})">
                                            <i class="fa-solid fa-trash mx-2"></i>
                                        </button>
                                    </form>
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
    {{-- All Teachers End --}}

    {{-- Modals Start --}}

    {{-- Add Teacher Modal Start --}}
    <div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content bg-dark text-light" id="add-teacher-form" action="{{ route('teacher.add') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add A New Teacher</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row px-3 py-2">
                        <div class="col-12">
                            <label class="mx-2">Full Name</label>
                            <input type="text" name="name" class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12">
                            <label class="mx-2">Email</label>
                            <input type="text" name="email" class="form-control mb-3" placeholder="Ex: johndoe@example.com">
                        </div>
                        <div class="col-12">
                            <label class="mx-2">Mobile</label>
                            <input type="text" name="mobile" class="form-control mb-3" placeholder="Ex: 0771112223">
                        </div>
                        <div class="col-12">
                            <label class="mx-2">City</label>
                            <select class="form-control mb-3" name="city">
                                <option value="">Select A City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="mx-2">Gender</label>
                            <select class="form-control mb-3" name="gender">
                                <option value="">Select The Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="addTeacher()">Add</button>
                </div>
            </form>
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
                            <input type="text" id="name" disabled class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Email</label>
                            <input type="text" id="email" disabled class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Mobile</label>
                            <input type="text" id="mobile" disabled class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">City</label>
                            <input type="text" id="city" disabled class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mx-2">Gender</label>
                            <input type="text" id="gender" disabled class="form-control mb-3" placeholder="Ex: John Doe">
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
                                    <tbody id="subjects-body"></tbody>
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
                    <form class="row px-3 py-2" action="{{ route('teacher.update') }}" 
                        method="POST" id="update-teacher-form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="col-12">
                            <label class="mx-2">Full Name</label>
                            <input type="text" id="name" name="name" 
                                class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12">
                            <label class="mx-2">Mobile</label>
                            <input type="text" id="mobile" name="mobile" 
                                class="form-control mb-3" placeholder="Ex: 0771112223">
                        </div>
                    </form>
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
                                    <tbody id="subjects-body"></tbody>
                                </table>
                            </div>
                            <div class="px-3  input-group">
                                <select class="form-control" id="subject">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-success mx-2" onclick="addSubject();">Add</button>
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
                                    <tbody id="grades-body"></tbody>
                                </table>
                            </div>
                            <div class="px-3  input-group">
                                <input type="number" class="form-control" id="grade"/>
                                <button class="btn btn-success mx-2" onclick="addGrade();">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="updateTeacher();">Update</button>
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
