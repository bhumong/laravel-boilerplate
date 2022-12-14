@section('title', 'User')

@section('page_level_js')
    <x-admin::script.autocomplete />
@endsection

<x-admin::app-layout>
    <x-admin::breadcrumbs :items="[
        [
            'link' => route('admin/dashboard'),
            'label' => 'Home',
        ],
        [
            'link' => route('admin/users/index'),
            'label' => 'User List',
        ],
        [
            'label' => 'User',
            'active' => true,
        ],
    ]">
        <x-slot:title>
            @if ($user->exists)
                Edit User
            @else
                Create User
            @endif
        </x-slot>
    </x-admin::breadcrumbs>
    <x-admin::card :isTool="true">
        @if ($user->exists)
        <form action="{{route('admin/users/update', ['user' => $user->id])}}" method="POST">
            @method("PUT")
        @else
        <form action="{{route('admin/users/store')}}" method="POST">
            @method("POST")
        @endif
            @csrf
            <x-admin::form.input-text
                :name="'email'"
                :label="'Email'"
                :placeholder="''"
                :value="$user->email ?? old('email')"
            />
            <x-admin::form.input-text
                :name="'name'"
                :label="'Name'"
                :placeholder="''"
                :value="$user->name ?? old('name')"
            />
            <x-admin::form.input-text
                :name="'password'"
                :label="'Password'"
                :placeholder="''"
                :type="'password'"
            />
            <x-admin::form.input-text
                :name="'password_confirmation'"
                :label="'Password Confirmation'"
                :placeholder="''"
                :type="'password'"
            />

            <x-admin::form.input-select2
                :name="'role_id'"
                :label="'Role'"
                :value="$user->role_id"
                :class="'select2-role'"
            >
            @if ($user->role)
                <option value="{{$user->role_id}}" selected="selected">{{$user->role->title}}</option>
            @endif
            </x-admin::form.input-select2>
            <x-admin::form.input-checkbox
                :name="'is_superuser'"
                :defaultValue="'0'"
                :data="[
                    [
                        'value' => '1',
                        'id' => 'is_superuser',
                        'label' => 'Superuser',
                        'isChecked' => $user->is_superuser ?? old('is_superuser')
                    ]
                ]"
            />
            <div class="text-right">
                @if ($user->exists)
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy-modal">Delete</button>
                @endif
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        @if ($user->exists)
        <x-admin::modal-delete 
            :action="route('admin/users/destroy', ['user' => $user->id])"
            :id="'destroy-modal'"
        >
            <h4 class="text-center">Are you sure want delete user "{{$user->name}}"?</h4>
        </x-admin::modal-delete>
        @endif
    </x-admin::card>
</x-admin::app-layout>

