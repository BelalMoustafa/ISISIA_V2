@extends('admin.layout.app')

@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.layout.message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products List</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('addProduct') }}" class="btn btn-primary">Add New Product</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Products List</h3>
                            </div>
                            <div class="card-body p-0">
                                @if($getRecord->isEmpty())
                                    <div class="alert alert-primary" role="alert" style="text-align: center; padding: 20px;">
                                        No Products available
                                    </div>
                                @else
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Old Price</th>
                                                <th>Price</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Created By</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    @if($value->image)
                                                        <img src="{{ asset('storage/products/' . $value->image) }}" alt="{{ $value->title }}" width="80" height="80">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{ $value->category_name }}</td>
                                                @if ($value->old_price)
                                                <td>{{ $value->old_price }}</td>
                                                @else
                                                <td>0</td>
                                                @endif
                                                <td>{{ $value->price }}</td>
                                                <td>{{ $value->Discription }}</td>
                                                <td>{{ $value->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ $value->created_by_name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/products/show/'.$value->id) }}" class="btn btn-outline-dark">View</a>
                                                    <a href="{{ url('admin/products/edit/'.$value->id) }}" class='btn btn-outline-primary'>Edit</a>
                                                    <form action="{{ url('admin/products/delete/'.$value->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class='btn btn-outline-danger'>Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div style="float:right">
                                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
@endsection
