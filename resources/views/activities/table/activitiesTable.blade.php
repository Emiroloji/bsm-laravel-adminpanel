{{-- resources/views/activities/table/activitiesTable.blade.php --}}
@if ($activities->isEmpty())
    <div class="text-center text-muted py-4">Herhangi bir aktivite yok.</div>
@else
    <ul class="list-group">
        @foreach ($activities as $activity)
            <li class="list-group-item d-flex justify-content-between align-items-start align-items-center">
                <div>
                    {{-- Zaman rozeti --}}
                    <span class="badge bg-secondary me-2">
                        {{ $activity->created_at->format('d.m.Y H:i') }}
                    </span>

                    {{-- Tip ve yorum --}}
                    <strong>{{ ucfirst($activity->type) }}:</strong>
                    {{ $activity->comment }}

                    {{-- Due tarihi --}}
                    @if ($activity->due_at)
                        <div><small>Due: {{ $activity->due_at->format('d.m.Y H:i') }}</small></div>
                    @endif
                </div>

                {{-- Düzenle & Sil butonları --}}
                <div class="d-flex gap-2">
                    <button class="btn btn-icon btn-sm btn-light-warning open-activity-edit-modal"
                        data-id="{{ $activity->id }}" data-type="{{ $activity->type }}"
                        data-comment="{{ $activity->comment }}"
                        data-due_at="{{ $activity->due_at?->format('Y-m-d\TH:i') }}">
                        <i class="ki-duotone ki-pencil fs-2"></i>
                    </button>

                    <button class="btn btn-icon btn-sm btn-light-danger activity-delete-btn"
                        data-id="{{ $activity->id }}">
                        <i class="ki-duotone ki-trash fs-2"></i>
                    </button>
                </div>
            </li>
        @endforeach
    </ul>
@endif

@push('scripts')
    <script>
        (function($) {
            const baseUrl = "{{ url('crm/activities') }}";
            const actStore = "{{ route('activities.store') }}";

            // Edit modal açma
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

            // Create vs Update ayrımı
            $(document).on('submit', '#activity-form', function(e) {
                e.preventDefault();
                const form = $(this);
                const activityId = form.find('input[name="activity_id"]').val();
                const data = form.serialize();
                if (activityId) {
                    $.ajax({
                        url: `${baseUrl}/${activityId}`,
                        type: 'PATCH',
                        data: data
                    }).done(() => {
                        form.trigger('reset').find('button[type="submit"]').text('Add');
                        form.find('input[name="activity_id"]').remove();
                        loadActivities();
                    });
                } else {
                    $.post(actStore, data).done(() => {
                        form.trigger('reset');
                        loadActivities();
                    });
                }
            });

            // Silme işlemi
            $(document).on('click', '.activity-delete-btn', function() {
                const id = $(this).data('id');
                Swal.fire({
                    text: 'Bu aktivite silinsin mi?',
                    icon: 'warning',
                    showCancelButton: true
                }).then(r => {
                    if (r.isConfirmed) {
                        $.ajax({
                            url: `${baseUrl}/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            }
                        }).done(loadActivities);
                    }
                });
            });

            // Listeyi tekrar yüklüyor
            function loadActivities() {
                const type = $('#activity-timeline').data('type');
                const id = $('#activity-timeline').data('id');
                $.get(`${baseUrl}/${type}/${id}`, html => {
                    $('#activity-timeline').html(html);
                });
            }
        })(jQuery);
    </script>
@endpush
