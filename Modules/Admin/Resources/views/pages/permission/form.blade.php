@section('title', 'Permission - Form')

@section('page_level_js')
@endsection
@php
    $breadcrumbs = [
        [
            'link' => route('admin/dashboard'),
            'label' => 'Home',
        ],
        [
            'link' => route('admin/permissions/index'),
            'label' => 'Permission List',
        ],
    ];

    if ($permission->exists) {
        $breadcrumbs[] = [
            'link' => route('admin/permissions/show', ['permission' => $permission->id]),
            'label' => 'Detail',
        ];
        $breadcrumbs[] = [
            'label' => 'Edit',
            'active' => true,
        ];
    } else {
        $breadcrumbs[] = [
            'label' => 'Add',
            'active' => true,
        ];
    }
@endphp
<x-admin::app-layout>
    <x-admin::breadcrumbs :items="$breadcrumbs">
        <x-slot:title>
            @if ($permission->exists)
                Update Permission
            @else
                Create Permission
            @endif
        </x-slot>
    </x-admin::breadcrumbs>

    <x-admin::card :isTool="true" :title="'ID : ' . $permission->id">
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
            <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
        </div>
    </form>
    </x-admin::card>

</x-admin::app-layout>

