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



    <!-- Excel için SheetJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <!-- PDF için jsPDF + autotable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

    <!-- CSRF Setup -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @stack('scripts')

    <script>
        window.exportToExcel = function() {
            const table = document.querySelector('#todoTable table');
            if (!table) return alert('Tablo bulunamadı!');
            const wb = XLSX.utils.table_to_book(table, {
                sheet: "TodoListesi"
            });
            XLSX.writeFile(wb, 'todo_listesi.xlsx');
        };

        window.exportToPDF = function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();
            const table = document.querySelector('#todoTable table');
            if (!table) return alert('Tablo bulunamadı!');
            doc.autoTable({
                html: table
            });
            doc.save('todo_listesi.pdf');
        };

        window.printTable = function() {
            const tableHTML = document.querySelector('#todoTable').innerHTML;
            if (!tableHTML) return alert('Tablo bulunamadı!');

            const printWindow = window.open('', '', 'width=900,height=700');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Yazdır</title>
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                        <style>
                            body { padding: 20px; font-family: sans-serif; }
                            table { width: 100%; border-collapse: collapse; }
                            th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
                        </style>
                    </head>
                    <body>
                        ${tableHTML}
                        <script>
                            window.onload = function() {
                                window.print();
                                window.onafterprint = function() { window.close(); };
                            };
                        <\/script>
                    </body>
                </html>
            `);
            printWindow.document.close();
        };
    </script>


</body>

</html>
