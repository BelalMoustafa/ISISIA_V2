@extends('client.layout.app')

@section('style')
    <style>
        #product-zoom {
            width: 100%;
            height: 350px;
            background-position: center center;
            background-size: cover;
            transition: transform 0.3s ease-in-out;
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-2">
            <div id="successAlert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <span id="successMessage"></span>
            </div>
        </nav>
        <div class="page-content">
            <h1>{{ session('success') }}</h1>
            <div class="container">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="product-gallery product-gallery-vertical">
                                <div class="row">
                                    <figure class="product-main-image">
                                        <img id="product-zoom" src="{{ url('storage/products/' . $product->image) }}"
                                            data-zoom-image="{{ url('storage/products/' . $product->image) }}"
                                            alt="{{ $product->title }}">
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{ $product->title }}</h1>
                                <div class="product-content">
                                    <p>{{ $product->Discription }} </p>
                                </div>
                                <div class="product-price">
                                    EGP {{ $product->price }}
                                </div>
                                <div class="product-content">
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="qty" class="form-control" value="1"
                                            min="1" max="10" step="1" data-decimals="0" required>
                                    </div>
                                </div>
                                <div class="product-details-action">
                                    <a href="#" class="btn btn-primary add-to-cart"
                                        data-product-id="{{ $product->id }}" data-product-title="{{ $product->title }}"
                                        data-product-price="{{ $product->price }}">
                                        <span>Add To Cart</span>
                                    </a>
                                    <div class="details-action-wrapper">
                                        <a href="#" class="far fa-heart add-to-wishlist"
                                            data-product-id="{{ $product->id }}" title="Wishlist">
                                            <span>Add to Wishlist</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Category:</span>
                                        <span>{{ optional($product->category)->name ?? 'No Category' }}</span>
                                    </div>
                                    <div class="social-icons social-icons-sm">
                                        <a href="https://www.facebook.com/profile.php?id=61564877156777" class="social-icon" title="Facebook" target="_blank"><i
                                                class="fab fa-facebook"></i></a>
                                        <a href="https://www.instagram.com/isisia.brand/" class="social-icon" title="Instagram" target="_blank"><i
                                                class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            var title = $(this).data('product-title');
            var price = $(this).data('product-price');
            $.ajax({
                url: "{{ route('cart.add') }}",
                type: "POST",
                data: {
                    product_id: productId,
                    quantity: quantity,
                    title: title,
                    price: price,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        sessionStorage.setItem('success', response.message);
                        showSuccessAlert();
                    }
                },
            });
        });
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
                    alert(response.responseJSON.message || "An error occurred. Please try again.");
                }
            });
        });

        function showSuccessAlert() {
            var successMessage = sessionStorage.getItem('success');
            if (successMessage) {
                $('#successAlert').html(successMessage);
                $('#successAlert').show();
                sessionStorage.removeItem('success');
            }
        }
    });
</script>
@endsection
