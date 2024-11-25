@extends('admin/layouts.app')
@section('title', 'Contact View')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Contact View</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item ">Contact View</li>
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
                        <h3 class="card-title">Contact View</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="postlist" class="table table-bordered table-striped">
                            <tr>
                                <th style="min-width: 10%;">Name</th>
                                <td>{{$contact->name}}</td>
                            </tr>
                            <tr>
                                <th>Subject</th>
                                <td>{{$contact->subject}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                            </tr>
                            <tr>
                                <th>Message</th>
                                <td>{{ $contact->message }}</td>
                            </tr>
                            <tr>
                                <th>Contact Date</th>
                                <td>{{ $contact->created_at->format('d M, Y') }}</td>
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
