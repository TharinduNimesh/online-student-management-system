@extends('base')

@section('title', 'Set Password')

@section('content')
    <div class="login container-fluid">
        <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <div class="layer"></div>
            <div class="box col-11 col-md-8 col-lg-6 col-xl-4 bg-dark rounded p-5 position-relative">
                <form class="row" id="set_password_form">
                    <div class="col-12 text-center mb-3">
                        <img src="/img/logo.png" width="100px">
                        <h1 class="text-light">School<span class="text-primary">Plus</span></h1>
                        <p class="text-light">Welcome, 
                            <span class="text-primary font-bold">{{ $user->name }}</span>
                        </p>
                    </div>
                    <div class="alert alert-danger text-center d-none" id="error-message">

                    </div>

                    <div class="col-12">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-primary" id="basic-addon1">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="text" disabled name="email" class="form-control" value="{{ $user->email }}"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <input type="hidden" name="role" value="{{ $role }}">
                    <input type="hidden" name="name" value="{{ $user->name }}">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="col-12 text-right">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-primary" id="basic-addon1">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                aria-label="Username" aria-describedby="basic-addon1" onkeyup="checkPassword(this)">
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-column align-items-center mt-3">
                        @php $url = route('auth.setPassword'); @endphp
                        <button type="button" class="btn btn-danger px-5" onclick="setPassword('{{ $url }}');">
                            Set Password
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
