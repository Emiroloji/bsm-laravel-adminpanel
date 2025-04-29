@extends('layouts.admin')

@section('title', 'Deals')

@section('content')
    <div class="toolbar d-flex justify-content-between align-items-center mb-5">
        <h1 class="text-gray-900 fw-bold fs-3">Deals</h1>
        <button class="btn btn-primary" id="btnCreate">
            <i class="ki-duotone ki-plus fs-2"></i> Yeni Fırsat
        </button>
    </div>

    <div id="dealTable"></div>

    @include('deals.modal.create')
    <div id="editModalContent"></div>
    @include('deals.modal.view-proposal')
@endsection

@push('scripts')
    <script>
        (function($) {
            const R = {
                list: "{{ route('deals.table') }}",
                store: "{{ route('deals.store') }}",
                base: "{{ url('crm/deals') }}"
            };

            const loadDeals = () => {
                $.get(R.list, html => {
                    $('#dealTable').html(html);
                });
            };

            $('#btnCreate').on('click', () => $('#createModal').modal('show'));
            $(document).on('submit', '#createForm', function(e) {
                e.preventDefault();
                $.post(R.store, $(this).serialize())
                    .done(() => {
                        $('#createModal').modal('hide');
                        loadDeals();
                    });
            });

            $(document).on('click', '.btn-edit', function() {
                const id = $(this).data('id');
                $.get(`${R.base}/${id}/edit`, html => {
                    $('#editModalContent').html(html);
                    $('#editModal').modal('show');
                });
            });
            $(document).on('submit', '#editForm', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    url: `${R.base}/${id}`,
                    type: 'PUT',
                    data: $(this).serialize()
                }).done(() => {
                    $('#editModal').modal('hide');
                    loadDeals();
                });
            });

            /* ---------- DELETE ---------- */
            $(document).on('click', '.btn-delete', function() {
                const id = $(this).data('id');
                Swal.fire({
                    text: 'Silinsin mi?',
                    icon: 'warning',
                    showCancelButton: true
                }).then(r => {
                    if (r.isConfirmed) {
                        $.ajax({
                            url: `${R.base}/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            }
                        }).done(loadDeals);
                    }
                });
            });

            /* ---------- VIEW PROPOSAL ---------- */
            $(document).on('click', '.btn-view-proposal', function() {
                const id = $(this).data('id');
                const url = `{{ url('crm/deals') }}/${id}/view-proposal`;
                $('#proposalFrame').attr('src', url);
                $('#viewProposalModal').modal('show');
            });

            /* ---------- INIT ---------- */
            $(document).ready(loadDeals);
        })(jQuery);
    </script>
@endpush
