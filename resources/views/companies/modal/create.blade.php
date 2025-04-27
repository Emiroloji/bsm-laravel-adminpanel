<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form id="createForm">@csrf
                <div class="modal-header">
                    <h2 class="fw-bolder">Yeni Şirket</h2>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"></i>
                    </button>
                </div>
                <div class="modal-body py-10 px-lg-10">
                    <div class="row g-5">
                        <div class="col-md-6 fv-row"><label class="required form-label">Şirket Adı</label><input
                                type="text" name="name" class="form-control" required></div>
                        <div class="col-md-6 fv-row"><label class="form-label">Ticari Unvan</label><input type="text"
                                name="legal_name" class="form-control"></div>
                        <div class="col-md-6 fv-row"><label class="form-label">Vergi/TCKN</label><input type="text"
                                name="tax_number" class="form-control"></div>
                        <div class="col-md-6 fv-row"><label class="form-label">Telefon</label><input type="text"
                                name="phone" class="form-control"></div>
                        <div class="col-md-6 fv-row"><label class="form-label">E-posta</label><input type="email"
                                name="email" class="form-control"></div>
                        <div class="col-md-6 fv-row"><label class="form-label">Web Sitesi</label><input type="url"
                                name="website" class="form-control"></div>
                        <div class="col-md-6 fv-row"><label class="form-label">Sektör</label><input type="text"
                                name="industry" class="form-control"></div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Boyut</label>
                            <select name="size" class="form-select">
                                <option value="">Seçiniz</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="enterprise">Enterprise</option>
                            </select>
                        </div>
                        <div class="col-12 fv-row"><label class="form-label">Adres</label>
                            <textarea name="address" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-12 fv-row"><label class="form-label">Notlar</label>
                            <textarea name="notes" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
