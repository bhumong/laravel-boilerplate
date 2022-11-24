<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $title }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach ($items as $item)
                        @if (isset($item['active']) && $item['active'])
                            <li class="breadcrumb-item active">
                                {{$item['label']}}
                            </li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="{{$item['link']}}">{{$item['label']}}</a>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>