@extends('admin.layout.app')

@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Category</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('categories') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form action="{{ route('updateCategory', $getRecord->id) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter name"
                                            name="name" value="{{ old('name', $getRecord->name) }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="0" {{ $getRecord->status == 0 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="1" {{ $getRecord->status == 1 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label for="metaTitle">Meta Title</label>
                                        <input type="text" class="form-control" id="metaTitle" placeholder="Meta Title"
                                            name="metaTitle" value="{{ old('metaTitle', $getRecord->metaTitle) }}">
                                        @if ($errors->has('metaTitle'))
                                            <span class="text-danger">{{ $errors->first('metaTitle') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="metaDescription">Meta Description</label>
                                        <textarea class="form-control" id="metaDescription" placeholder="Meta Description" name="metaDescription">{{ old('metaDescription', $getRecord->metaDescription) }}</textarea>
                                        @if ($errors->has('metaDescription'))
                                            <span class="text-danger">{{ $errors->first('metaDescription') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="metaKeys">Meta Keys</label>
                                        <input type="text" class="form-control" id="metaKeys" placeholder="Meta Keys"
                                            name="metaKeys" value="{{ old('metaKeys', $getRecord->metaKeys) }}">
                                        @if ($errors->has('metaKeys'))
                                            <span class="text-danger">{{ $errors->first('metaKeys') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
