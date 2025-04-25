<div class="container-fluid">
    <div class="card card-flush mt-3 mt-xl-6">
        <div class="card-header mt-5 p-5">
            <div class="card-title flex-column mb-1">
                <h3 class="fw-bold fs-1 mb-3 ">
                    Yapılacaklar Listesi
                </h3>

            </div>

            <div class="d-flex align-items-center flex-wrap gap-5">


                <div class="d-flex align-items-center position-relative">
                    <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-5"></i>
                    <input type="text" id="kt_filter_search" class="form-control form-control-lg w-250px ps-12 py-3"
                        placeholder="Ara...">
                </div>

                <div class="d-flex align-items-center" data-kt-daterangepicker="true">
                    <input type="text" id="kt_filter_date" class="form-control form-control-lg w-250px py-3"
                        placeholder="Tarih Aralığı Seçin" autocomplete="off" />
                </div>

                <div class="d-flex gap-4">
                    <button onclick="exportToExcel()" class="btn btn-success px-5 py-3 fs-5">Excel İndir</button>
                    <button onclick="exportToPDF()" class="btn btn-danger px-5 py-3 fs-5">PDF İndir</button>
                    <button onclick="printTable()" class="btn btn-secondary px-5 py-3 fs-5">Yazdır</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div id="todoTable" class="table-responsive"></div>
        </div>
    </div>
</div>


<script>
    let searchQuery = '';
    let dateStart = '';
    let dateEnd = '';

    $(document).ready(function() {
        loadTodoTable();

        // 🔍 Search
        $(document).on('keyup', '#kt_filter_search', function() {
            searchQuery = $(this).val();
            loadTodoTable();
        });

        // 📅 Date Range (Metronic tarzı)
        $('[data-kt-daterangepicker="true"]').daterangepicker({
            autoUpdateInput: false,
            showCustomRangeLabel: true,
            alwaysShowCalendars: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY',
                cancelLabel: 'Temizle',
                applyLabel: 'Uygula',
                daysOfWeek: ['Pz', 'Pt', 'Sa', 'Ça', 'Pe', 'Cu', 'Ct'],
                monthNames: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran',
                    'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'
                ],
                firstDay: 1
            },
            ranges: {
                'Bugün': [moment(), moment()],
                'Dün': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Son 7 Gün': [moment().subtract(6, 'days'), moment()],
                'Son 30 Gün': [moment().subtract(29, 'days'), moment()],
                'Bu Ay': [moment().startOf('month'), moment().endOf('month')],
                'Geçen Ay': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        });
        $('[data-kt-daterangepicker="true"]').on('apply.daterangepicker', function(ev, picker) {
            let input = $(this).find('input');
            input.val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                'DD/MM/YYYY'));

            // Filtreleme için backend formatı
            dateStart = picker.startDate.format('YYYY-MM-DD');
            dateEnd = picker.endDate.format('YYYY-MM-DD');

            loadTodoTable();
        });

        $('[data-kt-daterangepicker="true"]').on('cancel.daterangepicker', function() {
            let input = $(this).find('input');
            input.val('');
            dateStart = '';
            dateEnd = '';
            loadTodoTable();
        });
    });

    function loadTodoTable() {
        $.ajax({
            url: '{{ route('todo.table') }}',
            type: 'GET',
            data: {
                search: searchQuery,
                date_start: dateStart,
                date_end: dateEnd
            },
            success: function(data) {
                $('#todoTable').html(data);
            },
            error: function(xhr) {
                console.error('Todo tablosu yüklenirken hata:', xhr.responseText);
            }
        });
    }
</script>
