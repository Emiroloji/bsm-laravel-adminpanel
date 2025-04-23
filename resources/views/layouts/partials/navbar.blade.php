<!-- resources/views/layouts/navbar.blade.php -->
<div id="kt_header" class="header bg-white shadow-sm py-3">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="d-flex align-items-center">
            <img src="{{ asset('assets/media/logos/default-small.svg') }}" alt="Logo" class="h-30px">
            <span class="ms-3 fs-4 fw-bold text-dark">Admin Panel</span>
        </a>

        <!-- Navbar Menu -->
        <div class="d-flex align-items-center">
            <!-- Search -->
            <div class="me-4">
                <input type="text" class="form-control" placeholder="Search...">
            </div>

            <!-- Notifications -->
            <a href="#" class="btn btn-icon btn-light me-2">
                <i class="ki-duotone ki-bell fs-2"></i>
            </a>

            <!-- User Dropdown -->
            <div class="dropdown">
                <a href="#" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" class="rounded-circle" width="30"
                        height="30" alt="User">
                    <span class="ms-2">Admin</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ url('/settings') }}">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-danger" href="{{ url('/logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
