<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'BSM Admin')</title>

    <!-- Metronic Global Styles -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">

    <!-- Wrapper -->
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">

            {{-- Sidebar --}}
            @include('layouts.partials.sidebar')

            <!-- Main Wrapper -->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                {{-- Navbar --}}
                @include('layouts.partials.navbar')

                <!-- Content -->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Metronic Scripts -->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>

</html>
