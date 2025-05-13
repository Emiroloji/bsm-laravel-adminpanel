@extends('layouts.admin')

@section('content')
    <h1>Yeni Hayvan Ekle</h1>

    <form action="{{ route('animal.store') }}" method="POST">
        @csrf
        @include('animal._form', ['animal' => null])
        <button type="submit" class="btn btn-success">Kaydet</button>
    </form>
@endsection
