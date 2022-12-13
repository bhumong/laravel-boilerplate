@props(['message'])

@if (isset($message))
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@endif