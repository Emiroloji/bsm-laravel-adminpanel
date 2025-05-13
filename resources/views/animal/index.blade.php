@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h1>Hayvanlar</h1>
        <a href="{{ route('animal.create') }}" class="btn btn-primary">Yeni Ekle</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Ad</th>
                <th>Tür</th>
                <th>Irk</th>
                <th>Sahip</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $a)
                <tr>
                    <td>{{ $a->id }}</td>
                    <td>{{ $a->name }}</td>
                    <td>{{ $a->species }}</td>
                    <td>{{ $a->breed }}</td>
                    <td>{{ $a->owner->name }}</td>
                    <td>
                        <a href="{{ route('animal.show', $a->id) }}" class="btn btn-sm btn-info">Görüntüle</a>
                        <a href="{{ route('animal.edit', $a->id) }}" class="btn btn-sm btn-warning">Düzenle</a>
                        <form action="{{ route('animal.destroy', $a->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
