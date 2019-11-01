@extends('layout')

@section('css')
  <link rel="stylesheet" href="{{asset('bower_components/admin-lte/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/admin-lte/dist/css/skins/_all-skins.min.css')}}">
@section('content-header')
    <section class="content-header">
      <h1>
        Tulis Pesan
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('pengaturan/pesan')}}">Pengaturan</a></li>
        <li><a href="{{url('pengaturan/pesan')}}">Daftar Pesan</a></li>
        <li class="active">Tulis Pesan</li>
      </ol>
    </section>
@stop

@section('content')
    <section class="content">
          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Broadcast</h3>
              <!-- tools box -->
              
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="#" method="post">
                <!-- <div class="form-group">
                  <input type="email" class="form-control" name="penerima" placeholder="Penerima">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div> -->
                <div>
                  <textarea class="textarea" id="mainText" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="submit" id="submitBtn" onclick="submitClick()" class="pull-right btn btn-default">Send
                <i class="fa fa-arrow-circle-right"></i></button>
              <button type="button" class="pull-left btn btn-default" id="sendEmail" onclick="location.href='{{url('pengaturan/pesan')}}'"><i class="fa fa-arrow-circle-left"></i> Cancel</button>
            </div>
          </div> 
    </section>
@endsection

@section('javascript')
<!-- AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
<!-- AngularFire -->
<script src="https://cdn.firebase.com/libs/angularfire/2.3.0/angularfire.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.8.3/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBNh_yVw2f3RU-DerOHeGeYgpbNZx3JIaM",
    authDomain: "notification-516be.firebaseapp.com",
    databaseURL: "https://notification-516be.firebaseio.com",
    projectId: "notification-516be",
    storageBucket: "notification-516be.appspot.com",
    messagingSenderId: "294070102777"
  };
  firebase.initializeApp(config);
</script>

<script src="{{asset('firebase/index.js')}}"></script>
<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
  })
</script>
@endsection
