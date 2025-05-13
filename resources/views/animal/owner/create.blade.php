@extends('layouts.admin')

@section('content')
    <h1>Yeni Sahip Ekle</h1>
    <form action="{{ route('animal-owner.store') }}" method="POST">
        @csrf
        @include('animal.owner._form', ['owner' => null])
        <button class="btn btn-success mt-3">Kaydet</button>
    </form>
@endsection
