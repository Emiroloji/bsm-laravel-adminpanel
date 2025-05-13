<div class="mb-3">
    <label for="name" class="form-label">Ad</label>
    <input type="text" name="name" id="name" class="form-control"
        value="{{ old('name', optional($animal)->name) }}" required>
</div>

<div class="mb-3">
    <label for="species" class="form-label">Tür</label>
    <input type="text" name="species" id="species" class="form-control"
        value="{{ old('species', optional($animal)->species) }}" required>
</div>

<div class="mb-3">
    <label for="breed" class="form-label">Irk</label>
    <input type="text" name="breed" id="breed" class="form-control"
        value="{{ old('breed', optional($animal)->breed) }}">
</div>

<div class="mb-3">
    <label for="birth_date" class="form-label">Doğum Tarihi</label>
    <input type="date" name="birth_date" id="birth_date" class="form-control"
        value="{{ old('birth_date', optional($animal)->birth_date) }}">
</div>

<div class="mb-3">
    <label for="weight" class="form-label">Kilo</label>
    <input type="number" step="0.01" name="weight" id="weight" class="form-control"
        value="{{ old('weight', optional($animal)->weight) }}">
</div>

<div class="mb-3">
    <label for="owner_id" class="form-label">Sahip</label>
    <select name="owner_id" id="owner_id" class="form-select" required>
        <option value="">Seçiniz...</option>
        @foreach ($owners as $owner)
            <option value="{{ $owner->id }}"
                {{ old('owner_id', optional($animal)->owner_id) == $owner->id ? 'selected' : '' }}>
                {{ $owner->name }}
            </option>
        @endforeach
    </select>
</div>
