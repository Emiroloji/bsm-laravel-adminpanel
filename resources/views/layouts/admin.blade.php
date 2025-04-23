<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'BSM Admin')</title>

    <!-- Metronic Global Styles -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">

            {{-- Sidebar --}}
            @include('layouts.partials.sidebar')

            <!-- Main Wrapper -->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                {{-- Navbar --}}
                @include('layouts.partials.navbar')

                <!-- Content -->
                <main
                    style="
                    padding-top: 80px;       /* Navbar altı */
                    padding-left: 280px;     /* Sidebar sağı */
                    padding-right: 24px;
                    padding-bottom: 24px;    /* Ana alt boşluk */
                    min-height: calc(100vh - 80px);
                  ">
                    <div
                        style="
                        margin-top: 16px;
                        margin-left: 16px;
                        margin-bottom: 16px;    /* Alttaki boşluk */
                        border-radius: 12px;
                        padding: 24px;
                      ">
                        @yield('content')
                    </div>
                </main>

            </div>
        </div>
    </div>

    <!-- Metronic Scripts -->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
