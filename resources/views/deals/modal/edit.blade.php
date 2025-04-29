<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <div class="modal-content">
            <form id="editForm" data-id="{{ $deal->id }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h2 class="fw-bolder">Fırsatı Düzenle</h2>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"></i>
                    </button>
                </div>

                <div class="modal-body py-10 px-lg-10">
                    <div class="row g-5">
                        <!-- Başlık -->
                        <div class="col-md-6 fv-row">
                            <label class="required form-label">Başlık</label>
                            <input type="text" name="title" value="{{ $deal->title }}" class="form-control"
                                required>
                        </div>
                        <!-- Tutar -->
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Tutar</label>
                            <input type="number" step="0.01" name="amount" value="{{ $deal->amount }}"
                                class="form-control">
                        </div>
                        <!-- Aşama -->
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Aşama</label>
                            <select name="stage" class="form-select" required>
                                @foreach (['new', 'qualified', 'proposal', 'negotiation', 'won', 'lost'] as $s)
                                    <option value="{{ $s }}"
                                        @if ($deal->stage === $s) selected @endif>
                                        {{ ucfirst($s) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Kapanış Tarihi -->
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Kapanış Tarihi</label>
                            <input type="date" name="close_date" value="{{ $deal->close_date?->format('Y-m-d') }}"
                                class="form-control">
                        </div>
                        <!-- Firma -->
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Firma</label>
                            <select name="company_id" class="form-select">
                                <option value="">Seçiniz</option>
                                @foreach ($companies as $id => $name)
                                    <option value="{{ $id }}"
                                        @if ($deal->company_id === $id) selected @endif>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Kişi -->
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Kişi</label>
                            <select name="contact_id" class="form-select">
                                <option value="">Seçiniz</option>
                                @foreach ($contacts as $id => $full)
                                    <option value="{{ $id }}"
                                        @if ($deal->contact_id === $id) selected @endif>
                                        {{ $full }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Açıklama -->
                        <div class="col-12 fv-row">
                            <label class="form-label">Açıklama</label>
                            <textarea name="description" class="form-control" rows="2">{{ $deal->description }}</textarea>
                        </div>
                    </div>

                    <hr>

                    <!-- Teklif Kalemleri -->
                    <h5>Teklif Kalemleri</h5>
                    <table class="table table-bordered" id="edit-items-table">
                        <thead>
                            <tr>
                                <th>Ürün/Hizmet</th>
                                <th>Adet</th>
                                <th>Birim Fiyat</th>
                                <th style="width:40px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $idx = 0; @endphp
                            @foreach ($deal->items ?? [] as $item)
                                <tr>
                                    <td>
                                        <input type="text" name="items[{{ $idx }}][name]"
                                            value="{{ $item['name'] ?? '' }}" class="form-control" required>
                                    </td>
                                    <td>
                                        <input type="number" name="items[{{ $idx }}][quantity]"
                                            value="{{ $item['quantity'] ?? '' }}" class="form-control" min="1"
                                            required>
                                    </td>
                                    <td>
                                        <input type="number" name="items[{{ $idx }}][unit_price]"
                                            value="{{ $item['unit_price'] ?? '' }}" step="0.01" class="form-control"
                                            min="0" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger remove-item">×</button>
                                    </td>
                                </tr>
                                @php $idx++; @endphp
                            @endforeach
                            @if ($idx === 0)
                                {{-- En az bir satır göstermek için --}}
                                <tr>
                                    <td><input type="text" name="items[0][name]" class="form-control" required></td>
                                    <td><input type="number" name="items[0][quantity]" class="form-control"
                                            min="1" required></td>
                                    <td><input type="number" name="items[0][unit_price]" step="0.01"
                                            class="form-control" min="0" required></td>
                                    <td><button type="button" class="btn btn-sm btn-danger remove-item">×</button></td>
                                </tr>
                                @php $idx = 1; @endphp
                            @endif
                        </tbody>
                    </table>
                    <button type="button" id="edit-add-item" class="btn btn-sm btn-secondary">+ Kalem Ekle</button>
                </div>

                <div class="modal-footer flex-center">
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (function() {
            let idx = {{ $idx }};
            const tbody = document.querySelector('#edit-items-table tbody');

            // Yeni satır ekle
            document.getElementById('edit-add-item').addEventListener('click', () => {
                const row = document.createElement('tr');
                row.innerHTML = `
          <td><input type="text" name="items[${idx}][name]" class="form-control" required></td>
          <td><input type="number" name="items[${idx}][quantity]" class="form-control" min="1" required></td>
          <td><input type="number" name="items[${idx}][unit_price]" step="0.01" class="form-control" min="0" required></td>
          <td><button type="button" class="btn btn-sm btn-danger remove-item">×</button></td>
        `;
                tbody.appendChild(row);
                idx++;
            });

            // Satır sil
            tbody.addEventListener('click', e => {
                if (e.target.matches('.remove-item')) {
                    e.target.closest('tr').remove();
                }
            });
        })();
    </script>
@endpush
