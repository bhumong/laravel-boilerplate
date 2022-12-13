<!-- Default box -->
<div class="card">
    @if (isset($title) || isset($isTool))
    <div class="card-header">
        @isset($title)
            <h3 class="card-title">{{ $title }}</h3>
        @endisset

        @isset($isTool)
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="bi bi bi-dash-lg text-warning"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="bi bi-x-lg text-danger"></i>
                </button>
            </div>
        @endisset
    </div>
    @endif

    <div class="card-body">
        {{ $slot }}
    </div>
    <!-- /.card-body -->
    @isset($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endisset
    <!-- /.card-footer-->
</div>