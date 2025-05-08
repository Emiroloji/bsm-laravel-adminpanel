<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    {{-- Metronic global CSS (Bootstrap dâhil) --}}
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet">

    {{-- Proje dosyaları (Vite) --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

{{-- Body sınıfını oturum durumuna göre ayarla --}}

<body id="kt_body" class="@guest flex-column @else app-default sidebar-enabled @endguest">

    {{-- ==== NAVBAR + (ileride) SIDEBAR  sadece oturum AÇIKKEN ==== --}}
    @auth
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Sol Menü -->
                    <ul class="navbar-nav me-auto">
                        {{-- ör. <li class="nav-item"><a href="#" class="nav-link">Dashboard</a></li> --}}
                    </ul>

                    <!-- Sağ Menü -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{-- İleride sidebar eklersen @include('partials.sidebar') burada çağırabilirsin --}}
    @endauth
    {{-- ==== /NAVBAR ==== --}}

    {{-- ====== İÇERİK ALANI ====== --}}
    <main class="@auth app-wrapper flex-column-fluid @else d-flex flex-column flex-root @endauth py-4">
        @yield('content')
    </main>

    {{-- Metronic JS --}}
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

</body>

</html>
