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
            Users Detail
        </x-slot>
    </x-admin::breadcrumbs>
    <x-admin::card :isTool="true">
        <form action="{{route('admin/users/update', ['user' => $user->id])}}" method="POST">
            @method("PUT")
            @csrf
            <x-admin::form.input-text
                :name="'email'"
                :label="'Email'"
                :placeholder="''"
                :value="$user->email"
            />
            <x-admin::form.input-text
                :name="'name'"
                :label="'Name'"
                :placeholder="''"
                :value="$user->name"
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
                :data="[
                    [
                        'value' => '1',
                        'id' => 'is_superuser',
                        'label' => 'Superuser',
                        'isChecked' => $user->is_superuser
                    ]
                ]"
            />
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

    </x-admin::card>
</x-admin::app-layout>

