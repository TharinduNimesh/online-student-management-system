@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('section')
    <div class="row">
        <div class="summary-box col-12 col-md-6 col-xl-3 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-graduation-cap text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Students</span>
                    <span class="text-primary font-bold fs-4 p-0">2300</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-md-6 col-xl-3 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-chalkboard-user text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Teachers</span>
                    <span class="text-primary font-bold fs-4 p-0">2300</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-md-6 col-xl-3 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-user-tie text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Officers</span>
                    <span class="text-primary font-bold fs-4 p-0">2300</span>
                </div>
            </div>
        </div>
        <div class="summary-box col-12 col-md-6 col-xl-3 px-3 py-2 bg-dark">
            <div class="row h-100">
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-user-secret text-light fs-2"></i>
                </div>
                <div class="col-7 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-secondary p-0 fs-6 font-bold">Admins</span>
                    <span class="text-primary font-bold fs-4 p-0">2300</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
    </div>
@endsection