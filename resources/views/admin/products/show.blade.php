@extends('admin.layout.app')
@section('metadata')
@endsection
@section('style')
<style>
    .product-header {
        background-color: #f4f4f4;
        padding: 20px;
        border-radius: 5px;
    }
    .product-info {
        margin-bottom: 20px;
    }
    .product-card img {
        max-width: 200px;
        max-height: 200px;
        margin-right: 15px;
    }
    .img {
        width: 15rem;
        height: 15rem;
    }
    .category-link {
        text-decoration: none;
    }
    .category-link:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $product->title }} Details</h1>
                </div>
                <div class="col-sm-6" style="text-align: right">
                    <a href="{{ route('products') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="product-header">
                <h2>{{ $product->title }}</h2>
                <div class="product-info">
                    @if($product->image)
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}" class="img">
                    @endif
                    <p><strong>Category:</strong> <b><a href="{{ url('admin/categories/show/'.$product->category_id) }}" class="category-link text-primary">{{ $product->category_name }}</a></b></p>
                    <p><strong>Price:</strong> ${{ $product->price }}</p>
                    <p><strong>Old Price:</strong> ${{ $product->old_price }}</p>
                    <p><strong>Description:</strong> {{ $product->Discription }}</p>
                    <p><strong>Status:</strong> {{ $product->status == 0 ? 'Active' : 'Inactive' }}</p>
                    <a href="{{ url('admin/products/edit/'.$product->id) }}" class="btn btn-primary">Edit Product</a>
                    <form action="{{ url('admin/products/delete/'.$product->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Product</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
@endsection
