<table class="table align-middle table-row-dashed" id="kt_contact_table">
    <thead>
        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
            <th>#</th>
            <th>Ad / Soyad</th>
            <th>E-posta</th>
            <th>Telefon</th>
            <th>Pozisyon</th>
            <th class="text-end">İşlemler</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold">
        @foreach ($contacts as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->first_name }} {{ $c->last_name }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->phone }}</td>
                <td>{{ $c->position }}</td>
                <td class="text-end d-flex justify-content-end gap-2">
                    {{-- Activities Modal Butonu --}}
                    <button class="btn btn-icon btn-sm btn-light-info open-activity-modal" data-id="{{ $c->id }}"
                        data-bs-toggle="modal" data-bs-target="#activityModal">
                        <i class="ki-duotone ki-calendar fs-5"></i> Aktivite
                    </button>

                    {{-- Düzenle --}}
                    <button class="btn btn-icon btn-sm btn-light-primary btn-edit" data-id="{{ $c->id }}">
                        <i class="ki-duotone ki-pencil fs-5"></i> Düzenle
                    </button>

                    {{-- Sil --}}
                    <button class="btn btn-icon btn-sm btn-light-danger btn-delete" data-id="{{ $c->id }}">
                        <i class="ki-duotone ki-trash fs-5"></i> Sil
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $contacts->links('pagination::bootstrap-5') }}
</div>
