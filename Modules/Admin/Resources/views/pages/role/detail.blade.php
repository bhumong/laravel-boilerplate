@section('title', 'Role')

@section('page_level_js')

<x-admin::script.dataTableHelper />

<script type="module">

$(document).ready(function () {
    const $permissionTable = $("#permission-list-datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin/permissions/indexData') }}",
        lengthMenu: [20, 50, 100],
    });

    const roleId = "{{$role->id}}";
    filterDataTable($permissionTable, {
        roles: roleId
    });
});
</script>
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
            'label' => 'Detail',
            'active' => true,
        ],
    ]">
        <x-slot:title>
            Detail Role
        </x-slot>
    </x-admin::breadcrumbs>

    <x-admin::card>
        <div class="row">
            <div class="col text-left">
                <h5>
                    Title: {{$role->title}}
                </h5>
                <h6>
                    ID: {{$role->id}}
                </h6>
            </div>
            <div class="col">
                <div class="container text-right">
                    <a href="{{route('admin/roles/edit', ['role' => $role->id])}}" class="btn btn-warning font-weight-bold">Edit</a>
                    <button type="button" class="btn btn-danger font-weight-bold" data-toggle="modal" data-target="#destroy-modal">Delete</button>

                </div>
            </div>
        </div>
    </x-admin::card>

    <x-admin::card :title="'Detail'">
        <table class="table table-striped">
            <tbody>
              <tr>
                <th scope="row">Title</th>
                <td>{{$role->title}}</td>
              </tr>
              <tr>
                <th scope="row">Description</th>
                <td>{{e($role->description)}}</td>
              </tr>
              <tr>
                <th scope="row">Active</th>
                <td>{{ $role->is_active ? __('active') : __('inactive') }}</td>
              </tr>
              <tr>
                <th scope="row">Created at</th>
                <td>{{ $role->created_at->format('Yd/m/y H:i') }}</td>
              </tr>
              <tr>
                <th scope="row">Last Updated at</th>
                <td>{{ $role->updated_at->format('Yd/m/y H:i') }}</td>
              </tr>
            </tbody>
          </table>
    </x-admin::card>

    <x-admin::card :title="'Permissions'">
        <div class="responsive-table">
            <table id="permission-list-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th data-data="permission">Permission</th>
                        <th data-data="is_active">Status</th>
                        <th data-data="created_at">Created At</th>
                        <th data-data="roles" data-visible="false">Roles</th>
                        <th data-data="action" data-orderable="false" data-visible="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </x-admin::card>

    <x-admin::modal-delete
        :action="route('admin/roles/destroy', ['role' => $role->id])"
        :id="'destroy-modal'"
        >
        <h4 class="text-center">Are you sure want delete role "{{$role->title}}"?</h4>
    </x-admin::modal-delete>
</x-admin::app-layout>

