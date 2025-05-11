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

    {{-- Edit modal for contacts --}}
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
            /* ---------- CONTACTS CRUD (mevcut kod) ---------- */
            const contactRoutes = {
                list: "{{ route('contacts.table') }}",
                store: "{{ route('contacts.store') }}",
                base: "{{ url('crm/contacts') }}",
            };

            function loadContacts() {
                $.get(contactRoutes.list, html => $('#contactTable').html(html));
            }
            $('#btnCreate').on('click', () => $('#createModal').modal('show'));
            $(document).on('submit', '#createForm', function(e) {
                e.preventDefault();
                $.post(contactRoutes.store, $(this).serialize())
                    .done(() => {
                        $('#createModal').modal('hide');
                        loadContacts();
                    });
            });
            $(document).on('click', '.btn-edit', function() {
                const id = $(this).data('id');
                $.get(`${contactRoutes.base}/${id}/edit`, html => {
                    $('#editModalContent').html(html);
                    $('#editModal').modal('show');
                });
            });
            $(document).on('submit', '#editForm', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    url: `${contactRoutes.base}/${id}`,
                    type: 'PUT',
                    data: $(this).serialize()
                }).done(() => {
                    $('#editModal').modal('hide');
                    loadContacts();
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
                            url: `${contactRoutes.base}/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            }
                        }).done(loadContacts);
                    }
                });
            });

            /* ---------- ACTIVITIES CRUD ---------- */
            const actBaseUrl = "{{ url('crm/activities') }}";
            const actStoreUrl = "{{ route('activities.store') }}";

            // Modal açılınca subject_id'yi set et
            $(document).on('click', '.open-activity-modal', function() {
                const contactId = $(this).data('id');
                $('#activity-form')
                    .find('input[name="subject_id"]').val(contactId).end()
                    .trigger('reset')
                    .find('button[type="submit"]').text('Add');
                $('#activity-timeline')
                    .data('type', 'Contact')
                    .data('id', contactId)
                    .html(''); // temizle
                $('#activityModal').modal('show');
                loadActivities();
            });

            // Listeyi yükleyen fonksiyon
            function loadActivities() {
                const type = $('#activity-timeline').data('type');
                const id = $('#activity-timeline').data('id');
                // doğru URL: /crm/activities/Contact/3
                $.get(`${actBaseUrl}/${type}/${id}`, html => {
                    $('#activity-timeline').html(html);
                });
            }

            // Create vs Update ayrımı
            $(document).on('submit', '#activity-form', function(e) {
                e.preventDefault();
                const form = $(this);
                const activityId = form.find('input[name="activity_id"]').val();
                const data = form.serialize();

                if (activityId) {
                    // Güncelle
                    $.ajax({
                        url: `${actBaseUrl}/${activityId}`,
                        type: 'PATCH',
                        data: data
                    }).done(() => {
                        form.trigger('reset')
                            .find('button[type="submit"]').text('Add')
                            .end().find('input[name="activity_id"]').remove();
                        loadActivities();
                    });
                } else {
                    // Yeni ekle
                    $.post(actStoreUrl, data).done(() => {
                        form.trigger('reset');
                        loadActivities();
                    });
                }
            });

            // Edit butonuyla formu doldur
            $(document).on('click', '.open-activity-edit-modal', function() {
                const btn = $(this);
                const form = $('#activity-form');
                // gizli field
                form.find('input[name="activity_id"]').remove();
                form.append(`<input type="hidden" name="activity_id" value="${btn.data('id')}">`);
                // değerleri doldur
                form.find('select[name="type"]').val(btn.data('type'));
                form.find('input[name="comment"]').val(btn.data('comment'));
                form.find('input[name="due_at"]').val(btn.data('due_at'));
                form.find('button[type="submit"]').text('Update');
                $('#activityModal').modal('show');
            });

            // Sil butonu
            $(document).on('click', '.activity-delete-btn', function() {
                const id = $(this).data('id');
                Swal.fire({
                    text: 'Bu aktivite silinsin mi?',
                    icon: 'warning',
                    showCancelButton: true
                }).then(r => {
                    if (r.isConfirmed) {
                        $.ajax({
                            url: `${actBaseUrl}/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            }
                        }).done(loadActivities);
                    }
                });
            });

            // Başlangıçta yükle
            $(document).ready(() => {
                loadContacts();
            });

        })(jQuery);
    </script>
@endpush
