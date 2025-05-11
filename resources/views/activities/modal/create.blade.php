<div class="modal fade" id="activityModal" tabindex="-1" aria-labelledby="activityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="activityModalLabel">Aktivite Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                {{-- Activity Form --}}
                <form id="activity-form" class="mb-3 d-flex gap-2">
                    @csrf
                    <input type="hidden" name="subject_type" value="{{ $subject_type }}">
                    <input type="hidden" name="subject_id" value="{{ $subject_id }}">

                    <select name="type" class="form-select w-auto" required>
                        <option value="call">Arama</option>
                        <option value="email">E-posta</option>
                        <option value="meeting">Toplantı</option>
                    </select>

                    <input type="text" name="comment" class="form-control" placeholder="Comment…">

                    <input type="datetime-local" name="due_at" class="form-control w-auto">

                    <button type="submit" class="btn btn-primary">Ekle</button>
                </form>

                {{-- Activity List --}}
                <div id="activity-timeline">
                    {{-- AJAX ile yüklenecek --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
