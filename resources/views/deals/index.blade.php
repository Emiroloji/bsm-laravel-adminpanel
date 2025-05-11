@extends('layouts.admin')

@section('title', 'Deals')

@section('content')
    <div class="toolbar d-flex justify-content-between align-items-center mb-5">
        <h1 class="text-gray-900 fw-bold fs-3">Fırsatlar</h1>
        <button class="btn btn-primary" id="btnCreate">
            <i class="ki-duotone ki-plus fs-2"></i> Yeni Fırsat
        </button>
    </div>

    <div id="dealTable"></div>

    {{-- Create / Edit / View-Proposal Modalları --}}
    @include('deals.modal.create')
    <div id="editModalContent"></div>
    @include('deals.modal.view-proposal')

    {{-- Activities Modal --}}
    @include('activities.modal.create', [
        'subject_type' => 'Deal',
        'subject_id' => 0,
    ])
@endsection

@push('scripts')
    <script>
        (function($) {
            /* ---------- DEALS CRUD ---------- */
            const R = {
                list: "{{ route('deals.table') }}",
                store: "{{ route('deals.store') }}",
                base: "{{ url('crm/deals') }}"
            };

            function loadDeals() {
                $.get(R.list, html => $('#dealTable').html(html));
            }

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

            $(document).on('click', '.btn-view-proposal', function() {
                const id = $(this).data('id');
                const url = `{{ url('crm/deals') }}/${id}/view-proposal`;
                $('#proposalFrame').attr('src', url);
                $('#viewProposalModal').modal('show');
            });

            /* ---------- ACTIVITIES CRUD ---------- */
            const actBase = "{{ url('crm/activities') }}";
            const actStore = "{{ route('activities.store') }}";

            // Modal aç
            $(document).on('click', '.open-activity-modal', function() {
                const dealId = $(this).data('id');
                $('#activity-form')
                    .find('input[name="subject_type"]').val('Deal').end()
                    .find('input[name="subject_id"]').val(dealId).end()
                    .trigger('reset')
                    .find('button[type="submit"]').text('Add');
                $('#activity-timeline')
                    .data('type', 'Deal')
                    .data('id', dealId)
                    .html('');
                $('#activityModal').modal('show');
                loadActivities();
            });

            function loadActivities() {
                const type = $('#activity-timeline').data('type');
                const id = $('#activity-timeline').data('id');
                $.get(`${actBase}/${type}/${id}`, html => {
                    $('#activity-timeline').html(html);
                });
            }

            $(document).on('submit', '#activity-form', function(e) {
                e.preventDefault();
                const form = $(this);
                const aid = form.find('input[name="activity_id"]').val();
                const data = form.serialize();
                if (aid) {
                    $.ajax({
                        url: `${actBase}/${aid}`,
                        type: 'PATCH',
                        data: data
                    }).done(() => {
                        form.trigger('reset')
                            .find('button[type="submit"]').text('Add')
                            .end().find('input[name="activity_id"]').remove();
                        loadActivities();
                    });
                } else {
                    $.post(actStore, data).done(() => {
                        form.trigger('reset');
                        loadActivities();
                    });
                }
            });

            $(document).on('click', '.open-activity-edit-modal', function() {
                const btn = $(this);
                const form = $('#activity-form');
                form.find('input[name="activity_id"]').remove();
                form.append(`<input type="hidden" name="activity_id" value="${btn.data('id')}">`);
                form.find('select[name="type"]').val(btn.data('type'));
                form.find('input[name="comment"]').val(btn.data('comment'));
                form.find('input[name="due_at"]').val(btn.data('due_at'));
                form.find('button[type="submit"]').text('Update');
                $('#activityModal').modal('show');
            });

            $(document).on('click', '.activity-delete-btn', function() {
                const id = $(this).data('id');
                Swal.fire({
                    text: 'Bu aktivite silinsin mi?',
                    icon: 'warning',
                    showCancelButton: true
                }).then(r => {
                    if (r.isConfirmed) {
                        $.ajax({
                            url: `${actBase}/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            }
                        }).done(loadActivities);
                    }
                });
            });

            $(document).ready(loadDeals);
        })(jQuery);
    </script>
@endpush
