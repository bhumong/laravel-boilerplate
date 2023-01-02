@section('title', 'User - List')

@section('page_level_js')
<script type="module">
$(document).ready(function () {
    var $usersTable = $("#user-list-datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin/users/indexData') }}",
        lengthMenu: [20, 50, 100],
    });

    $('#user-list-filter').on('click', function() {
        var filter = {
            role: $("#user-list-role").val(),
        };
        // from admin::partials.dataTableHelper
        filterDataTable($usersTable, filter);
    });

    $('#user-list-reset').on('click', function() {
        $("#user-list-role").val('').formSelect();
        $('#user-list-filter').click();
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
            Users
        </x-slot>
    </x-admin::breadcrumbs>
    <x-admin::card>
        <div class="text-right">
            <a href="{{route('admin/users/create')}}" class="btn btn-primary text-right font-weight-bold">Create User</a>
        </div>
        <br>
        <div class="responsive-table">
            <table id="user-list-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th data-data="name">Name</th>
                        <th data-data="email">Email</th>
                        <th data-data="role" data-orderable="false">Role</th>
                        <th data-data="action" data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </x-admin::card>
</x-admin::app-layout>
