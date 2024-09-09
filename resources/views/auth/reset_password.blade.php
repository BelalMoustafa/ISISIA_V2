<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISISIA | Reset Password</title>
    <link rel="icon" type="image/x-icon" href="{{url('assets/images/Logo.png')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{url('assets/images/Logo.png')}}" alt="MainLogo" class="logo">
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Write the new password</p>
                @include('admin.layout.message')
                <form action="{{ route('password.reset') }}" method="post">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('password_reset_email') }}">
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="New Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{url('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/dist/js/adminlte.min.js')}}"></script>
</body>

</html>
