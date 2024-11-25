@extends('admin/layouts.app')
@section('title', 'Create Post')
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
                <h1 class="m-0">Create Post</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item ">Post List</li>
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
                        <h3 class="card-title">Add New Post</h3>
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
                    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="posttitle">Post Title</label>
                                <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="Enter post title" value="{{ old('posttitle') }}">
                            </div>
                            <div class="form-group">
                                <label for="postslug">Post Slug</label>
                                <input type="text" class="form-control" id="postslug" name="postslug" placeholder="Enter post slug" value="{{ old('postslug') }}">
                            </div>
                            <div class="form-group">
                                <label for="postcategory">Category</label>
                                <select class="form-control" id="postcategory" name="postcategory">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('postcategory') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="postauthor">Author</label>
                                <select class="form-control" id="postauthor" name="postauthor">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('postauthor') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea class="form-control" id="desc" name="desc" rows="5" placeholder="Enter post desc">{{ old('desc') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="postimage">Post Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="postimage" name="postimage">
                                        <label class="custom-file-label" for="postimage">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="metatitle">Meta Title</label>
                                <input type="text" class="form-control" id="metatitle" name="metatitle" placeholder="Enter meta title" value="{{ old('metatitle') }}">
                            </div>
                            <div class="form-group">
                                <label for="metadescription">Meta Description</label>
                                <textarea class="form-control" id="metadescription" name="metadescription" rows="8" placeholder="Enter meta description">{{ old('metadescription') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="posttags">Keywords</label>
                                <select class="form-control" id="posttags" name="meta_keyword[]" multiple="multiple">
                                @if(old('meta_keyword'))
                                    @php
                                        $keywords = old('meta_keyword');
                                    @endphp
                                    @foreach($keywords as $keyword)
                                        <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Select Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="0">Draft</option>
                                    <option value="1">Published</option>
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
    $('#posttags').select2({
        tags: true,
        tokenSeparators: [',', ' '],
        placeholder: 'Enter Tag'
    });
});
$(document).ready(function() {
    // Function to create a slug from the title
    $('#posttitle').on('input', function () {
        var title = $(this).val();
        var slug = title
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-')         // Replace spaces with hyphens
            .replace(/-+/g, '-');         // Remove multiple hyphens
        $('#postslug').val(slug);
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