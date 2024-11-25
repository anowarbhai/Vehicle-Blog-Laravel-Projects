@extends('admin/layouts.app')
@section('title', 'Category Lists')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Category List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item ">Category List</li>
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
                        <h3 class="card-title">Category</h3>
                        <a class="float-right" href="{{ route('admin.category.create') }}">Create New</a>
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
                                    <th>Category Name</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Demo data rows -->
                                 @foreach($categories as $category)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>{{$category->user->name}}</td>
                                    <td>{{ $category->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{route('admin.category.show', $category->id)}}" class="btn btn-primary btn-sm">View</a>
                                        <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-info btn-sm">Edit</a>
                                        <a onclick="event.preventDefault(); if(confirm('Are you sure to delete this post?')) { document.getElementById('delete-form-{{ $category->id }}').submit(); }" href="#" class="btn btn-danger btn-sm">Delete</a>
                                        <form id="delete-form-{{ $category->id }}" action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display: none;">
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
                                    <th>Category Name</th>
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
</div>
<!-- /.content-wrapper -->
@endsection
