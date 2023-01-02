@section('title', 'Permission - List')

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
            <button type="button" class="btn btn-warning font-weight-bold" data-toggle="modal" data-target="#generate-modal">Generate</button>
            <button type="button" class="btn btn-info font-weight-bold" data-toggle="modal" data-target="#apply-change-modal">Apply Change</button>
            <a href="{{route('admin/permissions/create')}}" class="btn btn-primary text-right font-weight-bold">Create Permission</a>
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
                        <th data-data="action" data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </x-admin::card>

    <x-admin::modal :id="'generate-modal'">
        <h4 class="text-center">Are you sure want generate permissions?</h4>
        <x-slot:footer>
            <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
            <form action="{{route('admin/permissions/generate')}}" method="post">
                @method('put')
                @csrf
                <button type="submit" class="btn btn-warning font-weight-bold">Generate</button>
            </form>
        </x-slot:footer>
    </x-admin::modal>

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
