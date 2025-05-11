@extends('layouts.admin')

@section('title', 'Contacts')

@section('content')
    <div class="toolbar d-flex justify-content-between align-items-center mb-5">
        <h1 class="text-gray-900 fw-bold fs-3">Contacts</h1>

        <button class="btn btn-primary" id="btnCreate">
            <i class="ki-duotone ki-plus fs-2"></i> Yeni Kişi
        </button>
    </div>

    <div id="contactTable"></div>

    {{-- Create modal --}}
    @include('contacts.modal.create')

    {{-- Edit modal HTML’si AJAX ile buraya enjekte ediliyor --}}
    <div id="editModalContent"></div>

    {{-- Activities modal --}}
    @include('activities.modal.create', [
        'subject_type' => 'Contact',
        'subject_id' => 0,
    ])
@endsection

@push('scripts')
    <script>
        (function($) {
            /* ---------- ROUTES ---------- */
            const routes = {
                list: "{{ route('contacts.table') }}",
                store: "{{ route('contacts.store') }}",
                base: "{{ url('crm/contacts') }}", // /crm/contacts/{id}
                actIndex: (type, id) => `/crm/activities/${type}/${id}`,
                actStore: "{{ route('activities.store') }}"
            };

            /* ---------- CONTACTS TABLO ---------- */
            function loadContacts() {
                $.get(routes.list, html => {
                    $('#contactTable').html(html);
                });
            }

            /* ---------- CREATE ---------- */
            function showCreateModal() {
                $('#createModal').modal('show');
            }

            function createContact(e) {
                e.preventDefault();
                $.post(routes.store, $('#createForm').serialize())
                    .done(() => {
                        $('#createModal').modal('hide');
                        loadContacts();
                    });
            }

            /* ---------- EDIT ---------- */
            function showEditModal() {
                const id = $(this).data('id');
                $.get(`${routes.base}/${id}/edit`, html => {
                    $('#editModalContent').html(html);
                    $('#editModal').modal('show');
                });
            }

            function updateContact(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    url: `${routes.base}/${id}`,
                    type: 'PUT',
                    data: $(this).serialize()
                }).done(() => {
                    $('#editModal').modal('hide');
                    loadContacts();
                });
            }

            /* ---------- DELETE ---------- */
            function deleteContact() {
                const id = $(this).data('id');
                Swal.fire({
                    text: 'Silinsin mi?',
                    icon: 'warning',
                    showCancelButton: true
                }).then(r => {
                    if (r.isConfirmed) {
                        $.ajax({
                            url: `${routes.base}/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            }
                        }).done(loadContacts);
                    }
                });
            }

            /* ---------- ACTIVITIES MODAL ---------- */
            function showActivityModal() {
                const id = $(this).data('id');
                $('#activity-form').find('input[name="subject_id"]').val(id);
                $('#activity-timeline')
                    .data('type', 'Contact')
                    .data('id', id);
                loadActivities();
                $('#activityModal').modal('show');
            }

            function loadActivities() {
                const type = $('#activity-timeline').data('type');
                const id = $('#activity-timeline').data('id');
                $.get(routes.actIndex(type, id), html => {
                    $('#activity-timeline').html(html);
                });
            }

            function submitActivity(e) {
                e.preventDefault();
                $.post(routes.actStore, $('#activity-form').serialize())
                    .done(() => {
                        $('#activity-form')[0].reset();
                        loadActivities();
                    });
            }

            /* ---------- EVENT BIND ---------- */
            function bindEvents() {
                // Contacts CRUD
                $('#btnCreate').on('click', showCreateModal);
                $('#createForm').on('submit', createContact);
                $(document).on('click', '.btn-edit', showEditModal);
                $(document).on('submit', '#editForm', updateContact);
                $(document).on('click', '.btn-delete', deleteContact);

                // Activities
                $(document).on('click', '.open-activity-modal', showActivityModal);
                $(document).on('submit', '#activity-form', submitActivity);
            }

            /* ---------- INIT ---------- */
            $(document).ready(() => {
                bindEvents();
                loadContacts();
            });
        })(jQuery);
    </script>
@endpush
