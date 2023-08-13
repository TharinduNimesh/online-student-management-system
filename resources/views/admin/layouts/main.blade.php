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
            <div class="container-fluid p-0 main overflow-y-scroll">
                @yield('section')

                <div class="footer bg-dark px-4 py-2">
                    <p class="text-light">copy</p>
                </div>
            </div>
            {{-- Main End --}}
        </div>
    </div>
    {{-- Content end --}}
@endsection
