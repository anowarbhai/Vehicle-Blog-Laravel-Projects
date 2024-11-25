@extends('admin/layouts.app')
@section('title', 'Edit Category')
@section('content')
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
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        color: #000;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        margin-left: 0;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        margin-top: 0;
    }
</style>
@endpush


 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item ">Edit Category</li>
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
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Category</h3>
                    </div>
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
                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryname">Category Name</label>
                                <input type="text" class="form-control" id="categoryname" name="categoryname" value="{{ old('categoryname', $category->title) }}" placeholder="Enter category name">
                            </div>
                            <div class="form-group">
                                <label for="categoryslug">Category Slug</label>
                                <input type="text" class="form-control" id="categoryslug" name="categoryslug" value="{{ old('categoryslug', $category->slug) }}" placeholder="Enter category slug">
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea class="form-control" id="desc" name="desc" rows="5" placeholder="Enter category description">{{ old('desc', $category->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                @if($category->image)
                                    <img src="{{ asset($category->image) }}" alt="Category Image" width="200" class="mb-3">
                                @endif
                                <br>
                                <label for="postimage">Category Image</label>
                                <input type="file" class="form-control" id="postimage" name="postimage">
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}" placeholder="Enter Meta Title">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">Meta Description</label>
                                <input type="text" class="form-control" id="meta_desc" name="meta_desc" value="{{ old('meta_desc', $category->meta_desc) }}" placeholder="Enter Meta Description">
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword">Meta Keywords</label>
                                <select class="form-control" id="meta_keyword" name="meta_keyword[]" multiple="multiple">
                                    @php
                                        $metaKeywords = old('meta_keyword', explode(',', $category->meta_keyword ?? ''));
                                    @endphp
                                    @foreach($metaKeywords as $keyword)
                                        <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>

                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
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
</script>
<script>
    // Custom plugin (for example purposes, not adding functionality here)
    function CustomizationPlugin(editor) {}

    // Initialize CKEditor 5 with extended toolbar and plugins
    ClassicEditor
        .create(document.querySelector('#desc'), {
            extraPlugins: [CustomizationPlugin],
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                    'indent', 'outdent', '|',
                    'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'undo', 'redo', 'alignment', 'fontSize', 'fontColor', 'highlight', 'codeBlock'
                ]
            },
            image: {
                toolbar: [
                    'imageTextAlternative', 'imageStyle:full', 'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells'
                ]
            },
            language: 'en'
        })
        .then(newEditor => {
            window.editor = newEditor;
            // The following line adds CKEditor 5 inspector.
            CKEditorInspector.attach(newEditor, {
                isCollapsed: true
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush