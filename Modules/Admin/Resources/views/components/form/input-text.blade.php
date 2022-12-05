@props(['name', 'label', 'value', 'type', 'placeholder'])

@php
    $label = $label ?? '';
    $type = $type ?? 'text'; 
    $value = $value ?? ''; 
    $placeholder = $placeholder ?? ''; 
@endphp

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" id="" placeholder="{{ $placeholder ?? $name ?? '' }}" value="{{ $value }}">
    <x-admin::form.input-error :message="$errors->first($name)"/>
</div>