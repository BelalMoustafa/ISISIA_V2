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
                        <h1>Edit Product</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('products') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form action="{{ route('updateProduct',$getRecord->id) }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Title <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="title" value="{{ $getRecord->title }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Category <span style="color: red">*</span></label>
                                        <select class="form-control" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $getRecord->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>New Price <span style="color: red">*</span></label>
                                        <input type="number" step="0.01" class="form-control" name="price" value="{{ $getRecord->price }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Description <span style="color: red">*</span></label>
                                        <textarea class="form-control" name="description" required >{{ $getRecord->Discription }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Status <span style="color: red">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option value="0" {{ $getRecord->status == 0 ? 'selected' : '' }}>Active</option>
                                            <option value="1" {{ $getRecord->status == 1 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Image</label>
                                        <div class="demo-image-container">
                                            <img id="demo-image" class="demo-image" src="{{ asset('storage/products/' . $getRecord->image) }}"  alt="{{$getRecord->title }}" width="80" height="80">
                                        </div>
                                        <input type="file" class="form-control" name="image" id="image-input" @if(config('app.demo_mode')) disabled @endif>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
<script>
    document.getElementById('image-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('demo-image').src = e.target.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
