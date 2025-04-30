<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <h3 class="fw-bold text-gray-800 mb-0">Fırsatlar</h3>
        </div>

    </div>

    <div class="card-body pt-0">
        <div class="table-responsive">
            <table id="deals_table" class="table table-row-dashed table-row-gray-200 align-middle gs-7 gy-7">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-30px">#</th>
                        <th class="min-w-150px">Başlık</th>
                        <th class="min-w-100px">Tutar</th>
                        <th class="min-w-120px">Aşama</th>
                        <th class="min-w-120px">Kapanış Tarihi</th>
                        <th class="min-w-150px">Firma</th>
                        <th class="min-w-150px">Kişi</th>
                        <th class="text-center min-w-200px">İşlemler</th>
                        <th class="text-center min-w-200px">Teklif İndir</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @foreach ($deals as $deal)
                        <tr>
                            <td>{{ $deal->id }}</td>
                            <td>{{ $deal->title }}</td>
                            <td>{{ number_format($deal->amount, 2) }} TL</td>
                            <td>{{ ucfirst($deal->stage) }}</td>
                            <td>{{ $deal->close_date?->format('d.m.Y') }}</td>
                            <td>{{ $deal->company?->name }}</td>
                            <td>{{ $deal->contact?->first_name }} {{ $deal->contact?->last_name }}</td>
                            <td class="text-center">
                                <button class="btn btn-light-primary btn-sm me-2 btn-edit"
                                    data-id="{{ $deal->id }}">
                                    <i class="ki-duotone ki-pencil fs-4"></i> Düzenle
                                </button>
                                <button class="btn btn-light-danger btn-sm btn-delete" data-id="{{ $deal->id }}">
                                    <i class="ki-duotone ki-trash fs-4"></i> Sil
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-light-primary btn-sm me-2 btn-view-proposal"
                                    data-id="{{ $deal->id }}">
                                    <i class="ki-duotone ki-eye fs-4"></i> Görüntüle
                                </button>
                                <a href="{{ route('deals.export.excel', $deal->id) }}"
                                    class="btn btn-light-success btn-sm me-2">
                                    <i class="ki-duotone ki-file-excel fs-4"></i> Excel İndir
                                </a>
                                <a href="{{ route('deals.export.pdf', $deal->id) }}"
                                    class="btn btn-light-danger btn-sm">
                                    <i class="ki-duotone ki-file-pdf fs-4"></i> PDF İndir
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
