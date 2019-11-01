@extends('layout')

@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <h1>
        Tambah Klien
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">User</a></li>
        <li><a href="{{url('user/klien')}}">Daftar Klien</a></li>
        <li class="active">Tambah Klien</li>
      </ol>
    </div>
@endsection

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
        {!! Form::open(array('url'=>'user/klien/simpan','method'=>'POST', 'files'=>'true', 'class'=>'form-horizontal','enctype'=>'multipart/form-data'))!!}
          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Nama</p>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="name" placeholder="Nama" value="{{old('name')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>NIK</p>
                  </div>
                  <div class="col-md-10">
                    <input type="number" class="form-control" name="nik" placeholder="NIK" value="{{old('nik')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Jenis Kelamin</p>
                  </div>
                  <div class="col-md-8">
                    <input class="col-md-1" name="jenis_kelamin" type="radio" value="Laki-laki" {{ (old('jenis_kelamin')=="Laki-laki")? "checked" : "" }}> Laki-laki<br>
                    <input class="col-md-1" name="jenis_kelamin" type="radio" value="Perempuan" {{ (old('jenis_kelamin')=="Perempuan")? "checked" : "" }}> Perempuan
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Tanggal Lahir</p>
                  </div>
                      <div class="col-md-10">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="tanggal_lahir" type="text" class="form-control datepicker" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{old('tanggal_lahir')}}">
                          </div>
                      </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Anak ke</p>
                  </div>
                  <div class="col-md-2">
                    <input type="number" class="form-control" name="anak_ke" placeholder="Anak ke" value="{{old('anak_ke')}}"> 
                  </div>
                  <div class="col-md-1">
                      <p>dari</p>
                  </div>
                  <div class="col-md-2">
                    <input type="number" class="form-control" name="jumlah_saudara" placeholder="jml saudara" value="{{old('jumlah_saudara')}}">
                  </div>
                  <div class="col-md-1">
                      <p>bersaudara</p>
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Pendidikan Terakhir</p>
                  </div>
                  <div class="col-md-10">
                    <div class="col-md-3">
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="SD" {{ (old('pendidikan_terakhir')=="SD")? "checked" : "" }}> SD<br>
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="SMP" {{ (old('pendidikan_terakhir')=="SMP")? "checked" : "" }}> SMP<br>
                    </div>
                    <div class="col-md-3">
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="SMA" {{ (old('pendidikan_terakhir')=="SMA")? "checked" : "" }}> SMA<br>
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="D3" {{ (old('pendidikan_terakhir')=="D3")? "checked" : "" }}> D3<br>
                    </div>
                    <div class="col-md-3">
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="S1" {{ (old('pendidikan_terakhir')=="S1")? "checked" : "" }}> S1<br>
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="S2" {{ (old('pendidikan_terakhir')=="S2")? "checked" : "" }}> S2<br>
                    </div>
                    <div class="col-md-3">
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="S3" {{ (old('pendidikan_terakhir')=="S3")? "checked" : "" }}> S3<br>
                    </div>
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Alamat</p>
                  </div>
                  <div class="col-md-10">
                    <textarea class="form-control" name="alamat" placeholder="Alamat">{{old('alamat')}}</textarea>
                  </div>
              </div>            
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Foto</p>
                  </div>
                  <div class="col-md-10">
                    <input type="file" class="form-control" name="foto" placeholder="Foto" value="{{old('foto')}}">
                  </div>
              </div>            
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Nomor Telepon</p>
                  </div>
                  <div class="col-md-10">
                    <input type="number" class="form-control" name="no_telepon" placeholder="Nomor Telepon" value="{{old('no_telepon')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Email</p>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Username</p>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{old('username')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Password</p>
                  </div>
                  <div class="col-md-10">
                    <input type="password" class="form-control" name="password" placeholder="Password" value="{{old('password')}}">
                  </div>
              </div>  
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:10px;">
                  <div class="col-md-2">
                      <p>Kategori Klien</p>
                  </div>
                  <div class="col-md-10">
                    <select class="form-control select2" name="kategori_id">
                        <option value="">Pilih kategori klien</option>
                        @foreach($kategori as $value)
                            <option value="{{$value->id}}" {{collect(old('kategori'))->contains($value->id) ? 'selected':''}}>{{$value->nama}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>                 
          </div>                
          </div>
          <div class="row mt-3" >
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('user/klien')}}'">Kembali</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
          </div>
              <!-- /.box-footer -->
        </form>
      </div>
    </section>
    <!-- /.content -->
@endsection

@section('javascript')

    <script>
      $(function () {
        //Date picker
        $('.datepicker').datepicker({
          autoclose: true,
          endDate: "dd",
        //   startDate: "dd",
          todayHighlight: true
        })
      })
    </script>
@endsection
