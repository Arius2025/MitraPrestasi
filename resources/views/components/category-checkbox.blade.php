<div class="form-group">
    <label><strong>Pilih Kategori:</strong></label>
    <div class="row">
        @foreach ($categories as $kategori)
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]"
                        id="kategori-{{ $kategori }}" value="{{ $kategori }}"
                        @if (in_array($kategori, $selected)) checked @endif>
                    <label class="form-check-label" for="kategori-{{ $kategori }}">
                        {{ strtoupper($kategori) }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>
