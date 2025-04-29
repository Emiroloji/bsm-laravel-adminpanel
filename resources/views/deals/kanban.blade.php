@extends('layouts.admin')

@section('title', 'Deals Kanban')

@section('content')
    <div class="row gx-3 kanban-board">
        @foreach ($stages as $stage)
            <div class="col">
                <div class="card card-flush h-100">
                    <div class="card-header">
                        <h3 class="card-title text-capitalize">{{ $stage }}</h3>
                    </div>
                    <div class="card-body kanban-list" data-stage="{{ $stage }}" id="list-{{ $stage }}">
                        @foreach ($group[$stage] as $deal)
                            <div class="card mb-3 kanban-item" data-id="{{ $deal->id }}">
                                <div class="card-body py-2 px-3">
                                    <strong>{{ $deal->title }}</strong><br>
                                    <small class="text-muted">{{ optional($deal->company)->name }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('styles')
    <style>
        .kanban-board {
            display: flex;
            overflow-x: auto;
            padding-bottom: 1rem;
        }

        .kanban-board .col {
            min-width: 250px;
        }

        .kanban-list {
            min-height: 200px;
        }

        .kanban-item {
            cursor: grab;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script>
        document.querySelectorAll('.kanban-list').forEach(listEl => {
            new Sortable(listEl, {
                group: 'deals-kanban',
                animation: 150,
                onEnd: evt => {
                    const id = evt.item.dataset.id;
                    const newStage = evt.to.dataset.stage;

                    fetch(`{{ url('crm/deals') }}/${id}/move`, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                new_stage: newStage
                            })
                        })
                        .then(res => res.ok || Promise.reject(res))
                        .catch(err => console.error('Kanban move error:', err));
                }
            });
        });
    </script>
@endpush
