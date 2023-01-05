@section('title', 'Unauthorized')

@section('page_level_js')
@endsection

<x-admin::app-layout>
    <br>
    <x-admin::card>
        <div class="row">
            <div class="col">
                <h1 class="text-center">Unauthorized</h1>
                @if(!empty($message))
                <h5 class="text-center">{{$message}}</h5>
                @endif
            </div>
        </div>
    </x-admin::card>
</x-admin::app-layout>
