<table id="todoExportTable" class="table table-rounded table-striped border gy-7 gs-7">
    <thead>
        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
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
                <td>{{ $loop->iteration }}</td>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->description }}</td>
                <td>
                    <input type="checkbox" class="toggle-complete form-check-input" data-id="{{ $todo->id }}"
                        {{ $todo->is_completed ? 'checked' : '' }}>
                </td>
                <td class="text-end">
                    <button class="btn btn-sm btn-warning" onclick="openEditModal({{ $todo->id }})">Düzenle</button>
                    <button class="btn btn-sm btn-danger" onclick="confirmDeleteTodo({{ $todo->id }})">Sil</button>
                    <form id="delete-form-{{ $todo->id }}" action="{{ route('todo.destroy', $todo->id) }}"
                        method="POST" class="d-none">
                        @csrf @method('DELETE')
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
    function openEditModal(id) {
        $.ajax({
            url: `/todo/modal/edit/${id}`,
            type: 'GET',
            success: function(data) {
                $('#modalContainer').html(data);
                $('#editTodoModal').modal('show');
            },
            error: function(xhr) {
                console.error('Edit modal yüklenemedi:', xhr.responseText);
            }
        });
    }

    function confirmDeleteTodo(id) {
        Swal.fire({
            title: 'Emin misin?',
            text: "Bu todo kalıcı olarak silinecek!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Evet, sil!',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#delete-form-${id}`).submit();
            }
        });
    }


    // table pagination 10 items
    $(document).ready(function() {
        $('#todoExportTable').DataTable({
            searching: false,
            lengthChange: false,
            "pageLength": 10,
            "language": {
                "lengthMenu": "_MENU_",
                "zeroRecords": "Kayıt bulunamadı",
                "info": "Toplam _TOTAL_ kayıt",
                "infoEmpty": "Kayıt yok",
                "infoFiltered": "(filtrelenmiş _MAX_ kayıt arasından)",
                "paginate": {
                    "first": "<span style='color: blue;'>İlk</span>",
                    "last": "<span style='color: blue;'>Son</span>",
                    "next": "<i class='fas fa-angle-right' style='color: blue;'></i>",
                    "previous": "<i class='fas fa-angle-left' style='color: blue;'></i>"
                }
            }
        });


    });
</script>
