<!-- resources/views/todo/modal/edit.blade.php -->
<div class="modal fade" id="editTodoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('todo.update', $todo->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Todo Güncelle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Başlık</label>
                        <input type="text" name="title" class="form-control" value="{{ $todo->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Açıklama</label>
                        <textarea name="description" class="form-control" rows="3">{{ $todo->description }}</textarea>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_completed" id="is_completed"
                            {{ $todo->is_completed ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_completed">Tamamlandı</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Güncelle</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        document.querySelector('#editTodoModal form')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const action = form.getAttribute('action');
            const formData = new FormData(form);

            fetch(action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-HTTP-Method-Override': 'PATCH'
                    },
                    body: formData
                })
                .then(res => {
                    if (res.ok) {
                        bootstrap.Modal.getInstance(document.getElementById('editTodoModal')).hide();
                        location.reload();
                    } else {
                        alert("Güncelleme başarısız oldu.");
                    }
                });
        });
    </script>
@endpush
