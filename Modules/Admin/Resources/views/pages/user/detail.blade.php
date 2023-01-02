@section('title', 'User - Detail')

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
            'link' => route('admin/users/index'),
            'label' => 'User List',
        ],
        [
            'label' => 'Detail',
            'active' => true,
        ],
    ]">
        <x-slot:title>
            Detail User
        </x-slot>
    </x-admin::breadcrumbs>

    <x-admin::card>
        <div class="row">
            <div class="col text-left">
                <h5>
                    Name: {{$user->name}}
                </h5>
                <h6>
                    ID: {{$user->id}}
                </h6>
            </div>
            <div class="col">
                <div class="container text-right">
                    <a href="{{route('admin/users/edit', ['user' => $user->id])}}" class="btn btn-warning font-weight-bold">Edit</a>
                    <button type="button" class="btn btn-danger font-weight-bold" data-toggle="modal" data-target="#destroy-modal">Delete</button>
                </div>
            </div>
        </div>
    </x-admin::card>

    <x-admin::card :title="'Detail'">
        <table class="table table-striped">
            <tbody>
              <tr>
                <th scope="row">Name</th>
                <td>{{$user->name}}</td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td>{{$user->email}}</td>
              </tr>
              <tr>
                <th scope="row">Verified</th>
                <td>{{ empty($user->email_verified_at) ? __('no') : __('yes') }}</td>
              </tr>
              <tr>
                <th scope="row">Superuser</th>
                <td>{{ empty($user->is_superuser) ? __('no') : __('yes') }}</td>
              </tr>
              <tr>
                <th scope="row">Role</th>
                <td>{{ $user->role->title ?? '' }}</td>
              </tr>
              <tr>
                <th scope="row">Created at</th>
                <td>{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : '-' }}</td>
              </tr>
              <tr>
                <th scope="row">Last Updated at</th>
                <td>{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : '-' }}</td>
              </tr>
            </tbody>
          </table>
    </x-admin::card>

    <x-admin::modal-delete
        :action="route('admin/users/destroy', ['user' => $user->id])"
        :id="'destroy-modal'"
        >
        <h4 class="text-center">Are you sure want delete permissions "{{$user->name}}"?</h4>
    </x-admin::modal-delete>
</x-admin::app-layout>

