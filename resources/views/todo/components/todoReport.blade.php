<div class="row g-6 mb-6">
    @foreach ([['icon' => 'mdi-format-list-bulleted', 'title' => 'Toplam Not', 'count' => $totalNotes, 'color' => 'primary'], ['icon' => 'mdi-check-circle-outline', 'title' => 'Tamamlanmış Not', 'count' => $completedNotes, 'color' => 'success'], ['icon' => 'mdi-progress-clock', 'title' => 'Tamamlanacak Not', 'count' => $pendingNotes, 'color' => 'warning']] as $item)
        <div class="col-sm-6 col-xl-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column px-6 py-6">
                    <div class="d-flex align-items-center mb-4">
                        <div class="symbol symbol-45px me-4 bg-light-{{ $item['color'] }}">
                            <i class="mdi {{ $item['icon'] }} fs-2 text-{{ $item['color'] }}"></i>
                        </div>
                        <h4 class="fw-semibold text-gray-800 m-0">{{ $item['title'] }}</h4>
                    </div>
                    <div class="fs-2 fw-bold mt-auto">{{ $item['count'] }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
