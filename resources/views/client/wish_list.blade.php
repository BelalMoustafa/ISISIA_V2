@extends('client.layout.app')

@section('style')
<style>
    .img_wish{
        width: 100%;
        object-fit: cover;
    }
</style>
@endsection

@section('content')
<main class="main">
    <div class="page-content">
        <div class="container">
            <table class="table table-wishlist table-mobile">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wishlistItems as $item)
                    <tr>
                        <td class="product-col">
                            <div class="product">
                                <figure class="product-media">
                                    <a href="{{ route('product.detail', $item->product->id) }}">
                                        <img class="img_wish" src="{{ asset('storage/products/' . $item->product->image) }}" alt="{{ $item->product->title }}">
                                    </a>
                                </figure>
                                <h3 class="product-title">
                                    <a href="{{ route('product.detail', $item->product->id) }}">{{ $item->product->title }}</a>
                                </h3>
                            </div>
                        </td>
                        <td class="price-col">${{ $item->product->price }}</td>
                        <td class="action-col">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                <button type="submit" class="btn btn-block btn-outline-primary-2">Add to Cart</button>
                            </form>
                        </td>
                        <td class="remove-col">
                            <form action="{{ route('wishlist.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="wishlist_item_id" value="{{ $item->id }}">
                                <button type="submit" class="btn-remove"><strong>X</strong></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection

@section('script')
@endsection
