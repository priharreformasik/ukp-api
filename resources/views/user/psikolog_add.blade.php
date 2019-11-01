@extends('layout')

@section('css')
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Tambah Psikolog
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">User</a></li>
        <li><a href="{{url('user/psikolog')}}">Daftar Psikolog</a></li>
        <li class="active">Tambah Psikolog</li>
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
        
        {!! Form::open(array('url'=>'user/psikolog/simpan','method'=>'POST', 'files'=>'true', 'class'=>'form-horizontal','enctype'=>'multipart/form-data'))!!}
          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Nama</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="name" placeholder="Nama" value="{{old('name')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Jenis Kelamin</p>
                  </div>
                  <div class="col-md-8">
                    <input class="col-md-1" name="jenis_kelamin" type="radio" value="Laki-laki" {{ (old('jenis_kelamin')=="Laki-laki")? "checked" : "" }}> Laki-laki<br>
                    <input class="col-md-1" name="jenis_kelamin" type="radio" value="Perempuan" {{ (old('jenis_kelamin')=="Perempuan")? "checked" : "" }}> Perempuan
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Tanggal Lahir</p>
                  </div>
                      <div class="col-md-8">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="tanggal_lahir" type="text" class="form-control" id="datepicker" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{old('tanggal_lahir')}}">
                          </div>
                      </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>NIK</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="nik" placeholder=" NIK" value="{{old('nik')}}">
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Gelar</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="gelar" placeholder="Gelar" value="{{old('gelar')}}">
                  </div>
              </div>      
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Nomor SIPP</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="no_sipp" placeholder="Nomor SIPP" value="{{old('no_sipp')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Alamat</p>
                  </div>
                  <div class="col-md-8">
                    <textarea class="form-control" name="alamat" placeholder="Alamat">{{old('alamat')}}</textarea>
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Nomor Telepon</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="no_telepon" placeholder="Nomor Telepon" value="{{old('no_telepon')}}">
                  </div>
              </div>                 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Foto</p>
                  </div>
                  <div class="col-md-8">
                    <input type="file" class="form-control" name="foto" placeholder="Foto" value="{{old('foto')}}">
                  </div>
              </div>              
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Email</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Username</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{old('username')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px; ">
                  <div class="col-md-4">
                      <p>Password</p>
                  </div>
                  <div class="col-md-8">
                    <input type="password" class="form-control" name="password" placeholder="Password" value="{{old('password')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style=" padding-bottom:10px; padding-top: 5px;">
                  <div class="col-md-4">
                      <p>Keahlian</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" multiple="true" name="layanan_id[]" placeholder="Pilih Keahlian">
                        @foreach($layanan as $value)
                            <option value="{{$value->id}}" {{collect(old('layanan'))->contains($value->id) ? 'selected':''}}>{{$value->nama}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>                
          </div>
          <div class="row mt-3" >
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('user/psikolog')}}'">Kembali</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
          </div>
        </div>
        <!-- /.box-body -->
        
        {!!Form::close()!!}
      </div>
    </section>
    <!-- /.content -->
@endsection

@section('javascript')

@endsection
