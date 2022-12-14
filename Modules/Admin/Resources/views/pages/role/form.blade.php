@section('title', 'Role')

@section('page_level_js')
@endsection

<x-admin::app-layout>
    <x-admin::breadcrumbs :items="[
        [
            'link' => route('admin/dashboard'),
            'label' => 'Home',
        ],
        [
            'link' => route('admin/roles/index'),
            'label' => 'Role List',
        ],
        [
            'label' => 'Role',
            'active' => true,
        ],
    ]">
        <x-slot:title>
            @if ($role->exists)
                Edit Role
            @else
                Create Role
            @endif
        </x-slot>
    </x-admin::breadcrumbs>
    <x-admin::card :isTool="true">
        @if ($role->exists)
        <form action="{{route('admin/roles/update', ['role' => $role->id])}}" method="POST">
            @method("PUT")
        @else
        <form action="{{route('admin/roles/store')}}" method="POST">
            @method("POST")
        @endif
            @csrf
            <x-admin::form.input-text
                :name="'title'"
                :label="'Title'"
                :placeholder="''"
                :value="$role->title ?? old('title')"
            />
            <x-admin::form.input-textarea
                :name="'description'"
                :label="'Description'"
                :placeholder="''"
                :value="$role->description ?? old('description')"
            />

            <x-admin::form.input-checkbox
                :name="'is_active'"
                :defaultValue="'0'"
                :data="[
                    [
                        'value' => '1',
                        'id' => 'is_active',
                        'label' => 'Active',
                        'isChecked' => $role->is_active ?? old('is_active')
                    ]
                ]"
            />
            <div class="text-right">
                @if ($role->exists)
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy-modal">Delete</button>
                @endif
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        @if ($role->exists)
        <x-admin::modal-delete 
            :action="route('admin/roles/destroy', ['role' => $role->id])"
            :id="'destroy-modal'"
        >
            <h4 class="text-center">Are you sure want delete role "{{$role->title}}"?</h4>
        </x-admin::modal-delete>
        @endif
    </x-admin::card>
</x-admin::app-layout>

