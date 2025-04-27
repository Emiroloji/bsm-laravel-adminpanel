<table class="table align-middle table-row-dashed" id="kt_company_table">
    <thead>
        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
            <th>#</th>
            <th>Şirket Adı</th>
            <th>Telefon</th>
            <th>E-posta</th>
            <th>Sektör</th>
            <th>Boyut</th>
            <th class="text-end">İşlem</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold">
        @foreach ($companies as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->phone }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->industry }}</td>
                <td>{{ ucfirst($c->size) }}</td>
                <td class="text-end">
                    <button class="btn btn-icon btn-sm btn-light-primary btn-edit" data-id="{{ $c->id }}">
                        <i class="ki-duotone ki-pencil fs-2"></i>
                    </button>
                    <button class="btn btn-icon btn-sm btn-light-danger btn-delete" data-id="{{ $c->id }}">
                        <i class="ki-duotone ki-trash fs-2"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $companies->links('pagination::bootstrap-5') }}
</div>
