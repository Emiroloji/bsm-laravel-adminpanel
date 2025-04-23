<!-- resources/views/layouts/navbar.blade.php -->
<div id="kt_header" class="header bg-black border-0 fixed-top" style="height: 80px; z-index: 1030;">
    <div class="container-fluid d-flex justify-content-between align-items-center h-100 px-3">
        {{-- Sol: Logo + Başlık --}}
        <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('assets/media/logos/default-small.svg') }}" alt="Logo" class="img-fluid"
                style="max-height: 60px;">
            <span class="ms-3 fs-2 fw-bold text-white m-0">Admin Panel</span>
        </a>

        {{-- Sağ: Mobil menu butonu + Search + Profile --}}
        <div class="d-flex align-items-center">
            <!-- Mobilde görünür: sidebar toggle -->
            <button class="btn btn-link p-0 border-0 text-white d-lg-none me-3" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#kt_aside_offcanvas" aria-controls="kt_aside_offcanvas">
                <i class="ki-duotone ki-list fs-2"></i>
            </button>

            {{-- Desktop only: Search --}}
            <div class="me-3 d-none d-lg-block" style="width: 250px;">
                <input type="text" class="form-control border-0 rounded-pill" placeholder="Search..."
                    style="height: 40px;">
            </div>

            {{-- Profil --}}
            <div class="dropdown">
                <a href="#" class="btn btn-link d-flex align-items-center p-0 border-0 text-white"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" class="rounded-circle" width="36"
                        height="36" alt="User">
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
