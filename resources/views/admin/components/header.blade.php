<div class="header bg-dark px-3 py-3 text-light rounded mb-4 mt-2">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="bars" onclick="toggleSideBar()" data-status="hidden">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="d-flex align-items-center">
                <div class="bars mx-3 d-none d-lg-flex">
                    <i class="fa-solid fa-message"></i>
                </div>
                <div class="bars mx-3 d-none d-lg-flex ">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <div class="img-container mx-3 cursor-pointer">
                    <div class="online-dot"></div>
                    <img src="/img/user.png" style="width: 45px;" class="rounded-circle" />
                </div>
                <p class="m-0 font-bold d-none d-lg-block">{{ auth()->user()->name }}</p>
                <form action="{{ route('auth.logout') }}">
                    <button type="submit" class="btn bars ms-1 ms-md-4 bg-primary text-light">
                        <i class="fa-solid fa-power-off"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>