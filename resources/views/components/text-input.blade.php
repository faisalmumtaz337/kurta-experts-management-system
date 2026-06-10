@props([
    'name' => '',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'mandatory' => false
])

<div class="form-group">
    
    {{-- Label --}}
    @if($label)
        <label for="{{ $name }}">
            {{ $label }}
            @if($mandatory)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    {{-- Input --}}
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')
        ]) }}
    >

    {{-- Error Message --}}
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>