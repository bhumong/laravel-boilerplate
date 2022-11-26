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

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('admin/doLogin') }}" method="post">
                    @csrf
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
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">Remember Me</label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    @vite(['resources/js/app.js', 'Modules/Admin/Resources/assets/js/app.js'])
    @yield('page_vendor_js')
    @yield('page_level_js')
</body>

</html>