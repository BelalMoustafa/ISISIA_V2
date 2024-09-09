@extends('client.layout.app')

@section('style')
    <style>
        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                <h1 class="page-title">Shop</h1>
            </div>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox"></div>
                        <div class="products mb-3">
                            <div class="row justify-content-center">
                                @forelse($products as $product)
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                <a href="{{ route('product.detail', $product->id) }}">
                                                    <img src="{{ url('storage/products/' . $product->image) }}"
                                                        alt="Product image" class="product-image">
                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-expandable far fa-heart add-to-wishlist"
                                                        data-product-id="{{ $product->id }}"><span>Add to
                                                            wishlist</span></a>
                                                </div>
                                                <div class="product-action">
                                                    <a href="#"
                                                        class="btn-product add-to-cart"data-product-id="{{ $product->id }}"><span>add
                                                            to cart</span></a>
                                                </div>
                                            </figure>
                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a
                                                        href="#">{{ optional($product->category)->name ?? 'No Category' }}</a>
                                                </div>
                                                <h3 class="product-title"><a href="product.html">{{ $product->title }}</a>
                                                </h3>
                                                <div class="product-price">
                                                    EGP {{ $product->price }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <h3>No products found.</h3>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        @if ($products->hasPages())
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    @if ($products->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link page-link-prev" href="#" aria-label="Previous"
                                                tabindex="-1" aria-disabled="true">
                                                <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link page-link-prev" href="{{ $products->previousPageUrl() }}"
                                                aria-label="Previous">
                                                <span aria-hidden="true"><i
                                                        class="fa-sharp fas fa-arrow-left"></i></span>Prev
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        @if ($page == $products->currentPage())
                                            <li class="page-item active" aria-current="page"><a class="page-link"
                                                    href="#">{{ $page }}</a></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    <li class="page-item-total">of {{ $products->lastPage() }}</li>

                                    @if ($products->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link page-link-next" href="{{ $products->nextPageUrl() }}"
                                                aria-label="Next">
                                                Next <span aria-hidden="true"><i
                                                        class="fa-sharp fas fa-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <a class="page-link page-link-next" href="#" aria-label="Next"
                                                tabindex="-1" aria-disabled="true">
                                                Next <span aria-hidden="true"><i
                                                        class="fa-sharp fas fa-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>

                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean"></div>
                            <div class="widget">
                                <h3 class="widget-title"><a>Category</a></h3>
                                <div class="show">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            @forelse($categories as $category)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="cat-{{ $category->id }}" value="{{ $category->id }}"
                                                            onchange="filterProducts()">
                                                        <label class="custom-control-label"
                                                            for="cat-{{ $category->id }}">{{ $category->name }}</label>
                                                    </div>
                                                    <span class="item-count">{{ $category->products_count }}</span>
                                                </div>
                                            @empty
                                                <p>No categories available.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        function filterProducts() {
            var checkedCategories = [];
            document.querySelectorAll('input[type="checkbox"]:checked').forEach(function(checkbox) {
                checkedCategories.push(checkbox.value);
            });
            var url = new URL(window.location.href);
            url.searchParams.set('categories', checkedCategories.join(','));
            window.location.href = url.href;
        }
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
