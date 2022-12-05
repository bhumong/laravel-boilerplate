@props(['name', 'data', 'divClass', 'label'])
@php
    $divClass = $divClass ?? ''; 
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
    $label = $label ?? '';
@endphp
<div class="form-group">
    @if (!empty($label))
        <label>{{ $label }}</label>
    @endif
    @foreach ($data as $checkbox)
        <div class="form-check {{$divClass}}">
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
