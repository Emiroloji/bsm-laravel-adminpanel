<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="p-4">

    <div class="container">
        <h1 class="mb-4">Todo Listesi</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('todo.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control" placeholder="Başlık" required>
                </div>
                <div class="col-md-5">
                    <input type="text" name="description" class="form-control" placeholder="Açıklama">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Ekle</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Tamamlandı</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($todos as $todo)
                    <tr>
                        <td>{{ $todo->id }}</td>
                        <td>{{ $todo->title }}</td>
                        <td>{{ $todo->description }}</td>
                        <td>{{ $todo->is_completed ? 'Evet' : 'Hayır' }}</td>
                        <td>
                            <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Sil</button>
                            </form>
                            {{-- Geliştirme: Güncelleme butonu eklenebilir --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Henüz todo eklenmemiş.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>
