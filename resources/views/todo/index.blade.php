@extends('layouts.admin')

@section('title', 'Todo Listesi')

@section('content')

    <!-- Başlık ve mesaj -->
    <div class="mb-10">
        <h1 class="text-dark fw-bolder fs-2qx mb-4">📝 Todo Listesi</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

    <!-- Todo Ekleme Formu -->
    <div class="card mb-10">
        <div class="card-header">
            <h3 class="card-title">Yeni Todo Ekle</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('todo.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-5">
                    <input type="text" name="title" class="form-control form-control-solid" placeholder="Başlık"
                        required>
                </div>
                <div class="col-md-5">
                    <input type="text" name="description" class="form-control form-control-solid" placeholder="Açıklama">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa fa-plus"></i> Ekle
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Todo Listeleme -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Todo Listesi</h3>
        </div>
        <div class="card-body pt-0">
            <table class="table table-hover align-middle table-row-bordered table-row-solid gy-4">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>#</th>
                        <th>Başlık</th>
                        <th>Açıklama</th>
                        <th>Durum</th>
                        <th class="text-end">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($todos as $todo)
                        <tr>
                            <td>{{ $todo->id }}</td>
                            <td>{{ $todo->title }}</td>
                            <td>{{ $todo->description }}</td>
                            <td>
                                @if ($todo->is_completed)
                                    <span class="badge badge-light-success">Tamamlandı</span>
                                @else
                                    <span class="badge badge-light-warning">Bekliyor</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i> Sil
                                    </button>
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
        </div>
    </div>

@endsection
