@section('title', 'Role')

@section('page_level_js')
<script type="module">
$(document).ready(function () {
    var $roleTable = $("#role-list-datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin/roles/indexData') }}",
        lengthMenu: [20, 50, 100],
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
            'label' => 'User List',
            'active' => true,
        ],
    ]">
        <x-slot:title>
            Roles
        </x-slot>
    </x-admin::breadcrumbs>
    <x-admin::card>
        <div class="text-right">
            <a href="{{route('admin/roles/create')}}" class="btn btn-primary text-right">Create Role</a>
        </div>
        <br>
        <div class="responsive-table">
            <table id="role-list-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th data-data="title">Title</th>
                        <th data-data="is_active">Status</th>
                        <th data-data="created_at">Created At</th>
                        <th data-data="action" data-orderable="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </x-admin::card>
</x-admin::app-layout>
