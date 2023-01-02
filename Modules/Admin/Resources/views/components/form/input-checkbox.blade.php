@props(['name', 'data', 'divClass', 'label', 'defaultValue'])
@php
    $divClass = $divClass ?? '';
    $defaultValue = $defaultValue ?? null;
    $name = $name ?? '';
    /** @var array
     * example data
     * [
     *  [
     *    'value' => 'string',
     *    'id' => 'string',
     *    'label' => 'string'
     *    'isChecked' => true
     *  ]
     * ]
    */
    $data = $data ?? [];
    $label = $label ?? '';
@endphp
<div class="form-group">
    @if($defaultValue !== null)
        <input type="hidden" value="{{$defaultValue}}" name="{{$name}}">
    @endif
    @if (!empty($label))
        <label>{{ $label }}</label>
    @endif
    @foreach ($data as $checkbox)
        <div class="form-check {{$divClass}} @error($name) is-invalid @enderror">
            <input class="form-check-input"
                type="checkbox"
                id="{{$checkbox['id']}}"
                value="{{$checkbox['value'] ?? ''}}"
                name="{{$name}}"

                {{!empty($checkbox['isChecked']) ? 'checked' : ''}}
            >
            <label class="form-check-label" for="{{$checkbox['id']}}">{{ $checkbox['label'] }}</label>
        </div>
    @endforeach
</div>
