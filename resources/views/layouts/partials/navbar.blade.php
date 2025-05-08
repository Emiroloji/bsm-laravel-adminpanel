{{-- resources/views/layouts/navbar.blade.php --}}
@auth
    <div id="kt_header" class="header bg-black border-0 fixed-top" style="height:80px;z-index:1030;">
        <div class="container-fluid d-flex justify-content-between align-items-center h-100 px-3">

            <a href="{{ url('/dashboard') }}" class="d-flex align-items-center text-decoration-none">
                <img src="{{ asset('assets/media/logos/default-small.svg') }}" alt="Logo" style="max-height:60px;">
                <span class="ms-3 fs-2 fw-bold text-white">Admin Panel</span>
            </a>

            <div class="d-flex align-items-center">

                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" class="rounded-circle" width="36"
                            height="36">
                        <span class="ms-2 d-none d-lg-inline">{{ Auth::user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow" data-bs-offset="0,10">
                        <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ url('/settings') }}">Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Çıkış Yap
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>


    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@endauth
