@props(['name', 'label', 'value', 'type', 'placeholder'])

@php
    $label = $label ?? '';
    $type = $type ?? 'text';
    $value = $value ?? '';
    $placeholder = $placeholder ?? '';
@endphp
 <div class="form-group">
        <label for="{{ $name }}">{{ $label }}</label>
        <textarea class="form-control @error($name) is-invalid @enderror"
                  rows="3"
                  id="{{$name}}"
                  placeholder="{{ $placeholder ?? $name ?? '' }}"
                  name="{{$name}}"
        >{{$value}}</textarea>
    <x-admin::form.input-error :message="$errors->first($name)"/>
</div>

