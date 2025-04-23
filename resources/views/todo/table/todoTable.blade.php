<!-- resources/views/todo/table/todoTable.blade.php -->
<table class="table table-hover align-middle table-row-bordered gy-4">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>#</th>
            <th>Başlık</th>
            <th>Açıklama</th>
            <th>Durum</th>
            <th class="text-end">İşlemler</th>
        </tr>
    </thead>
    <tbody>
        @forelse($todos as $todo)
            <tr>
                <td>{{ $todo->id }}</td>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->description }}</td>
                <td>
                    <span class="badge {{ $todo->is_completed ? 'badge-light-success' : 'badge-light-warning' }}">
                        {{ $todo->is_completed ? 'Tamamlandı' : 'Bekliyor' }}
                    </span>
                </td>
                <td class="text-end">
                    <button type="button" class="btn btn-warning btn-sm edit-btn" data-id="{{ $todo->id }}">
                        <i class="fa fa-edit"></i> Güncelle
                    </button>
                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $todo->id }}">
                        <i class="fa fa-trash"></i> Sil
                    </button>
                    <form id="delete-form-{{ $todo->id }}" action="{{ route('todo.destroy', $todo->id) }}"
                        method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Henüz todo eklenmemiş.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<script>
    if (typeof attachTableEvents === 'function') {
        attachTableEvents();
    } else {
        console.warn("attachTableEvents fonksiyonu bulunamadı.");
    }
</script>
