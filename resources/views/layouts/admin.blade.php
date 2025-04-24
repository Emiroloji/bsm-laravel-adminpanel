<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF Token Meta -->
    <title>@yield('title', 'BSM Admin')</title>

    <!-- Metronic Global Styles -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker CSS (yeni eklenen) -->
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />

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
                    padding-top: 80px;
                    padding-left: 280px;
                    padding-right: 24px;
                    padding-bottom: 24px;
                    min-height: calc(100vh - 80px);
                  ">
                    <div
                        style="
                        margin-top: 16px;
                        margin-left: 16px;
                        margin-bottom: 16px;
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- moment.js ve daterangepicker -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- CSRF Setup -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
