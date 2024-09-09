@extends('client.layout.app')

@section('style')
    <style>
.btn-quantity-increase,
.btn-quantity-decrease {
    border: none;
    border-radius: 4px;
    padding: 4px 8px;
    background-color: #f0f0f0;
    cursor: pointer;
    transition: background-color 0.2s ease;
    font-size: 14px;
}

.btn-quantity-increase:hover,
.btn-quantity-decrease:hover {
    background-color: #ddd;
}

.quantity-input {
    width: 40px;
    text-align: center;
    border: none;
    border-radius: 4px;
    padding: 4px;
    margin: 0 6px;
}

.quantity-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 4px 8px;
}

@media (max-width: 768px) {
    .quantity-wrapper {
        font-size: 12px;
    }

    .quantity-input {
        width: 35px;
    }
}
    </style>
@endsection

@section('content')
    <main class="main">
        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($cartItems as $item)
                                        <tr>
                                            <td class="product-col">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="{{ route('product.detail', $item->product->id) }}">
                                                            <img src="{{ url('storage/products/' . $item->product->image) }}"
                                                                alt="Product image">
                                                        </a>
                                                    </figure>

                                                    <h3 class="product-title">
                                                        <a
                                                            href="{{ route('product.detail', $item->product->id) }}">{{ $item->product->title }}</a>
                                                    </h3>
                                                </div>
                                            </td>
                                            <td class="price-col">{{ $item->product->price }}</td>
                                            <td class="quantity-col">
                                                <div class="quantity-wrapper">
                                                    <button class="btn-quantity-decrease"
                                                        data-cart-item-id="{{ $item->id }}">-</button>
                                                    <input type="number" class="quantity-input"
                                                        value="{{ $item->quantity }}" min="1" readonly>
                                                    <button class="btn-quantity-increase"
                                                        data-cart-item-id="{{ $item->id }}">+</button>
                                                </div>
                                            </td>
                                            <td class="total-col">{{ $item->quantity * $item->product->price }}</td>
                                            <td class="remove-col">
                                                <button class="btn-remove" data-cart-item-id="{{ $item->id }}">
                                                    <B>X</B>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Your cart is empty.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="cart-bottom">
                                <a href="{{ route('shop') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE
                                        SHOPPING</span></a>
                            </div>
                        </div>
                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Cart Total</h3>
                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-shipping">
                                            <td>ITEMS:</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        @foreach ($cartItems as $item)
                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <label class="custom-control-label"
                                                            for="standart-shipping">{{ $item->product->title }}</label>
                                                    </div>
                                                </td>
                                                <td>{{ $item->quantity * $item->product->price }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>{{ $totalCartPrice }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p>You Will Pay Cash</p>
                                <a href="{{ route('cart.checkout') }}"
                                    class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.btn-quantity-decrease').click(function(e) {
            e.preventDefault();
            var cartItemId = $(this).data('cart-item-id');
            updateCartQuantity(cartItemId, 'decrease');
        });
        $('.btn-quantity-increase').click(function(e) {
            e.preventDefault();
            var cartItemId = $(this).data('cart-item-id');
            updateCartQuantity(cartItemId, 'increase');
        });
        function updateCartQuantity(cartItemId, action) {
            $.ajax({
                url: "{{ route('cart.update') }}",
                type: "POST",
                data: {
                    cart_item_id: cartItemId,
                    action: action,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(response) {
                    alert('An error occurred. Please try again.');
                }
            });
        }

$('.btn-order').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: "{{ route('cart.checkout') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            location.href = "{{ route('main') }}";
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert('An error occurred: ' + xhr.responseText);
        }
    });
});
    });
</script>
@endsection
