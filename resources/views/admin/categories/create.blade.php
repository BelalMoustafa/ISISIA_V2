@extends('admin.layout.app')

@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Category</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{route('categories')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form action="{{route('storeCategory')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" required placeholder="Enter name" name='name'>
                                    </div>
                                    <div class="form-group">
                                        <label>Status<span style="color: red">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Meta Title<span style="color: red">*</span></label>
                                        <input type="text" class="form-control"  placeholder="Meta Title" required name='metaTitle'>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea class="form-control"  placeholder="Meta Description" name='metaDescription'></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Keys</label>
                                        <input type="text" class="form-control"  placeholder="Meta Keys" name='metaKeys'>
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
@endsection
