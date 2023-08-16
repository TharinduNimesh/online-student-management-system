<div class="bg-dark position-fixed position-lg-static nav-bar pt-5 pt-lg-2 d-none" id="sidebar">
    <div class="d-flex w-100 flex-column align-items-center mb-4">
        <h1 class="text-light mt-5 mt-md-0">School<span class="text-primary">Plus</span></h1>
        <img src="/img/logo.png" width="60%" />
    </div>
    <div class="d-flex flex-column align-items-center w-100">
        <a class="nav-item active" id="home" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-home me-3"></i>
            <span class="nav-text">Home</span>
        </a>
        <a class="nav-item" id="students" href="{{ route('admin.students') }}">
            <i class="fa-solid fa-graduation-cap me-3"></i>
            <span class="nav-text">Manage Students</span>
        </a>
        <a class="nav-item" id="teachers" href="{{ route('admin.teachers') }}">
            <i class="fa-solid fa-chalkboard-user me-3"></i>
            <span class="nav-text">Manage Teachers</span>
        </a>
        <a class="nav-item" id="officers" href="{{ route('admin.officers') }}">
            <i class="fa-solid fa-user-tie me-3"></i>
            <span class="nav-text">Manage Staffs</span>
        </a>
        <a class="nav-item" href="#">
            <i class="fas fa-home me-3"></i>
            <span class="nav-text">Home</span>
        </a>
        <a class="nav-item" href="#">
            <i class="fas fa-home me-3"></i>
            <span class="nav-text">Home</span>
        </a>
    </div>
</div>