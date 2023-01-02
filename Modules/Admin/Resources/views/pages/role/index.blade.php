@section('title', 'Role - List')

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
            'label' => 'Role List',
            'active' => true,
        ],
    ]">
        <x-slot:title>
            Roles
        </x-slot>
    </x-admin::breadcrumbs>
    <x-admin::card>
        <div class="text-right">
            <button type="button" class="btn btn-warning font-weight-bold" data-toggle="modal" data-target="#apply-change-modal">Apply Change</button>

            <a href="{{route('admin/roles/create')}}" class="btn btn-primary text-right font-weight-bold">Create Role</a>
        </div>
        <br>
        <div class="responsive-table">
            <table id="role-list-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th data-data="title">Title</th>
                        <th data-data="is_active">Status</th>
                        <th data-data="created_at">Created At</th>
                        <th data-data="action" data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </x-admin::card>

    <x-admin::modal :id="'apply-change-modal'">
        <h4 class="text-center">Are you sure want apply change roles and permissions?</h4>
        <x-slot:footer>
            <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
            <form action="{{route('admin/roles/applyChange')}}" method="post">
                @method('put')
                @csrf
                <button type="submit" class="btn btn-warning font-weight-bold">Apply</button>
            </form>
        </x-slot:footer>
    </x-admin::modal>

</x-admin::app-layout>
