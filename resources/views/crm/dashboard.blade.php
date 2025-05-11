@extends('layouts.admin')

@section('title', 'CRM Dashboard')

@section('content')
    <div class="row g-5 mb-5">
        <!-- Açık Fırsatlar -->
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5 class="card-title">Açık Fırsatlar</h5>
                <p class="display-4">{{ $openDeals }}</p>
            </div>
        </div>
        <!-- Toplam Contact -->
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5 class="card-title">Toplam Contact</h5>
                <p class="display-4">{{ $totalContacts }}</p>
            </div>
        </div>
        <!-- Deal Aşamaları -->
        <div class="col-md-4">
            <div class="card p-4">
                <h5 class="card-title mb-3">Deal Stages</h5>
                <canvas id="stagesChart" height="120"></canvas>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <h5 class="card-title mb-4">Bu Ayın Yeni Contact Grafiği</h5>
        <canvas id="contactsChart" height="100"></canvas>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function() {
            // Doughnut: Deal Stages
            const ctxStages = document.getElementById('stagesChart').getContext('2d');
            new Chart(ctxStages, {
                type: 'doughnut',
                data: {
                    labels: @json(array_keys($stages)),
                    datasets: [{
                        data: @json(array_values($stages))
                    }]
                }
            });

            // Line: Yeni Contacts
            const ctxContacts = document.getElementById('contactsChart').getContext('2d');
            new Chart(ctxContacts, {
                type: 'line',
                data: {
                    labels: @json(array_keys($days)),
                    datasets: [{
                        label: 'Yeni Contact',
                        data: @json(array_values($days)),
                        fill: false,
                        tension: 0.3
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Gün'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Adet'
                            }
                        }
                    }
                }
            });
        })();
    </script>
@endpush
