@extends('layouts.admin')

@section('title', 'Bildirimler')

@section('content')
    <h1 class="mb-4">Bildirimler</h1>
    <ul class="list-group">
        @foreach ($notes as $note)
            <li class="list-group-item {{ $note->read_at ? '' : 'fw-bold' }}">
                <div class="d-flex justify-content-between">
                    <div>
                        {{ $note->data['comment'] }}
                        <div class="small text-muted">{{ $note->created_at->format('d.m.Y H:i') }}</div>
                    </div>
                    @if (is_null($note->read_at))
                        <a href="{{ route('notifications.markRead', $note->id) }}" class="btn btn-sm btn-light">Okundu</a>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
    {{ $notes->links() }}
@endsection
