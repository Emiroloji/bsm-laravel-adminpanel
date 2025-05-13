@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h1>Sahipler</h1>
        <a href="{{ route('animal-owner.create') }}" class="btn btn-primary">Yeni Sahip</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>İsim</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Adres</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($owners as $o)
                <tr>
                    <td>{{ $o->id }}</td>
                    <td>{{ $o->name }}</td>
                    <td>{{ $o->email }}</td>
                    <td>{{ $o->phone }}</td>
                    <td>{{ $o->address }}</td>
                    <td>
                        <a href="{{ route('animal-owner.edit', $o->id) }}" class="btn btn-sm btn-warning">Düzenle</a>
                        <form action="{{ route('animal-owner.destroy', $o->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Silinsin mi?')" class="btn btn-sm btn-danger">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
