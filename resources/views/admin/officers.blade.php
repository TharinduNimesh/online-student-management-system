@extends('admin.layouts.main')

@section('title', 'Manage Staffs')

@section('section')
    @php
        $faker = Faker\Factory::create();
    @endphp

    {{-- All Officer Start --}}
    <div class="row mt-4">
        <div class="col-12 px-1">
            <div class="p-3 bg-dark rounded-h-100">
                <h3 class="text-light">All Officers Informations</h3>
                <div class="row my-2">
                    <div class="col-12 d-flex justify-content-end gap-2 px-5">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addOfficerModal">
                            <i class="fa-solid fa-user-plus mx-2"></i>
                            Add A New Officer</button>
                        <button class="btn btn-primary">
                            <i class="fa-solid fa-copy mx-2"></i>
                            Copy Invitation Link</button>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                        <input type="text" class="form-control" placeholder="Officer's name">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-dark">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Joined At</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 10; $i++)
                                <tr>
                                    <td>{{ $faker->numberBetween(1000, 9999) }}</td>
                                    <td>{{ $faker->name }}</td>
                                    <td>077{{ $faker->numberBetween(1000000, 9999999) }}</td>
                                    <td>{{ $faker->email }}</td>
                                    <td>{{ $faker->date }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editOfficerModal">
                                            <i class="fa-solid fa-edit mx-2"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#removeOfficerModal">
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
    {{-- All Officers End --}}

    {{-- All Admins Start --}}
    <div class="row mt-4">
        <div class="col-12 px-1">
            <div class="p-3 bg-dark rounded-h-100">
                <h3 class="text-light">All Admins Informations</h3>
                <div class="row my-2">
                    <div class="col-12 d-flex justify-content-end gap-2 px-5">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                            <i class="fa-solid fa-user-plus mx-2"></i>
                            Add A New Admin</button>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                        <input type="text" class="form-control" placeholder="Admin's name">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-dark">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined At</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 10; $i++)
                                <tr>
                                    <td>{{ $faker->numberBetween(1000, 9999) }}</td>
                                    <td>{{ $faker->name }}</td>
                                    <td>{{ $faker->email }}</td>
                                    <td>{{ $faker->date }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#removeAdminModal">
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
    {{-- All admin End --}}

    {{-- Modals Start --}}

    {{-- Add Officer Modal Start --}}
    <div class="modal fade" id="addOfficerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add A New Officer</h1>
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
    {{-- Add Officer Modal End --}}

    {{-- Edit Officer Modal Start --}}
    <div class="modal fade" id="editOfficerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Information Of Officers</h1>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Officer Modal End --}}

    {{-- Delete Officer Modal Start --}}
    <div class="modal fade" id="removeOfficerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">&#9888; WARNING</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        You are in the process of removing an academic officer from the management system. Please be aware
                        that
                        this action may lead to various ramifications on academic operations and administrative functions
                        related to this officer.
                    </p>

                    Before proceeding, please take the following into account:

                    <ol>
                        <li>Administrative Roles: This academic officer might be responsible for overseeing crucial
                            administrative tasks such as curriculum planning, scheduling, and faculty coordination.</li>
                        <li>Institutional Memory: Removing this officer could result in the loss of institutional knowledge
                            and
                            historical insights that contribute to the efficient functioning of the institution.</li>
                        <li>Decision-making Impact: Academic officers often play a role in strategic decisions that impact
                            the
                            institution's educational quality and direction.</li>
                    </ol>

                    <p>
                        Consider the potential implications of removing this academic officer before making a final
                        decision:
                    </p>
                    <p>
                        If you are confident in your choice to remove the academic officer and have considered the potential
                        consequences, click "Confirm" below. Alternatively, if you wish to review this decision further,
                        click
                        "Cancel."
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete Officer Modal End --}}

    {{-- Add Admin Start --}}
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add A New Officer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <h4 class="alert-heading">Attention</h4>
                        <hr>
                        <p> Introducing a new admin grants them privileges akin to yours. Only the super admin can undo
                            this. Understand the significance before you proceed.
                        </p>
                    </div>
                    <div class="row px-3 py-2">
                        <div class="col-12">
                            <label class="mx-2">Full Name</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12">
                            <label class="mx-2">Email</label>
                            <input type="text" class="form-control mb-3" placeholder="Ex: johndoe@example.com">
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
    {{-- Add Admin End --}}

    {{-- Delete Admin Start --}}
    <div class="modal fade" id="removeAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">&#9888; WARNING</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        You are about to remove an administrator from the system. Please be aware that this action could
                        have
                        significant consequences on the system's management and operational integrity.
                    </p>

                    Before you proceed, take into account the following:

                    <ol>
                        <li>Administrative Privileges: This administrator may have access to critical system settings, user
                            management, and security configurations.</li>
                        <li>Operational Continuity: Removing this administrator could disrupt ongoing administrative tasks
                            and
                            potentially impact the overall functionality of the system.</li>
                        <li>Security Implications: Admins often play a role in maintaining system security and access
                            controls.
                            Removing an admin could affect data protection and privacy measures.</li>
                    </ol>

                    <p>
                        Reflect on the potential outcomes of removing this administrator:
                        <br>
                        If you are resolute in your decision to remove the administrator and have thoroughly considered the
                        potential repercussions, click "Confirm" below. If you would like to reconsider or need more time to
                        evaluate, click "Cancel."
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete Admin end --}}

    {{-- Modals End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('officers');
    </script>
@endsection
