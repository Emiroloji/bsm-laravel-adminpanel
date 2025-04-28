@extends('layouts.admin')
@section('title', 'Deal Pipeline')

@section('content')

    <div class="d-flex gap-4 overflow-auto">
        @foreach ($stages as $s)
            <div class="kanban-column flex-shrink-0" style="width:300px;">
                <div class="bg-light-primary p-3 mb-3 rounded">
                    <span class="fw-bold text-primary">{{ ucfirst($s) }}</span>
                    <span class="badge bg-primary ms-2" id="sum-{{ $s }}">
                        {{ ($group[$s] ?? collect())->sum('amount') }}
                    </span>
                </div>

                <div class="kanban-list" id="list-{{ $s }}" data-stage="{{ $s }}">
                    @foreach ($group[$s] ?? collect() as $d)
                        <div class="deal-card card mb-3" data-id="{{ $d->id }}" data-amount="{{ $d->amount }}">
                            <div class="card-body p-2">
                                <div class="fw-bold">{{ $d->title }}</div>
                                <small class="text-muted">{{ optional($d->company)->name }}</small><br>
                                <span class="fw-bold">{{ number_format($d->amount, 2) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

@endsection {{--  <<< EKLENDİ  --}}

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const baseUrl = "{{ url('crm/deals') }}";

            document.querySelectorAll('.kanban-list').forEach(list => {

                Sortable.create(list, {
                    group: 'deals',
                    animation: 150,
                    draggable: '.deal-card',

                    onEnd: ({
                        item,
                        to,
                        from
                    }) => {
                        const id = item.dataset.id;
                        if (!/^\d+$/.test(id)) return;

                        const amount = parseFloat(item.dataset.amount);
                        const newStage = to.dataset.stage;
                        const oldStage = from.dataset.stage;

                        fetch(`${baseUrl}/${id}`, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                stage: newStage
                            })
                        });

                        const sum = s => document.getElementById(`sum-${s}`);
                        sum(oldStage).textContent = (parseFloat(sum(oldStage).textContent) -
                            amount).toFixed(2);
                        sum(newStage).textContent = (parseFloat(sum(newStage).textContent) +
                            amount).toFixed(2);
                    }
                });

            });
        });
    </script>
@endpush
