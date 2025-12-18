<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
    <div class="offcanvas-header pb-0">
        <h4 class="px-4" id="sidebarOffcanvasLabel" style="color:#1d4ed8; font-weight:700;">
            <span class="nav-icon me-2">
                <!-- Logo image -->
                <img src="{{ asset('assets/images/logo.png') }}" alt="Resilio Logo"
                    style="width: 30px; height: 30px; object-fit: contain; border-radius: 4px;">
            </span>
            RESILIO
        </h4>
        <button type="button" class="btn-close text-reset me-2" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column mb-auto">
    <li class="nav-item">
        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.dashboard.page') ? 'active' : '' }}"
           href="{{ route('admin.dashboard.page') }}">
            <span class="nav-icon"><i class="fa-solid fa-table-cells-large"></i></span>
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.announcement.*') ? 'active' : '' }}"
           href="{{ route('admin.announcement.page') }}">
            <span class="nav-icon"><i class="fa-solid fa-bell"></i></span>
            Announcement
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
           href="{{ route('admin.reports.page') }}">
            <span class="nav-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
            Reports
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.evacuation.*') ? 'active' : '' }}"
           href="{{ route('admin.evacuation.page') }}">
            <span class="nav-icon"><i class="fa-solid fa-location-arrow"></i></span>
            Evacuation Site
        </a>
    </li>
</ul>

    </div>
</div>

<!-- Desktop Sidebar -->
<div class="sidebar-desktop">
    <h4 class="px-4 mb-4" style="color:#1d4ed8; font-weight:700;">
        <span class="nav-icon me-2">
            <!-- Logo image -->
            <img src="{{ asset('assets/images/logo.png') }}" alt="Resilio Logo"
                style="width: 30px; height: 30px; object-fit: contain; border-radius: 4px;">
        </span>
        RESILIO
    </h4>

    <ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.dashboard.page') ? 'active' : '' }}"
           href="{{ route('admin.dashboard.page') }}">
            <span class="nav-icon"><i class="fa-solid fa-table-cells-large"></i></span>
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.announcement.*') ? 'active' : '' }}"
           href="{{ route('admin.announcement.page') }}">
            <span class="nav-icon"><i class="fa-solid fa-bell"></i></span>
            Announcement
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
           href="{{ route('admin.reports.page') }}">
            <span class="nav-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
            Reports
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.evacuation.*') ? 'active' : '' }}"
           href="{{ route('admin.evacuation.page') }}">
            <span class="nav-icon"><i class="fa-solid fa-location-arrow"></i></span>
            Evacuation Site
        </a>
    </li>
</ul>

</div>

<!-- Top Navbar -->
<nav class="top-navbar sticky-top p-3">
    <div class="d-flex justify-content-between align-items-center">
        <button class="navbar-toggler d-lg-none p-0 border-0" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars fa-lg"></i>
        </button>

        <h5 class="mb-0 text-muted d-none d-lg-block"></h5>

        <div class="dropdown">
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                title="User Profile">
                <i class="fa-regular fa-user profile-dropdown-icon"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <h6 class="dropdown-header">Welcome, User!</h6>
                </li>
                <li><a class="dropdown-item" href="#">
                        <i class="fa-solid fa-id-badge me-2"></i> Profile
                    </a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fa-solid fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>
