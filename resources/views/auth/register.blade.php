@extends('base')

@php $role = Str::ucfirst(request()->role); @endphp

@section('title', $role . ' Registration')

@section('content')
    <div class="login container-fluid">
        <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <div class="layer"></div>
            <div class="box col-11 col-md-8 col-lg-7 bg-dark rounded p-5 position-relative">
                <form class="row" action="{{ route('auth.register') }}" method="POST" id="user-register-form">
                    @csrf
                    <div class="col-12 text-center mb-3">
                        <img src="/img/logo.png" width="100px">
                        <h1 class="text-light">School<span class="text-primary">Plus</span></h1>
                        <p class="text-light">Empowering Education System While Pandemic</p>
                    </div>
                    <div class="col-md-8 offset-md-2 alert alert-danger text-center d-none" id="error-message">

                    </div>
                    @if (session('success'))
                        <div class="col-md-8 offset-md-2 alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="col-md-8 offset-md-2 alert alert-danger text-center">
                            {{ session('error') }}
                        </div>
                    @endif
                    <input type="hidden" name="role" value="{{ request()->role }}">
                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-primary" id="basic-addon1">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input type="text" name="name" class="form-control" placeholder="Full Name"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-primary" id="basic-addon1">
                                <i class="fa-solid fa-phone-volume"></i>
                            </span>
                            <input type="text" class="form-control" name="mobile" placeholder="Mobile Number"
                                aria-label="Username" aria-describedby="basic-addon1" minlength="9" maxlength="10">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-primary" id="basic-addon1">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" name="email" placeholder="Email Address"
                                aria-label="Username" aria-describedby="basic-addon1" >
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-primary" id="basic-addon1">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" onkeyup="checkPassword(this)" class="form-control" name="password" placeholder="Strong Password"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-primary" id="basic-addon1">
                                <i class="fa-solid fa-tree-city"></i>
                            </span>
                            <select class="form-control" name="city" placeholder="Mobile Number"
                                aria-label="Username" aria-describedby="basic-addon1">
                                <option value="">Select Your City</option>
                                @php
                                    $cities = \App\Models\City::all()->sortBy('name');
                                @endphp
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-primary" id="basic-addon1">
                                <i class="fa-solid fa-person-half-dress"></i>
                            </span>
                            <select class="form-control" name="gender" placeholder="Mobile Number"
                                aria-label="Username" aria-describedby="basic-addon1">
                                <option value="">Select Your Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-column align-items-center mt-3">
                        <button class="btn btn-danger px-5" onclick="register();" type="button">
                            Register
                        </button>
                        <p class="mt-3 text-light">Go Back To
                            <a href="{{ route('home.index') }}" class="text-primary">Home</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
