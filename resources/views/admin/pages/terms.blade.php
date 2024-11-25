@extends('admin/layouts.app')
@section('title', 'Terms Page')
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
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Terms & Conditions</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item ">Terms & Conditions</li>
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
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Terms & Conditions</h3>
                    </div>
                    <!-- /.card-header -->
                     <!-- /.card-header -->
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
                    <!-- form start -->
                    <form action="{{ route('admin.terms.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Title">Page Title</label>
                                <input type="text" class="form-control" id="Title" name="title" placeholder="title" value="{{ old('title', $data->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Page Body</label>
                                <textarea name="description" id="description" class="form-control" placeholder="page body" rows="10">{{ old('description', $data->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="meta title" value="{{ old('meta_title', $data->meta_title) }}">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">Meta Description</label>
                                <textarea name="meta_desc" id="meta_desc" placeholder="meta desc" class="form-control" rows="2">{{ old('meta_desc', $data->meta_desc) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <select class="form-control" id="meta_keywords" name="meta_keywords[]" multiple="multiple">
                                    @php
                                        $metaKeywords = old('meta_keywords', explode(',', $data->meta_keywords ?? ''));
                                    @endphp
                                    @foreach($metaKeywords as $keyword)
                                        <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-lg-6 -->
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
    $('#meta_keywords').select2({
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
        .create(document.querySelector('#description'), {
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