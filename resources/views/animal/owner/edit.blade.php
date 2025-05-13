@extends('layouts.admin')

@section('content')
    <h1>Sahip Düzenle</h1>
    <form action="{{ route('animal-owner.update', $owner->id) }}" method="POST">
        @csrf @method('PUT')
        @include('animal.owner._form', ['owner' => $owner])
        <button class="btn btn-primary mt-3">Güncelle</button>
    </form>
@endsection
