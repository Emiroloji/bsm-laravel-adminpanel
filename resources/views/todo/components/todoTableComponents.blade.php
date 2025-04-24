<div class="container-fluid">
    <div class="card card-flush mt-3 mt-xl-6" style="width: 100%;">
        <div class="card-header mt-5">
            <div class="card-title flex-column">
                <h3 class="fw-bold mb-1">Yapılacaklar listesi</h3>
            </div>

            <div class="d-flex align-items-center gap-2">

                <div class="d-flex justify-content-end gap-2 mb-4">
                    <button onclick="exportToExcel()" class="btn btn-success">Excel İndir</button>
                    <button onclick="exportToPDF()" class="btn btn-danger">PDF İndir</button>
                    <button onclick="printTable()" class="btn btn-secondary">Yazdır</button>
                </div>

                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-3"></i>
                    <input type="text" id="kt_filter_search"
                        class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Ara...">
                </div>

                <div class="d-flex align-items-center my-1" data-kt-daterangepicker="true" style="width: 225px;">
                    <input type="text" id="kt_filter_date" class="form-control form-control-solid form-select-sm"
                        placeholder="Tarih Aralığı Seçin" autocomplete="off" />
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
