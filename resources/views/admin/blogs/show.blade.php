@extends('admin/layouts.app')
@section('title', 'Blog Lists')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Post List</h1>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Posts</h3>
                        <a class="float-right" href="{{ route('admin.blogs.create') }}">Add Post +</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="postlist" class="table table-bordered table-striped">
                            <tr>
                                <th style="min-width: 10%;">Title</th>
                                <td>{{$blog->title}}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{$blog->category->title}}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{!! $blog->description !!}</td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td><img src="{{ asset($blog->image) }}" width="50" height="50" alt="img"></td>
                            </tr>
                            <tr>
                                <th>Author</th>
                                <td>{{ $blog->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Publish Date</th>
                                <td>{{ $blog->created_at->format('d M, Y') }}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection
