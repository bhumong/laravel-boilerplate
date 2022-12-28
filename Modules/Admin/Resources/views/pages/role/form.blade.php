@section('title', 'Role')

@section('page_level_js')
<x-admin::script.autocomplete />
@endsection
@php
    $breadcrumbs = [
        [
            'link' => route('admin/dashboard'),
            'label' => 'Home',
        ],
        [
            'link' => route('admin/roles/index'),
            'label' => 'Role List',
        ],
    ];

    if ($role->exists) {
        $breadcrumbs[] = [
            'link' => route('admin/roles/show', ['role' => $role->id]),
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
            @if ($role->exists)
                Edit Role
            @else
                Create Role
            @endif
        </x-slot>
    </x-admin::breadcrumbs>
    <x-admin::card :isTool="true" :title="'ID : ' . $role->id">
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

            <x-admin::form.input-select2
                :name="'permissions[]'"
                :label="'Permissions'"
                :value="'1'"
                :class="'select2-permission'"
                :multiple="'1'"
            >
            @if ($role->permissions->isNotEmpty())
                @foreach ($role->permissions as $permission)
                    <option value="{{$permission->id}}" selected="selected">{{$permission->permission}}</option>
                @endforeach
            @endif
            </x-admin::form.input-select2>

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
                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
            </div>
        </form>
    </x-admin::card>
</x-admin::app-layout>

