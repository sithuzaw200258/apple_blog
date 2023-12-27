<div class="mb-3">
    <label for="{{ $name }}" class="form-label fw-bold mb-0">{{ $label }}</label>
    <input type="{{ $type }}" 
        name="{{ $multiple ? $name."[]" : $name }}" 
        value="{{ old($name,$default) }}"
        id="{{ $name }}" 
        placeholder="{{ $placeholder }}" @isset($multiple)
        multiple
        {{ $attributes }}
        @endisset
        class="form-control @error($name)
            is-invalid
        @enderror @error("$name.*")
        is-invalid
    @enderror">

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @isset($multiple)
        @error("$name.*")
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    @endisset
</div>
