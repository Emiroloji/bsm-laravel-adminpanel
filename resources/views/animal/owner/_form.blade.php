<div class="mb-3">
    <label class="form-label">İsim</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', optional($owner)->name) }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', optional($owner)->email) }}"
        required>
</div>
<div class="mb-3">
    <label class="form-label">Telefon</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', optional($owner)->phone) }}">
</div>
<div class="mb-3">
    <label class="form-label">Adres</label>
    <textarea name="address" class="form-control">{{ old('address', optional($owner)->address) }}</textarea>
</div>
