<table class="table align-middle table-row-dashed" id="kt_deal_table">
    <thead>
        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
            <th>#</th>
            <th>Başlık</th>
            <th>Firma</th>
            <th>Kişi</th>
            <th>Tutar</th>
            <th>Aşama</th>
            <th>Kapanış</th>
            <th class="text-end">İşlem</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold">
        @foreach ($deals as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->title }}</td>
                <td>{{ optional($d->company)->name }}</td>
                <td>{{ optional($d->contact)->first_name }} {{ optional($d->contact)->last_name }}</td>
                <td>{{ number_format($d->amount, 2) }}</td>
                <td>
                    <span class="badge badge-light-primary">{{ ucfirst($d->stage) }}</span>
                </td>
                <td>{{ $d->close_date?->format('d.m.Y') }}</td>
                <td class="text-end">
                    <button class="btn btn-icon btn-sm btn-light-primary btn-edit" data-id="{{ $d->id }}">
                        <i class="ki-duotone ki-pencil fs-2"></i>
                    </button>
                    <button class="btn btn-icon btn-sm btn-light-danger btn-delete" data-id="{{ $d->id }}">
                        <i class="ki-duotone ki-trash fs-2"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $deals->links('pagination::bootstrap-5') }}
</div>
