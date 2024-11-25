@extends('admin/layouts.app')
@section('title', 'Dashboard')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Web Settings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item ">Web Settings</li>
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
                <div class="card">
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
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">General Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sitename">Site Title</label>
                                        <input type="text" name="sitename" value="{{ old('sitename', $settings->site_name) }}" class="form-control" id="sitename">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ old('address', $settings->address) }}" id="address" placeholder="Enter Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fomr-group" style="max-width:200px">
                                        <img src="{{ asset($settings->logo) }}" alt="" style="max-width:100%">
                                    </div>
                                    <div class="form-group">
                                        <label for="logo">Upload Logo</label>
                                        <input type="file" name="logo" class="form-control-file" id="logo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fomr-group" style="max-width:100px">
                                        <img src="{{ asset($settings->fav_icon) }}" alt=""  style="max-width:100%">
                                    </div>
                                    <div class="form-group">
                                        <label for="favicon">Upload Favicon</label>
                                        <input type="file" name="fav_icon" class="form-control-file" id="favicon">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $settings->phone) }}" id="phone" placeholder="Enter Phone Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $settings->email) }}" placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Social Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facebook">Facebook Link</label>
                                        <input type="text" class="form-control" name="facebook" value="{{ old('facebook', $settings->facebook) }}" id="facebook" placeholder="Enter Facebook links">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instagram">Instagram Link</label>
                                        <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $settings->instagram) }}" placeholder="Enter Instagram links">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="youtube">Youtube Link</label>
                                        <input type="text" class="form-control" name="youtube" id="youtube"  value="{{ old('youtube', $settings->youtube) }}" placeholder="Enter Youtube links">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control" name="twitter" value="{{ old('twitter', $settings->twitter) }}" id="twitter" placeholder="Enter Twitter links">
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="card-header">
                            <h3 class="card-title">Other Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $settings->meta_title) }}" id="meta_title" placeholder="Enter Meta Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_desc">Meta Description</label>
                                        <input type="text" class="form-control" name="meta_desc" id="meta_desc"  value="{{ old('meta_desc', $settings->meta_desc) }}" placeholder="Enter Meta Description">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_keyword">Meta Keywords</label>
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword"  value="{{ old('meta_keyword', $settings->meta_keyword) }}" placeholder="Enter Meta Keywords">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="copyright">Copyright</label>
                                        <input type="text" class="form-control" name="copyright" id="copyright"  value="{{ old('copyright', $settings->copyright) }}" placeholder="Enter Copyright">
                                    </div>
                                </div>
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