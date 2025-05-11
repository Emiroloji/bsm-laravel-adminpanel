@extends('layouts.admin')

@section('title', 'Companies')

@section('content')
    <div class="toolbar d-flex justify-content-between align-items-center mb-5">
        <h1 class="text-gray-900 fw-bold fs-3">Şirketler</h1>
        <button class="btn btn-primary" id="btnCreate">
            <i class="ki-duotone ki-plus fs-2"></i> Yeni Şirket
        </button>
    </div>

    <div id="companyTable"></div>

    {{-- Modallar --}}
    @include('companies.modal.create')
    <div id="editModalContent"></div>
@endsection


@push('scripts')
    <script>
        (function($) {
            const R = {
                list: "{{ route('companies.table') }}",
                store: "{{ route('companies.store') }}",
                base: "{{ url('crm/companies') }}" // /{id}, /{id}/edit
            };

            /* -------- TABLO -------- */
            const loadCompanies = () => $.get(R.list, h => $('#companyTable').html(h));

            /* -------- CREATE -------- */
            const showCreate = () => $('#createModal').modal('show');
            const create = e => {
                e.preventDefault();
                $.post(R.store, $('#createForm').serialize())
                    .done(() => {
                        $('#createModal').modal('hide');
                        loadCompanies();
                    });
            };

            /* -------- EDIT -------- */
            const showEdit = function() {
                const id = $(this).data('id');
                $.get(`${R.base}/${id}/edit`, html => {
                    $('#editModalContent').html(html);
                    $('#editModal').modal('show');
                });
            };
            const update = e => {
                e.preventDefault();
                const id = $(e.target).data('id');
                $.ajax({
                        url: `${R.base}/${id}`,
                        type: 'PUT',
                        data: $(e.target).serialize()
                    })
                    .done(() => {
                        $('#editModal').modal('hide');
                        loadCompanies();
                    });
            };

            /* -------- DELETE -------- */
            const del = function() {
                const id = $(this).data('id');
                Swal.fire({
                        text: 'Silinsin mi?',
                        icon: 'warning',
                        showCancelButton: true
                    })
                    .then(r => {
                        if (r.isConfirmed) {
                            $.ajax({
                                    url: `${R.base}/${id}`,
                                    type: 'DELETE',
                                    data: {
                                        _token: "{{ csrf_token() }}"
                                    }
                                })
                                .done(loadCompanies);
                        }
                    });
            };

            /* -------- INIT -------- */
            $(document).ready(() => {
                $('#btnCreate').on('click', showCreate);
                $('#createForm').on('submit', create);
                $(document).on('click', '.btn-edit', showEdit);
                $(document).on('submit', '#editForm', update);
                $(document).on('click', '.btn-delete', del);
                loadCompanies();
            });
        })(jQuery);
    </script>
@endpush
