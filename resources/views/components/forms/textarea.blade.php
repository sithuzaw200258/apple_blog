<div class="mb-3">
    <label for="{{ $name }}" class="form-label fw-bold mb-0">{{ $label }}</label>
    <textarea name="{{ $name }}" 
        id="{{ $name }}" 
        rows="{{ $row }}" 
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
        class="form-control @error($name)
            is-invalid
        @enderror">{{ old($name,$default) }}</textarea>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>