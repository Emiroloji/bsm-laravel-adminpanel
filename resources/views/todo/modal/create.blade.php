<!-- SADECE MODAL, EXTENDS YOK -->
<div class="modal fade" id="createTodoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('todo.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Todo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="title" class="form-control mb-3" placeholder="Başlık" required>
                    <textarea name="description" class="form-control" placeholder="Açıklama"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </div>
        </form>
    </div>
</div>
