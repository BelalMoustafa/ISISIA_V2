<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ !empty($metaTitle) ? $metaTitle : $header_title }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Handmade beaded bags that speak your style. Discover the art of detail with ISISIA' }}">
    <meta name="keywords" content="{{ $metaKeys ?? 'beaded,bags,woman' }}">
    <link rel="icon" type="image/x-icon" href="{{ url('assets/images/Logo.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
    @yield('style')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.layout.header')
        @yield('content')
        @include('admin.layout.footer')
    </div>
    <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ url('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ url('assets/dist/js/demo.js') }}"></script>
    @yield('script')
</body>

</html>
