<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <div class="modal-content">
            <form id="createForm">@csrf
                <div class="modal-header">
                    <h2 class="fw-bolder">Yeni Fırsat</h2>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"></i>
                    </button>
                </div>

                <div class="modal-body py-10 px-lg-10">
                    <div class="row g-5">
                        <!-- Mevcut alanlar -->
                        <div class="col-md-6 fv-row">
                            <label class="required form-label">Başlık</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Tutar</label>
                            <input type="number" step="0.01" name="amount" class="form-control">
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Aşama</label>
                            <select name="stage" class="form-select" required>
                                @foreach (['new', 'qualified', 'proposal', 'negotiation', 'won', 'lost'] as $s)
                                    <option value="{{ $s }}">{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Kapanış Tarihi</label>
                            <input type="date" name="close_date" class="form-control">
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Firma</label>
                            <select name="company_id" class="form-select">
                                <option value="">Seçiniz</option>
                                @foreach ($companies as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Kişi</label>
                            <select name="contact_id" class="form-select">
                                <option value="">Seçiniz</option>
                                @foreach ($contacts as $id => $full)
                                    <option value="{{ $id }}">{{ $full }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 fv-row">
                            <label class="form-label">Açıklama</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <hr>

                    <!-- Teklif Kalemleri -->
                    <h5>Teklif Kalemleri</h5>
                    <table class="table table-bordered" id="items-table">
                        <thead>
                            <tr>
                                <th>Ürün/Hizmet</th>
                                <th>Adet</th>
                                <th>Birim Fiyat</th>
                                <th style="width:40px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="items[0][name]" class="form-control" required></td>
                                <td><input type="number" name="items[0][quantity]" class="form-control" min="1"
                                        required></td>
                                <td><input type="number" name="items[0][unit_price]" step="0.01"
                                        class="form-control" min="0" required></td>
                                <td><button type="button" class="btn btn-sm btn-danger remove-item">×</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" id="add-item" class="btn btn-sm btn-secondary">+ Kalem Ekle</button>
                </div>

                <div class="modal-footer flex-center">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (function() {
            let idx = 1;
            const tbody = document.querySelector('#items-table tbody');
            document.getElementById('add-item').addEventListener('click', () => {
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

            tbody.addEventListener('click', e => {
                if (e.target.matches('.remove-item')) {
                    e.target.closest('tr').remove();
                }
            });
        })();
    </script>
@endpush
