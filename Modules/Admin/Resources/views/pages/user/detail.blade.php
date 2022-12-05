@section('title', 'User')

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
        <form action="" method="POST">
            @csrf
            <x-admin::form.input-text
                :name="'email'"
                :label="'Email'"
                :placeholder="'Email'"
                :value="$user->email"
            />
            <x-admin::form.input-checkbox
                :name="'isSuperadmin'"
                :data="[
                    [
                        'value' => 'true',
                        'id' => 'isSuperadmin',
                        'label' => 'Superadmin',
                        'isChecked' => $user->is_superuser
                    ]
                ]"
            />
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
        </form>

    </x-admin::card>
</x-admin::app-layout>