<!-- Default box -->
<div class="card">
    <div class="card-header">
        @isset($title)
            <h3 class="card-title">{{ $title }}</h3>
        @endisset

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="bi bi-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="bi bi-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        {!! $body !!}
    </div>
    <!-- /.card-body -->
    @if (!empty($isFooterActive)) 
        <div class="card-footer">
            Footer
        </div>
    @endif
    <!-- /.card-footer-->
</div>