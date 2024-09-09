@extends('client.layout.app')
@section('style')
    <style>
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection

@section('content')
    <main class="main">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {{ session('success') }}
            </div>
        @endif
        <div class="intro-slider-container">
            <div class="owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl"
                data-owl-options='{"nav": false}'>
                <div class="intro-slide" style="background-image: url('{{ asset('assets/images/logo.jpg') }}');">
                    <div class="container intro-content">
                        <h3 class="intro-subtitle">Bedroom Furniture</h3>
                        <h1 class="intro-title">Find Comfort <br>That Suits You.</h1>
                        @if (session('logged_in'))
                            <a href="{{route('shop')}}" class="btn btn-primary">
                                <span>Shop Now</span>
                                <i class="fa-sharp fas fa-arrow-right"></i>
                            </a>
                        @endif
                        @if (!session('logged_in'))
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <span>Login to Shop</span>
                                <i class="fa-sharp fas fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="intro-slide" style="background-image: url('{{ asset('assets/images/logo.jpg') }}');">
                    <div class="container intro-content">
                        <h3 class="intro-subtitle">Deals and Promotions</h3>
                        <h1 class="intro-title">Ypperlig <br>Coffee Table <br><span
                                class="text-primary"><sup>$</sup>49,99</span></h1>
                        @if (session('logged_in'))
                            <a href="{{route('shop')}}" class="btn btn-primary">
                                <span>Shop Now</span>
                                <i class="fa-sharp fas fa-arrow-right"></i>
                            </a>
                        @endif
                        @if (!session('logged_in'))
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <span>Login to Shop</span>
                                <i class="fa-sharp fas fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="intro-slide" style="background-image: url('{{ asset('assets/images/logo.jpg') }}');">
                    <div class="container intro-content">
                        <h3 class="intro-subtitle">Living Room</h3>
                        <h1 class="intro-title">
                            Make Your Living Room <br>Work For You.<br>
                            <span class="text-primary">
                                <sup class="text-white font-weight-light">from</sup><sup>$</sup>9,99
                            </span>
                        </h1>
                        @if (session('logged_in'))
                            <a href="{{route('shop')}}" class="btn btn-primary">
                                <span>Shop Now</span>
                                <i class="fa-sharp fas fa-arrow-right"></i>
                            </a>
                        @endif
                        @if (!session('logged_in'))
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <span>Login to Shop</span>
                                <i class="fa-sharp fas fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <span class="slider-loader text-white"></span>
        </div>
        <div class="mb-6"></div>
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
        <div class="mb-7"></div>
        <div class="container">
            <div class="heading heading-center mb-3">
                <h2 class="title">Our Products</h2>
                <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab"
                            aria-controls="top-all-tab" aria-selected="true">All</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" id="top-cat-link-{{ $category->id }}" data-toggle="tab"
                                href="#top-cat-tab-{{ $category->id }}" role="tab"
                                aria-controls="top-cat-tab-{{ $category->id }}"
                                aria-selected="false">{{ $category->name }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" id="top-top-link" data-toggle="tab" href="#top-top-tab" role="tab"
                            aria-controls="top-top-tab" aria-selected="false">Top Selling</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                    <div class="products">
                        <div class="row justify-content-center">
                            @if (count($products) > 0)
                                @foreach ($products as $product)
                                    <div class="col-12 col-md-4 col-lg-3 col-xl-5col">
                                        <div class="product product-11 text-center">
                                            <figure class="product-media">
                                                <a href="{{ route('product.detail', $product->id) }}">
                                                    <img src="{{ url('storage/products/' . $product->image) }}"
                                                        alt="Product image" class="product-image">
                                                </a>
                                                @if (session('logged_in'))
                                                    <div class="product-action-vertical">
                                                        <a href="#"
                                                            class="btn-expandable far fa-heart add-to-wishlist"
                                                            data-product-id="{{ $product->id }}"><span>Add to
                                                                wishlist</span></a>
                                                    </div>
                                                @endif
                                                @if (!session('logged_in'))
                                                    <div class="product-action-vertical">
                                                        <a href="{{ route('login') }}" class="btn-product-icon"><i
                                                                class="fas fa-heart"></i><span>add to
                                                                wishlist</span></a>
                                                    </div>
                                                @endif
                                            </figure>
                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">{{ optional($product->category)->name }}</a>
                                                </div>
                                                <h3 class="product-title"><a
                                                        href="{{ route('product.detail', $product->id) }}">{{ $product->title }}</a>
                                                </h3>
                                                <div class="product-price">
                                                    {{ $product->price }}
                                                </div>
                                            </div>
                                            @if (session('logged_in'))
                                                <div class="product-action">
                                                    <a href="#" class="btn-product add-to-cart"
                                                        data-product-id="{{ $product->id }}"><img
                                                            src="{{ url('assets/images/shopping-cart.png') }}"
                                                            alt="" width="60" height="60"
                                                            style="padding-right: 30px"> <span>add to cart</span></a>
                                                </div>
                                            @endif
                                            @if (!session('logged_in'))
                                                <div class="product-action">
                                                    <a href="{{ route('login') }}" class="btn-product"><img
                                                            src="{{ url('assets/images/shopping-cart.png') }}"
                                                            alt="" width="60" height="60"
                                                            style="padding-right: 30px"> <span>add to cart</span></a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <div class="text-center" style="padding-left: 35%">
                                        <h4>No products to display now.</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @foreach ($categories as $category)
                    <div class="tab-pane p-0 fade" id="top-cat-tab-{{ $category->id }}" role="tabpanel"
                        aria-labelledby="top-cat-link-{{ $category->id }}">
                        <div class="products">
                            <div class="row justify-content-center">
                                @if (count($category->products) > 0)
                                    @foreach ($category->products as $product)
                                        <div class="col-12 col-md-4 col-lg-3 col-xl-5col">
                                            <div class="product product-11 text-center">
                                                <figure class="product-media">
                                                    <a href="{{ route('product.detail', $product->id) }}">
                                                        <img src="{{ url('storage/products/' . $product->image) }}"
                                                            alt="Product image" class="product-image">
                                                    </a>
                                                    @if (session('logged_in'))
                                                        <div class="product-action-vertical">
                                                            <a href="#"
                                                                class="btn-expandable far fa-heart add-to-wishlist"
                                                                data-product-id="{{ $product->id }}"><span>Add to
                                                                    wishlist</span></a>
                                                        </div>
                                                    @endif
                                                    @if (!session('logged_in'))
                                                        <div class="product-action-vertical">
                                                            <a href="{{ route('login') }}" class="btn-product-icon"><i
                                                                    class="fas fa-heart"></i><span>add to
                                                                    wishlist</span></a>
                                                        </div>
                                                    @endif
                                                </figure>
                                                <div class="product-body">
                                                    <div class="product-cat">
                                                        <a href="#">{{ optional($product->category)->name }}</a>
                                                    </div>
                                                    <h3 class="product-title"><a
                                                            href="{{ route('product.detail', $product->id) }}">{{ $product->title }}</a>
                                                    </h3>
                                                    <div class="product-price">
                                                        {{ $product->price }}
                                                    </div>
                                                </div>
                                                @if (session('logged_in'))
                                                    <div class="product-action">
                                                        <a href="#" class="btn-product add-to-cart"
                                                            data-product-id="{{ $product->id }}"><img
                                                                src="{{ url('assets/images/shopping-cart.png') }}"
                                                                alt="" width="60" height="60"
                                                                style="padding-right: 30px"> <span>add to cart</span></a>
                                                    </div>
                                                @endif
                                                @if (!session('logged_in'))
                                                    <div class="product-action">
                                                        <a href="{{ route('login') }}" class="btn-product"><img
                                                                src="{{ url('assets/images/shopping-cart.png') }}"
                                                                alt="" width="60" height="60"
                                                                style="padding-right: 30px"> <span>add to cart</span></a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="text-center" style="padding-left: 35%">
                                            <h4>No products to display now.</h4>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="tab-pane p-0 fade" id="top-top-tab" role="tabpanel" aria-labelledby="top-top-link">
                    <div class="products">
                        <div class="row justify-content-center">
                            @if (count($topSellingProducts) > 0)
                                @foreach ($topSellingProducts as $product)
                                    <div class="col-12 col-md-4 col-lg-3 col-xl-5col">
                                        <div class="product product-11 text-center">
                                            <figure class="product-media">
                                                <a href="{{ route('product.detail', $product->id) }}">
                                                    <img src="{{ url('storage/products/' . $product->image) }}"
                                                        alt="Product image" class="product-image">
                                                </a>
                                                @if (session('logged_in'))
                                                    <div class="product-action-vertical">
                                                        <a href="#"
                                                            class="btn-expandable far fa-heart add-to-wishlist"
                                                            data-product-id="{{ $product->id }}"><span>Add to
                                                                wishlist</span></a>
                                                    </div>
                                                @endif
                                                @if (!session('logged_in'))
                                                    <div class="product-action-vertical">
                                                        <a href="{{ route('login') }}" class="btn-product-icon"><i
                                                                class="fas fa-heart"></i><span>add to
                                                                wishlist</span></a>
                                                    </div>
                                                @endif
                                            </figure>
                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">{{ optional($product->category)->name }}</a>
                                                </div>
                                                <h3 class="product-title"><a
                                                        href="{{ route('product.detail', $product->id) }}">{{ $product->title }}</a>
                                                </h3>
                                                <div class="product-price">
                                                    {{ $product->price }}
                                                </div>
                                            </div>
                                            @if (session('logged_in'))
                                                <div class="product-action">
                                                    <a href="#" class="btn-product add-to-cart"
                                                        data-product-id="{{ $product->id }}"><img
                                                            src="{{ url('assets/images/shopping-cart.png') }}"
                                                            alt="" width="60" height="60"
                                                            style="padding-right: 30px"> <span>add to cart</span></a>
                                                </div>
                                            @endif
                                            @if (!session('logged_in'))
                                                <div class="product-action">
                                                    <a href="{{ route('login') }}" class="btn-product"><img
                                                            src="{{ url('assets/images/shopping-cart.png') }}"
                                                            alt="" width="60" height="60"
                                                            style="padding-right: 30px"> <span>add to cart</span></a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <div class="text-center" style="padding-left: 35%">
                                        <h4>No products to display now.</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <hr class="mt-1 mb-6">
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.add-to-cart').click(function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                var quantity = $('#qty').val();
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: "POST",
                    data: {
                        product_id: productId,
                        quantity: quantity,
                        _token: "{{ csrf_token() }}"
                    },
                    error: function(response) {
                        var errorMessage = response.responseJSON.message ||
                            "An error occurred. Please try again.";
                        alert(errorMessage);
                    }
                });
            });
        });
                $(document).ready(function() {
            $('.add-to-wishlist').click(function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');

                $.ajax({
                    url: "{{ route('wishlist.add') }}",
                    type: "POST",
                    data: {
                        product_id: productId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(response) {
                        var errorMessage = response.responseJSON.message ||
                            "An error occurred. Please try again.";
                        alert(errorMessage);
                    }
                });
            });
        });
    </script>
@endsection
