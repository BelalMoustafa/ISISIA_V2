<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ !empty($metaTitle) ? $metaTitle : $header_title }}</title>
    <meta name="description"
        content="{{ $metaDescription ?? 'Handmade beaded bags that speak your style. Discover the art of detail with ISISIA' }}">
    <meta name="keywords" content="{{ $metaKeys ?? 'beaded,bags,woman' }}">
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets/images/Logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('assets/images/Logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/images/Logo.png') }}">
    <meta name="apple-mobile-web-app-title" content="ISISIA">
    <meta name="application-name" content="ISISIA">
    <meta name="msapplication-TileColor" content="#b79378">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ url('assets/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/css/plugins/jquery.countdown.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/css/skins/skin-demo-2.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/css/demos/demo-2.css') }}">
    @yield('style')
</head>

<body>
    <div class="page-wrapper">
        @include('client.layout.header')
        @yield('content')
        @include('client.layout.footer')
    </div>
    @include('client.layout.mobile_header')
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ url('assets/js/superfish.min.js') }}"></script>
    <script src="{{ url('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>
    <script src="{{ url('assets/js/demos/demo-2.js') }}"></script>
    @yield('script')
</body>

</html>
