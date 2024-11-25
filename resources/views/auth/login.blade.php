<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminassets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminassets/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<div class="login-logo">
<a href="{{ route('login') }}"><b>Admin</b> Login</a>
</div>

<div class="card">
<div class="card-body login-card-body">
<p class="login-box-msg">Sign in to start your session</p>
<form action="{{ route('login') }}" method="post">
@csrf
<div class="input-group mb-3">
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-envelope"></span>
        </div>
    </div>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror    
</div>
<div class="input-group mb-3">
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    <div class="input-group-append">
        <div class="input-group-text">
        <span class="fas fa-lock"></span>
        </div>
    </div>
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror    
</div>
<div class="input-group mb-3">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" for="remember">
            {{ __('Remember Me') }}
        </label>
    </div>
</div>
<div class="row">
<div class="col-12">
<button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
@if (Route::has('password.request'))
    <a class="btn btn-link" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
    </a>
@endif
</div>

</div>
</form>
<p class="mt-5 text-center">
<a href="{{ route('/') }}" class="text-center">Back to Website</a>
</p>
</div>

</div>
</div>
<!-- ./wrapper -->

<script src="{{ asset('adminassets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminassets/plugins/fontawesome-free/js/font-awesome.min.js') }}"></script>
<script src="{{ asset('adminassets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminassets/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
</body>
</html>

