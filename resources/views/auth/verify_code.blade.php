<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISISIA | Verify Code</title>
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
                <p class="login-box-msg">Verify Your Code</p>
                @include('admin.layout.message')
                <form action="{{ route('password.verifyCode') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" id="email" name="email" value="{{ session('password_reset_email') }}" readonly>
                        <div class="form-group">
                            <label for="code">Enter Verification Code</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter the code sent to your email" required>
                        </div>
                    <button type="submit" class="btn btn-primary">Verify</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{url('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/dist/js/adminlte.min.js')}}"></script>
</body>

</html>
