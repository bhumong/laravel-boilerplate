@section('title', 'Permission - Detail')

@section('page_level_js')
<script type="module">

</script>
@endsection

<x-admin::app-layout>
    <x-admin::breadcrumbs :items="[
        [
            'link' => route('admin/dashboard'),
            'label' => 'Home',
        ],
        [
            'link' => route('admin/permissions/index'),
            'label' => 'Permission List',
        ],
        [
            'label' => 'Detail',
            'active' => true,
        ],
    ]">
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
                    <a href="{{route('admin/permissions/edit', ['permission' => $permission->id])}}" class="btn btn-warning font-weight-bold">Edit</a>
                    <button type="button" class="btn btn-danger font-weight-bold" data-toggle="modal" data-target="#destroy-modal">Delete</button>
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
                <td>{{ $permission->created_at->format('d/m/Y H:i') }}</td>
              </tr>
              <tr>
                <th scope="row">Last Updated at</th>
                <td>{{ $permission->updated_at->format('d/m/Y H:i') }}</td>
              </tr>
            </tbody>
          </table>
    </x-admin::card>

    <x-admin::modal-delete
        :action="route('admin/permissions/destroy', ['permission' => $permission->id])"
        :id="'destroy-modal'"
        >
        <h4 class="text-center">Are you sure want delete permissions "{{$permission->permission}}"?</h4>
    </x-admin::modal-delete>
</x-admin::app-layout>

