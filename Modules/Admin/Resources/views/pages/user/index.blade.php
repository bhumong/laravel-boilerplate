@section('title', 'User')

<x-admin::app-layout>
    <x-admin::breadcrumbs :items="[
        [
            'link' => route('admin/dashboard'),
            'label' => 'Home',
        ],
        [
            'label' => 'Users',
            'active' => true,
        ],
    ]">
        <x-slot:title>
            Users
        </x-slot>
    </x-admin::breadcrumbs>
    <x-admin::card>
        <div class="responsive-table">
            <table id="user-list-datatable" class="table">
                <thead>
                    <tr>
                        <th data-data="name">Name</th>
                        <th data-data="email">Email</th>
                        <th data-data="role">Role</th>
                        <th data-data="action" data-orderable="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </x-admin::card>
</x-admin::app-layout>
<script type="module">
$(document).ready(function () {

    var $usersTable = $("#user-list-datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin/users/index') }}",
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