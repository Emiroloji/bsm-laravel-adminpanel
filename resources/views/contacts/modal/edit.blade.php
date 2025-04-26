<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form id="editForm" data-id="{{ $contact->id }}">
                @method('PUT') @csrf
                <div class="modal-header">
                    <h2 class="fw-bolder">Kişiyi Düzenle</h2>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"></i>
                    </button>
                </div>

                <div class="modal-body py-10 px-lg-10">
                    <div class="row g-5">
                        <div class="col-md-6 fv-row">
                            <label class="required form-label">Ad</label>
                            <input type="text" name="first_name" class="form-control"
                                value="{{ $contact->first_name }}" required />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Soyad</label>
                            <input type="text" name="last_name" class="form-control"
                                value="{{ $contact->last_name }}" />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required form-label">E-posta</label>
                            <input type="email" name="email" class="form-control" value="{{ $contact->email }}"
                                required />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Telefon</label>
                            <input type="text" name="phone" class="form-control" value="{{ $contact->phone }}" />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="form-label">Pozisyon</label>
                            <input type="text" name="position" class="form-control"
                                value="{{ $contact->position }}" />
                        </div>
                        <div class="col-12 fv-row">
                            <label class="form-label">Adres</label>
                            <textarea name="address" class="form-control" rows="2">{{ $contact->address }}</textarea>
                        </div>
                        <div class="col-12 fv-row">
                            <label class="form-label">Notlar</label>
                            <textarea name="notes" class="form-control" rows="2">{{ $contact->notes }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Güncelle</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
