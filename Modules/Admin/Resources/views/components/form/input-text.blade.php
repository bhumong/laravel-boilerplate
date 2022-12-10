@props(['name', 'label', 'value', 'type', 'placeholder'])

@php
    $label = $label ?? '';
    $type = $type ?? 'text'; 
    $value = $value ?? ''; 
    $placeholder = $placeholder ?? ''; 
@endphp

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" id="{{$name}}" 
        placeholder="{{ $placeholder ?? $name ?? '' }}" value="{{ $value }}" name="{{$name}}"
    >
    <x-admin::form.input-error :message="$errors->first($name)"/>
</div>