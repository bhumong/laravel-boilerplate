@props(['name', 'label', 'value', 'type', 'placeholder', 'disabled'])

@php
    $label = $label ?? '';
    $type = $type ?? 'text';
    $value = $value ?? '';
    $placeholder = $placeholder ?? '';
    $disabled = $disabled ?? false;
@endphp

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" id="{{$name}}"
        placeholder="{{ $placeholder ?? $name ?? '' }}"
        value="{{ $value }}"
        name="{{$name}}"
        @if ($disabled)
            disabled='true'
        @endif
    >
    <x-admin::form.input-error :message="$errors->first($name)"/>
</div>
