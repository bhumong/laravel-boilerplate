@section('title', 'Role')

@section('page_level_js')
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
                <td>{{ $role->active ? __('active') : __('inactive') }}</td>
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
        <h1>test</h1>
    </x-admin::card>

    <x-admin::modal-delete
        :action="route('admin/roles/destroy', ['role' => $role->id])"
        :id="'destroy-modal'"
        >
        <h4 class="text-center">Are you sure want delete role "{{$role->title}}"?</h4>
    </x-admin::modal-delete>
</x-admin::app-layout>

