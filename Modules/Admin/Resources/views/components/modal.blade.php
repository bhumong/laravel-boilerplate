<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="delete-{{$id}}"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if (!empty($header))
                <div class="modal-header">
                    {{$header}}
                </div>
            @endif
            <div class="modal-body">
                {{$slot}}
            </div>
            @if (!empty($footer))
                <div class="modal-footer">
                    {{$footer}}
                </div>
            @endif
        </div>
    </div>
</div>
