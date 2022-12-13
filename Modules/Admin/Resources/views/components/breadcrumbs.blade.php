<section class="content-header" style="padding-bottom: 10px; padding-top:10px">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>{{ $title }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @isset($items)
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
                    @endisset
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>