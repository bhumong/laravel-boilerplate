@section('title', 'Permission - List')

@section('page_level_js')
<script type="module">
$(document).ready(function () {
    const $roleTable = $("#permission-list-datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin/permissions/indexData') }}",
        lengthMenu: [10, 20, 50, 100],
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
            Permissions
        </x-slot>
    </x-admin::breadcrumbs>

    <x-admin::card>
        <div class="text-right">
            @can('generate', Modules\Admin\Entities\Permission::class)
            <button type="button" class="btn btn-warning font-weight-bold" data-toggle="modal" data-target="#generate-modal">Generate</button>
            @endcan

            @can('applyChange', Modules\Admin\Entities\Role::class)
            <button type="button" class="btn btn-info font-weight-bold" data-toggle="modal" data-target="#apply-change-modal">Apply Change</button>
            @endcan

            @can('create', Modules\Admin\Entities\Permission::class)
            <a href="{{route('admin/permissions/create')}}" class="btn btn-primary text-right font-weight-bold">Create Permission</a>
            @endcan
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

    @can('generate', Modules\Admin\Entities\Permission::class)
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
    @endcan

    @can('applyChange', Modules\Admin\Entities\Role::class)
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
    @endcan

</x-admin::app-layout>
