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
@endsection


@push('scripts')
    <script>
        (function($) {
            /* ---------- ROUTES ---------- */
            const routes = {
                list: "{{ route('contacts.table') }}",
                store: "{{ route('contacts.store') }}",
                base: "{{ url('crm/contacts') }}" // /{id} , /{id}/edit
            };

            /* ---------- TABLO ---------- */
            function loadContacts() {
                $.get(routes.list, html => $('#contactTable').html(html));
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
                    })
                    .then(r => {
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

            /* ---------- EVENT BIND ---------- */
            function bindEvents() {
                $('#btnCreate').on('click', showCreateModal);
                $('#createForm').on('submit', createContact);
                $(document).on('click', '.btn-edit', showEditModal);
                $(document).on('submit', '#editForm', updateContact);
                $(document).on('click', '.btn-delete', deleteContact);
            }

            /* ---------- INIT ---------- */
            $(document).ready(() => {
                bindEvents();
                loadContacts();
            });
        })(jQuery);
    </script>
@endpush
