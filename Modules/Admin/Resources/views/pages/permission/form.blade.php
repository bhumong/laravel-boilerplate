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
            'link' => route('admin/permissions/index'),
            'label' => 'Permission List',
        ],
        [
            'link' => route('admin/permissions/show', ['permission' => $permission->id]),
            'label' => 'Detail',
        ],
        [
            'label' => 'Edit',
            'active' => true,
        ],
    ]">
        <x-slot:title>
            @if ($permission->exists)
                Update Permission
            @else
                Create Permission
            @endif
        </x-slot>
    </x-admin::breadcrumbs>

    <x-admin::card :isTool="true">
        @if ($permission->exists)
            <form action="{{route('admin/permissions/update', ['permission' => $permission->id])}}" method="POST">
            @method("PUT")
        @else
            <form action="{{route('admin/permissions/store')}}" method="POST">
            @method("POST")
        @endif
        @csrf
        <x-admin::form.input-text
            :name="'permission'"
            :label="'Permission'"
            :placeholder="''"
            :value="$permission->permission ?? old('permission')"
        />
        <x-admin::form.input-textarea
            :name="'description'"
            :label="'Description'"
            :placeholder="''"
            :value="$permission->description ?? old('description')"
        />

        <x-admin::form.input-checkbox
            :name="'is_active'"
            :defaultValue="'0'"
            :data="[
                [
                    'value' => '1',
                    'id' => 'is_active',
                    'label' => 'Active',
                    'isChecked' => $permission->is_active ?? old('is_active')
                ]
            ]"
        />
        <div class="text-right">
            @if ($permission->exists)
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy-modal">Delete</button>
            @endif
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

    @if ($permission->exists)
        <x-admin::modal-delete
            :action="route('admin/permissions/destroy', ['permission' => $permission->id])"
            :id="'destroy-modal'"
        >
            <h4 class="text-center">Are you sure want delete role "{{$permission->permission}}"?</h4>
        </x-admin::modal-delete>
    @endif
    </x-admin::card>

</x-admin::app-layout>

