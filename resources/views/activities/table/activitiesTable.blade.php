@if ($activities->isEmpty())
    <div class="text-center text-muted py-4">No activities found.</div>
@else
    <ul class="list-group">
        @foreach ($activities as $activity)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div>
                    <span class="badge bg-secondary me-2">
                        {{ $activity->created_at->format('d.m.Y H:i') }}
                    </span>
                    <strong>{{ ucfirst($activity->type) }}:</strong>
                    {{ $activity->comment }}
                    @if ($activity->due_at)
                        <div><small>Due: {{ $activity->due_at->format('d.m.Y H:i') }}</small></div>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
@endif
