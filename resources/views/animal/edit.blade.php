@extends('layouts.admin')

@section('content')
    <h1>Hayvanı Düzenle</h1>

    <form action="{{ route('animal.update', $animal->id) }}" method="POST">
        @csrf @method('PUT')
        @include('animal._form', ['animal' => $animal])
        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
@endsection
