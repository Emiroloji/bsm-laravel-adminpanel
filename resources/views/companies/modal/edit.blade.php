<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form id="editForm" data-id="{{ $company->id }}">@method('PUT') @csrf
                <div class="modal-header">
                    <h2 class="fw-bolder">Şirketi Düzenle</h2>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"></i>
                    </button>
                </div>
                <div class="modal-body py-10 px-lg-10">
                    <div class="row g-5">
                        <div class="col-md-6 fv-row"><label class="required form-label">Şirket Adı</label><input
                                type="text" name="name" class="form-control" value="{{ $company->name }}"
                                required></div>
                        <div class="col-md-6 fv-row"><label class="form-label">Ticari Unvan</label><input type="text"
                                name="legal_name" class="form-control" value="{{ $company->legal_name }}"></div>
                        <div class="col-md-6 fv-row"><label class="form-label">Vergi/TCKN</label><input type="text"
                                name="tax_number" class="form-control" value="{{ $company->tax_number }}"></div>
                        <div class="col-md-6 fv-row"><label class="form-label">Telefon</label><input type="text"
                                name="phone" class="form-control" value="{{ $company->phone }}"></div>
                        <div class="col-md-6 fv-row"><label class="form-label">E-posta</label><input type="email"
                                name="email" class="form-control" value="{{ $company->email }}"></div>
                        <div class="col-md-6 fv-row"><label class="form-label">Web Sitesi</label><input type="url"
                                name="website" class="form-control" value="{{ $company->website }}"></div>
                        <div class="col-md-6 fv-row"><label class="form-label">Sektör</label><input type="text"
                                name="industry" class="form-control" value="{{ $company->industry }}"></div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Boyut</label>
                            <select name="size" class="form-select">
                                <option value="">Seçiniz</option>
                                <option value="small" {{ $company->size == 'small' ? 'selected' : '' }}>Small</option>
                                <option value="medium" {{ $company->size == 'medium' ? 'selected' : '' }}>Medium
                                </option>
                                <option value="enterprise" {{ $company->size == 'enterprise' ? 'selected' : '' }}>
                                    Enterprise
                                </option>
                            </select>
                        </div>
                        <div class="col-12 fv-row"><label class="form-label">Adres</label>
                            <textarea name="address" class="form-control" rows="2">{{ $company->address }}</textarea>
                        </div>
                        <div class="col-12 fv-row"><label class="form-label">Notlar</label>
                            <textarea name="notes" class="form-control" rows="2">{{ $company->notes }}</textarea>
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
