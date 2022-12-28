@props(['name', 'class', 'label', 'value', 'multiple'])

@php
    $label = $label ?? '';
    $value = $value ?? '';
    $nameReformat = preg_replace("/[^a-zA-Z0-9]+/", "", $name ?? '');
@endphp

<div class="form-group">
    <label for="{{ $nameReformat }}">{{ $label }}</label>
    <select class="form-control {{$class}} @error($nameReformat) is-invalid @enderror"
        @if (!empty($multiple)) multiple="multiple" @endif
        id="{{$nameReformat}}"
        value="{{ $value }}"
        name="{{$name}}"
    >
    @isset($slot)
        {{$slot}}
    @endisset
    </select>
    <x-admin::form.input-error :message="$errors->first($name)"/>
</div>
