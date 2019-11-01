<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UKP UGM | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->


  <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/starlight.css')}}">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>
<body>
<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v"> 
  <!-- /.login-logo -->
  <form role="form" class="form-layout" method="POST" action="{{ route('login') }}">
  <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
    <div class="tx-center mg-b-10">
      <img src="{{asset('bower_components/admin-lte/dist/img/ugm2.png')}}" width="70">
    </div>
    <div class="signin-logo tx-center tx-32 tx-bold tx-inverse mg-b-30">UKP <span class="tx-info tx-bold">UGM</span>
    </div>
  
    
      @csrf
      <div class="form-group">
        <input id="email" type="email" placeholder="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input id="password" type="password" placeholder="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <button type="submit" class="btn btn-info btn-block">Login</button>
      <div align="center">
        <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
      </div>
    </form>

    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->


<script src="{{asset('lib/jquery/jquery.js')}}"></script>
<script src="{{asset('lib/popper.js/popper.js')}}"></script>
<script src="{{asset('lib/bootstrap/bootstrap.js')}}"></script>
</body>
</html>
