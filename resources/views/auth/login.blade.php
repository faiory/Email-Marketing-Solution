 {{-- @extends('authLayout') --}}
 
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TitleHere</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/admin-lte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="bower_components/admin-lte/dist/css/skins/_all-skins.min.css">
</head>

{{-- @section('content') --}}
<div class="hold-transition skin-black sidebar-mini">
  <div class="login-box">
    <div class="login-logo">
      <a href=""><b class="bg-maroon">Maroon</b>Frog</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group has-feedback">
          <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
            value="{{ old('email') }}" required autofocus>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('email') }}</strong>
        </span> @endif


        <div class="form-group has-feedback">
          <input name="password" id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
            placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span> @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
          </span> @endif
        </div>

        <div class="form-group row mb-0">
          <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
              {{ __('Login') }}
            </button> @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
            </a> @endif
          </div>
      </form>
      </div>
      <!-- /.login-box-body -->
    </div>
  </div>
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="bower_components/admin-lte/dist/js/adminlte.min.js"></script>
{{-- @stop --}}




  