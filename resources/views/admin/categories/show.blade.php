@extends('admin.layout.app')
@section('metadata')
@endsection
@section('style')
<style>
    .category-header {
        background-color: #f4f4f4;
        padding: 20px;
        border-radius: 5px;
    }
    .category-info, .product-info {
        margin-bottom: 20px;
    }
    .product-card {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .product-card img {
        max-width: 100px;
        max-height: 100px;
        margin-right: 15px;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $category->name }} Details</h1>
                </div>
                <div class="col-sm-6" style="text-align: right">
                    <a href="{{ route('categories') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="category-header">
                <h2>Category Information</h2>
                <p><strong>Name:</strong> {{ $category->name }}</p>
                <p><strong>Status:</strong> {{ $category->status == 0 ? 'Active' : 'Inactive' }}</p>
                <p><strong>Meta Title:</strong> {{ $category->metaTitle }}</p>
                <p><strong>Meta Description:</strong> {{ $category->metaDescription }}</p>
                <p><strong>Meta Keywords:</strong> {{ $category->metaKeys }}</p>
                <a href="{{ url('admin/categories/edit/'.$category->id) }}" class="btn btn-primary">Edit Category</a>
                <form action="{{ url('admin/categories/delete/'.$category->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Category</button>
                </form>
            </div>

            <div class="product-info">
                <h2>Products in this Category</h2>
                @foreach($products as $product)
                    <div class="product-card">
                        @if($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}">
                        @endif
                        <div>
                            <h4>{{ $product->title }}</h4>
                            <p><strong>Price:</strong> ${{ $product->price }}</p>
                            <p><strong>Status:</strong> {{ $product->status == 0 ? 'Active' : 'Inactive' }}</p>
                            <a href="{{ url('admin/products/show/'.$product->id) }}" class="btn btn-primary">View Product</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
@endsection
