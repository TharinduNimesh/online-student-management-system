@extends('layouts.admin')

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
                            <button 
                                class="btn btn-primary" 
                                data-toggle="popover" 
                                data-bs-custom-class="custom-popover"
                                data-bs-trigger="focus"
                                data-bs-title="Success!"
                                data-bs-content="Invitation Link Copied Successfully !!!" 
                                data-bs-placement="top"
                                data-link="{{ route('auth.register.invite', [
                                    'role' => 'officer',
                                ]) }}"
                            onclick="copyLink(this)"
                            >
                            <i class="fa-solid fa-copy mx-2"></i>
                            Copy Invitation Link</button>
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger col-md-8 offset-md-2">
                        <h5 class="alert-heading">Error</h5>
                        <hr>
                        <p>{{ session('error') }}</p>
                    </div>
                @elseif (session('success'))
                    <div class="alert alert-success col-md-8 offset-md-2">
                        <h5 class="alert-heading">Success</h5>
                        <hr>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
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
                            @if (count($officers) == 0)
                                <tr>
                                    <td colspan="6" class="bg-primary font-bold text-center">No Officers Found</td>
                                </tr>
                            @else
                                @foreach ($officers as $officer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $officer->name }}</td>
                                        <td>{{ $officer->mobile }}</td>
                                        <td>{{ $officer->email }}</td>
                                        <td>
                                            @if ($officer->verified_at)
                                                {{ $officer->verified_at }}
                                            @else
                                                <p class="text-primary">Not Verified</p>
                                            @endif    
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('officer.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $officer->id }}">
                                                <button class="btn btn-sm btn-danger">
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
    {{-- All Officers End --}}

    {{-- Modals Start --}}

    {{-- Add Officer Modal Start --}}
    <div class="modal fade" id="addOfficerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add A New Officer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" action="{{ route('officer.add') }}" method="POST" id="officer-form">
                    @csrf
                    <div class="row px-3 py-2">
                        <div class="col-12">
                            <label class="mx-2">Full Name</label>
                            <input type="text" name="name" class="form-control mb-3" placeholder="Ex: John Doe">
                        </div>
                        <div class="col-12">
                            <label class="mx-2">Email</label>
                            <input type="text" name="email" class="form-control mb-3"
                                placeholder="Ex: johndoe@example.com">
                        </div>
                        <div class="col-12">
                            <label class="mx-2">Mobile</label>
                            <input type="text" name="mobile" class="form-control mb-3" placeholder="Ex: 0771112223">
                        </div>
                        <div class="col-12">
                            <label class="mx-2">City</label>
                            <select class="form-control mb-3" name="city">
                                <option value="">Select The City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">
                                        {{ $city->name }}
                                    </option>
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
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="addOfficer();">Add</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Add Officer Modal End --}}

    {{-- Modals End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('officers');
    </script>
@endsection
