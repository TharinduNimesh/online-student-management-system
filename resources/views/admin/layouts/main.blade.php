@extends('base')


@section('content')
    {{-- Content Start --}}
    <div class="user container-fluid bg-black p-0 d-flex overflow-hidden">
        {{-- Navbar Start --}}
        @include('admin.components.navbar')
        {{-- Navbar End --}}

        <div class="container-fluid px-3 bg-black vh-100 position-relative overflow-hidden">
            <div class="layer d-none" id="layer" onclick="toggleSideBar()"></div>

            {{-- Header Start --}}
            @include('admin.components.header')
            {{-- Header End --}}

            {{-- Main Start --}}
            <div class="container-fluid px-2 main overflow-y-scroll">
                @yield('section')

                <div class="footer bg-dark px-4 py-2">
                    <p class="text-light">&copy; Copyright By <a href="https://github.com/TharinduNimesh" class="font-bold cursor-pointer text-primary">Tharindu Nimesh</a>. <span class="d-none d-md-inline-block">All Right Reserved.</span></p>
                    <p class="text-light">Designed & Developed By <a href="https://github.com/TharinduNimesh" class="font-bold cursor-pointer text-primary">Tharindu Nimesh</a>.</p>
                </div>
            </div>
            {{-- Main End --}}
        </div>
    </div>
    {{-- Content end --}}
@endsection
