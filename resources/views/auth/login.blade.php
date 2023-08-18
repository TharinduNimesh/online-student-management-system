@extends('base')

@section('title', 'Login')

@section('content')
    <div class="login container-fluid">
        <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <div class="layer"></div>
            <div class="box col-11 col-md-8 col-lg-6 col-xl-4 bg-dark rounded p-5 position-relative">
                <div class="row">
                    <div class="col-12 text-center mb-3">
                        <img src="/img/logo.png" width="100px">
                        <h1 class="text-light">School<span class="text-primary">Plus</span></h1>
                        <p class="text-light">Empowering Education System While Pandemic</p>
                    </div>
                    <div class="alert alert-danger text-center d-none" id="error-message">

                    </div>
                    <div class="col-12">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-primary" id="basic-addon1">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="text" id="email" class="form-control" placeholder="Email Address" aria-label="Username"
                                aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-primary" id="basic-addon1">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="password" placeholder="Password" aria-label="Username"
                                aria-describedby="basic-addon1">
                        </div>
                        <a href="#" class="text-primary">Forget Password ?</a>
                    </div>
                    <div class="col-12 d-flex flex-column align-items-center mt-3">
                        @php $url = route('auth.login'); @endphp
                        <button class="btn btn-danger px-5" onclick="login('{{ $url }}');">
                            Sign In
                        </button>
                        <p class="mt-3 text-light">Go Back To 
                            <a href="{{ route('home.index') }}" class="text-primary">Home</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
