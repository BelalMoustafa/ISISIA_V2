<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .error-content{
            background-image: url('{{ asset('assets/images/error-bg.jpg') }}') !important;
        }
    </style>
    <title>ISISIA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{url('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/dist/css/style.css')}}">
</head>
<body>
    <div class="page-wrapper">
        <main class="main">
            <div class="error-content text-center">
                <div class="container">
                    <h1 class="error-title">Error 404</h1>
                    <p>We are sorry, the page you've requested is not available.</p>
                    <a href="{{route('main')}}" class="btn btn-outline-primary-2 btn-minwidth-lg">
                        <span>BACK TO HOMEPAGE</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
