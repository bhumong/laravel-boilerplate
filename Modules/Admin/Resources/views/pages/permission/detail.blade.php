@section('title', 'Permission - Detail')

@section('page_level_js')
<script type="module">

</script>
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
            Detail Permission
        </x-slot>
    </x-admin::breadcrumbs>

    <x-admin::card>
        <div class="row">
            <div class="col text-left">
                <h5>
                    Permission: {{$permission->permission}}
                </h5>
                <h6>
                    ID: {{$permission->id}}
                </h6>
            </div>
            <div class="col">
                <div class="container text-right">
                    @can('update', $permission)
                    <a href="{{route('admin/permissions/edit', ['permission' => $permission->id])}}" class="btn btn-warning font-weight-bold">Edit</a>
                    @endcan

                    @can('delete', $permission)
                    <button type="button" class="btn btn-danger font-weight-bold" data-toggle="modal" data-target="#destroy-modal">Delete</button>
                    @endcan
                </div>
            </div>
        </div>
    </x-admin::card>

    <x-admin::card :title="'Detail'">
        <table class="table table-striped">
            <tbody>
              <tr>
                <th scope="row">Permission</th>
                <td>{{$permission->permission}}</td>
              </tr>
              <tr>
                <th scope="row">Description</th>
                <td>{{e($permission->description)}}</td>
              </tr>
              <tr>
                <th scope="row">Type</th>
                <td>{{e($permission->type)}}</td>
              </tr>
              <tr>
                <th scope="row">Active</th>
                <td>{{ $permission->is_active ? __('active') : __('inactive') }}</td>
              </tr>
              <tr>
                <th scope="row">Created at</th>
                <td>{{ $permission->created_at ? $permission->created_at->format('d/m/Y H:i') : '-' }}</td>
              </tr>
              <tr>
                <th scope="row">Last Updated at</th>
                <td>{{ $permission->updated_at ? $permission->updated_at->format('d/m/Y H:i') : '-' }}</td>
              </tr>
            </tbody>
          </table>
    </x-admin::card>

    @can('delete', $permission)
    <x-admin::modal-delete
        :action="route('admin/permissions/destroy', ['permission' => $permission->id])"
        :id="'destroy-modal'"
        >
        <h4 class="text-center">Are you sure want delete permissions "{{$permission->permission}}"?</h4>
    </x-admin::modal-delete>
    @endcan
</x-admin::app-layout>

