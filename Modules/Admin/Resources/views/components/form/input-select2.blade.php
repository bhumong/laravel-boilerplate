@props(['name', 'class', 'label', 'value'])

@php
    $label = $label ?? '';
    $value = $value ?? ''; 
@endphp

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select class="form-control {{$class}} @error($name) is-invalid @enderror" 
        id="{{$name}}"
        value="{{ $value }}"
        name="{{$name}}" 
    >
    @isset($slot)
        {{$slot}}
    @endisset
    </select>
    <x-admin::form.input-error :message="$errors->first($name)"/>
</div>