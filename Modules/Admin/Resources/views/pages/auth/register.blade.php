<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'Modules/Admin/Resources/assets/css/app.css'])
    @yield('page_vendor_css')
    @yield('page_level_css')
</head>


<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="{{ route('admin/doRegister') }}" method="post">
            @csrf
          <div class="input-group mb-3">
            <x-admin::form.input-text-icon-append
                :name="'name'"
                :placeholder="'Fullname'"
                :value="old('name')"
                :icon="'bi bi-people'"
            />
          </div>
          <div class="input-group mb-3">
            <x-admin::form.input-text-icon-append
                :name="'email'"
                :placeholder="'Email'"
                :value="old('email')"
                :icon="'bi bi-envelope'"
            />
          </div>
          <div class="input-group mb-3">
            <x-admin::form.input-text-icon-append
                :name="'password'"
                :placeholder="'Password'"
                :icon="'bi bi-lock'"
                :type="'password'"
            />
          </div>
          <div class="input-group mb-3">
            <x-admin::form.input-text-icon-append
                :name="'password_confirmation'"
                :placeholder="'Password Confirm'"
                :icon="'bi bi-lock'"
                :type="'password'"
            />
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-8">
                <a href="{{ route('admin/login') }}" class="text-right">Login</a>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
    @vite(['resources/js/app.js', 'Modules/Admin/Resources/assets/js/app.js'])
    @yield('page_vendor_js')
    @yield('page_level_js')
</body>


</html>