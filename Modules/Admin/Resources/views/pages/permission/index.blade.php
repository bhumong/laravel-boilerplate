@section('title', 'Permission')

@section('page_level_js')
<script type="module">
$(document).ready(function () {
    const $roleTable = $("#permission-list-datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin/permissions/indexData') }}",
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
            'label' => 'Permission List',
            'active' => true,
        ],
    ]">
        <x-slot:title>
            Roles
        </x-slot>
    </x-admin::breadcrumbs>
    <x-admin::card>
        <div class="text-right">
            <a href="{{route('admin/permissions/create')}}" class="btn btn-primary text-right">Create Permission</a>
        </div>
        <br>
        <div class="responsive-table">
            <table id="permission-list-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th data-data="permission">Permission</th>
                        <th data-data="is_active">Status</th>
                        <th data-data="roles" data-orderable="false">Roles</th>
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
