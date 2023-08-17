<div class="bg-dark position-fixed position-lg-static nav-bar pt-5 pt-lg-2 nav-bar-lg-show" id="sidebar">
    <div class="d-flex w-100 flex-column align-items-center mb-4">
        <h1 class="text-light mt-5 mt-md-0">School<span class="text-primary">Plus</span></h1>
        <img src="/img/logo.png" width="60%" />
    </div>
    <div class="d-flex flex-column align-items-center w-100">
        <a class="nav-item" id="dashboard" href="{{ route('student.dashboard') }}">
            <i class="fas fa-home me-3"></i>
            <span class="nav-text">Dashboard</span>
        </a>
        <a class="nav-item" id="assignments" href="{{ route('student.assignments') }}">
            <i class="fa-solid fa-clipboard-check me-3"></i>
            <span class="nav-text">Assignments</span>
        </a>
        <a class="nav-item" id="notes" href="{{ route('student.notes') }}">
            <i class="fa-solid fa-clipboard-list me-3"></i>
            <span class="nav-text">Lesson Notes</span>
        </a>
        <a class="nav-item" id="payments" href="{{ route('student.payments') }}">
            <i class="fa-solid fa-credit-card me-3"></i>
            <span class="nav-text">Payments</span>
        </a>
    </div>
</div>
