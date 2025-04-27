<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <div class="modal-content">
            <form id="editForm" data-id="{{ $deal->id }}">@method('PUT') @csrf
                <div class="modal-header">
                    <h2 class="fw-bolder">Fırsatı Düzenle</h2>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"></i>
                    </button>
                </div>

                <div class="modal-body py-10 px-lg-10">
                    <div class="row g-5">
                        <div class="col-md-6 fv-row">
                            <label class="required form-label">Başlık</label>
                            <input type="text" name="title" class="form-control" value="{{ $deal->title }}"
                                required>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Tutar</label>
                            <input type="number" step="0.01" name="amount" class="form-control"
                                value="{{ $deal->amount }}">
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Aşama</label>
                            <select name="stage" class="form-select" required>
                                @foreach (['new', 'qualified', 'proposal', 'negotiation', 'won', 'lost'] as $s)
                                    <option value="{{ $s }}" {{ $deal->stage == $s ? 'selected' : '' }}>
                                        {{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Kapanış Tarihi</label>
                            <input type="date" name="close_date" class="form-control"
                                value="{{ $deal->close_date }}">
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Firma</label>
                            <select name="company_id" class="form-select">
                                <option value="">Seçiniz</option>
                                @foreach ($companies as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ $deal->company_id == $id ? 'selected' : '' }}>
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Kişi</label>
                            <select name="contact_id" class="form-select">
                                <option value="">Seçiniz</option>
                                @foreach ($contacts as $id => $full)
                                    <option value="{{ $id }}"
                                        {{ $deal->contact_id == $id ? 'selected' : '' }}>
                                        {{ $full }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 fv-row">
                            <label class="form-label">Açıklama</label>
                            <textarea name="description" class="form-control" rows="2">{{ $deal->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>
