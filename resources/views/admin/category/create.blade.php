@extends('admin/layouts.app')
@section('title', 'Create Category')
@push('styles')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-search--inline .select2-search__field {
        margin-top: 0;
        height: 22px;
    }
    .select2-container--default .select2-selection--multiple {
        padding-top: 5px;
    }
</style>
@endpush
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Create Category</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Add Category Form -->
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Category</h3>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryname">Category Name</label>
                                <input type="text" class="form-control" id="categoryname" name="categoryname" value="{{ old('categoryname') }}" placeholder="Enter category name">
                            </div>
                            <div class="form-group">
                                <label for="categoryslug">Category Slug</label>
                                <input type="text" class="form-control" id="categoryslug" name="categoryslug" value="{{ old('categoryslug') }}" placeholder="Enter category slug">
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea class="form-control" id="desc" name="desc" rows="5" placeholder="Enter post desc">{{ old('desc') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="postimage">Category Image</label>
                                <input type="file" class="custom-file-inputa" id="postimagea" name="postimage">
                                
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" placeholder="Enter Meta Title">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">Meta Description</label>
                                <input type="text" class="form-control" id="meta_desc" name="meta_desc" value="{{ old('meta_desc') }}" placeholder="Enter Meta Title">
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword">Meta Keyword</label>
                                <select class="form-control" id="meta_keyword" name="meta_keyword[]" multiple="multiple">
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@push('scripts')
<!-- Include CKEditor 5 from CDN -->
<script src="//cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
<script src="//unpkg.com/@ckeditor/ckeditor5-inspector@4.1.0/build/inspector.js"></script>
<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#meta_keyword').select2({
        tags: true,
        tokenSeparators: [',', ' '],
        placeholder: 'Enter Tag'
    });
});
$(document).ready(function() {
    // Function to create a slug from the title
    $('#categoryname').on('input', function () {
        var title = $(this).val();
        var slug = title
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-')         // Replace spaces with hyphens
            .replace(/-+/g, '-');         // Remove multiple hyphens
        $('#categoryslug').val(slug);
    });
});
</script>
@endpush