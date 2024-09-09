@extends('client.layout.app')
@section('content')
            <div class="container">
                <div class="page-header page-header-big text-center"
                    style="background-image: url('{{ asset('assets/images/logo.jpg') }}')">
                    <h1 class="page-title text-white">About us<span class="text-white">Who we are</span></h1>
                </div>
            </div>
            <div class="page-content pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 mb-3 mb-lg-0">
                                <h2 class="title">Who We Are</h2>
                                <p class="mb-2">Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales
                                    leo, eget blandit nunc tortor eu nibh. Suspendisse potenti. Sed egestas, ante et
                                    vulputate volutpat, uctus metus libero eu augue. </p>
                        </div>
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <h2 class="title">Our Vision</h2>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit.
                                Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel,
                                nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget
                                blandit nunc tortor eu nibh. </p>
                        </div>
                        <div class="col-lg-4">
                            <h2 class="title">Our Mission</h2>
                            <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero
                                eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed
                                lectus. <br>Praesent elementum hendrerit tortor. Sed semper lorem at felis. </p>
                        </div>
                    </div>
                    <div class="mb-5"></div>
                </div>
            </div>
@endsection
