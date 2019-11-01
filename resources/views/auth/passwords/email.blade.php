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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div  align="center">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn btn-danger" type="button" href="{{ route('login') }}">{{ __('Back') }}</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->


<script src="{{asset('lib/jquery/jquery.js')}}"></script>
<script src="{{asset('lib/popper.js/popper.js')}}"></script>
<script src="{{asset('lib/bootstrap/bootstrap.js')}}"></script>
</body>
</html>
