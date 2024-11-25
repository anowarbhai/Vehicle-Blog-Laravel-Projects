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
                    @if (session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <table id="postlist" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Desc</th>
                                    <th>Img</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $post)
                                <!-- data rows -->
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->title }}</td>
                                    <td>{!! Str::limit($post->description, 50) !!}</td>
                                    <td><img src="{{ asset($post->image) }}" width="50" height="50" alt="img"></td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>@if($post->status == 0) <span class="text-danger">Draft</span> @else <span class="text-success">Published</span> @endif</td>
                                    <td>{{ $post->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{route('admin.blogs.show', $post->id)}}" class="btn btn-primary btn-sm">View</a>
                                        <a href="{{route('admin.blogs.edit', $post->id)}}" class="btn btn-info btn-sm">Edit</a>
                                        <a onclick="event.preventDefault(); if(confirm('Are you sure to delete this post?')) { document.getElementById('delete-form-{{ $post->id }}').submit(); }" href="#" class="btn btn-danger btn-sm">Delete</a>
                                        <form id="delete-form-{{ $post->id }}" action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>desc</th>
                                    <th>img</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
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
