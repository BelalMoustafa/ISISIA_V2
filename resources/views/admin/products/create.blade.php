@extends('admin.layout.app')

@section('style')
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Product</h1>
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
                        <form action="{{ route('storeProduct') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Title <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required placeholder="Enter title" name="title">
                                </div>
                                <div class="form-group">
                                    <label>Category <span style="color: red">*</span></label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Price <span style="color: red">*</span></label>
                                    <input type="number" class="form-control" required placeholder="Enter price" name="price">
                                </div>
                                <div class="form-group">
                                    <label>Image <span style="color: red">*</span></label>
                                    <div class="demo-image-container">
                                        <img id="demo-image" class="demo-image" src="#" alt="Demo Image" style="display: none;" width="80" height="80">
                                    </div>
                                    <input type="file" class="form-control" required name="image" id="image-input">
                                </div>
                                <div class="form-group">
                                    <label>Description <span style="color: red">*</span></label>
                                    <textarea class="form-control" name="description" required placeholder="Enter description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span></label>
                                    <select class="form-control" name="status" required>
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
            const demoImage = document.getElementById('demo-image');
            demoImage.src = e.target.result;
            demoImage.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            document.getElementById('demo-image').style.display = 'none';
        }
    });
</script>
@endsection
