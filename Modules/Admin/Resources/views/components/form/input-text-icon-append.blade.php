@props(['name', 'placeholder', 'value', 'icon', 'type'])

@php
    $type = $type ?? 'text'; 
    $value = $value ?? ''; 
    $placeholder = $placeholder ?? ''; 
    $icon = $icon ?? ''; 
@endphp
<div class="input-group @error($name) is-invalid @enderror">
    <input 
        type="{{$type}}" class="form-control @error($name) is-invalid @enderror" 
        aria-describedby="{{$name}}" 
        placeholder="{{$placeholder}}" id="{{$name}}" name="{{$name}}" value="{{ $value }}" autocomplete="off" 
    >
    @if ($icon)
        <div class="input-group-append">
            <span class="input-group-text"><span class="{{$icon}}"></span></span>
        </div>
    @endif

    <x-admin::form.input-error :message="$errors->first($name)"/>
</div>