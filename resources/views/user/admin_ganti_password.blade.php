@extends('layout')

@section('content-header')
    <section class="content-header">
      <h1>
        Ganti Password
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('profile/'.Auth::user()->id.'')}}"><i class="fa fa-user"></i>  Profil</a></li>
        <li class="active">Ganti Password</li>
      </ol>
    </section>
@stop

@section('content')
    <section class="content">
      @if(count($errors)>0)
          <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <li>
                {{$error}}
              </li>
            @endforeach
          </div>
      @endif
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default" style="padding-top: 30px; ">
        <!-- /.box-header -->
        {!! Form::open(array('url'=>'ganti_password/'.$data->id.'', 'method'=>'POST','enctype'=>'multipart/form-data', 'novalidate'=>'novalidate'))!!}
        {{ csrf_field() }}
          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:10px;">
                  <div class="col-md-4">
                      <p>Password Lama</p>
                  </div>
                  <div class="col-md-8">
                    <input type="password" class="form-control" name="password_lama" placeholder="password lama" value="" required="">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:10px;">
                  <div class="col-md-4">
                      <p>Password Baru</p>
                  </div>
                  <div class="col-md-8">
                    <input type="password" class="form-control" name="password_baru" placeholder="password baru" value="" required="">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:10px;">
                  <div class="col-md-4">
                      <p>Konfirmasi Password Baru</p>
                  </div>
                  <div class="col-md-8">
                    <input type="password" class="form-control" name="konfirmasi" placeholder="konfirmasi password baru" value="" required="">
                  </div>
              </div>                                     
          </div>
          <div class="row mt-3">
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{ url('profile/'.Auth::user()->id.'') }}'">Kembali</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
          </div>
        </div>
        {!!Form::close()!!}
      </div>
    </section>
    <!-- /.content -->
@endsection

