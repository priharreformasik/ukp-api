@extends('layout')

@section('content-header')
    <section class="content-header">
      <h1>
        Profil Admin
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-user"></i> Profil</li>
      </ol>
    </section>
@stop
@section('content')
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary" style="padding-top: 30px; ">
        <!-- /.box-header -->
        <form class="form-horizontal">
          <div class="box-body box-profile" style="padding-left: 70px; padding-right: 70px;">
            <div class="col-md-12" align="right">
              <button type="button" class="btn btn-info" onclick="location.href='{{ url('profile/'.Auth::user()->id.'/edit') }}'"><i class="fa fa-pencil"></i> Ubah Profil</button> 

              <button type="button" class="btn btn-info" onclick="location.href='{{ url('ganti_password/'.Auth::user()->id.'') }}'"><i class="fa fa-pencil"></i> Ganti Password</button>
            </div>
            <div class="col-md-2">
              <div align="center">
                    @if (!Auth::user()->foto)
                    <img class="profile-user-img img-responsive img-circle" src="{{asset('images/user.png')}}" class="img-responsive" style="width: 150px;">
                    @else
                    <img class="profile-user-img img-responsive img-circle" src="{{asset('images/'.Auth::user()->foto.'')}}" class="img-responsive" style="width: 150px;">
                    @endif
              </div>
              <div class="col-lg" style="text-align: center; margin-top: 10px;">
                  <a href="{{url('ganti_foto/'.Auth::user()->id.'')}}" ><i class="fa fa-pencil"></i> Ganti Foto</a>
              </div>
            </div>
            <div class="col-md-10" style="padding-left: 70px;">
              <div>
                  <h3>{{$admin->name}}</h3>
              </div>
              <div>
              <table class="table display responsive nowrap">
                  <tbody>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>{{$admin->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td> {{\Carbon\Carbon::parse($admin->tanggal_lahir)->format('l, j F Y')}} </td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>{{$admin->nik}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$admin->email}}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{$admin->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>{{$admin->username}}</td>
                    </tr>  
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>{{$admin->no_telepon}}</td>
                    </tr>                   
                  </tbody>
              </table>
                </div>
          </div>
          </div>              
        </form>
      </div>
    </section>
@endsection



