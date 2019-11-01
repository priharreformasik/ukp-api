@extends('layout')

@section('css')
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Edit Profil
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('profile/'.Auth::user()->id.'')}}"><i class="fa fa-user"></i>  Profil</a></li>
        <li class="active">Edit Profil</li>
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
        {!! Form::open(array('url'=>'profile/'.$data->id.'/edit', 'method'=>'POST','enctype'=>'multipart/form-data'))!!}
          <div class="box-body" style="padding-left: 150px; padding-right: 150px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Nama</p>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="name" placeholder="" value="{{ old('name') ? old('name') : $data->name }}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Jenis Kelamin</p>
                  </div>
                  <div class="col-md-10">
                    <input class="col-md-1" name="jenis_kelamin" type="radio" value="Laki-laki" {{ ($data->jenis_kelamin=="Laki-laki")? "checked" : "" }}> Laki-laki<br>
                    <input class="col-md-1" name="jenis_kelamin" type="radio" value="Perempuan" {{ ($data->jenis_kelamin=="Perempuan")? "checked" : "" }}> Perempuan
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Tanggal Lahir</p>
                  </div>
                      <div class="col-md-10">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="tanggal_lahir" type="text" class="form-control fc-datepicker" id="datepicker" placeholder="DD-MM-YYYY" data-date-format="yyyy-mm-dd" value="{{ old('tanggal_lahir') ? old('tanggal_lahir') : \Carbon\Carbon::parse($data->tanggal_lahir)->format('Y-m-d') }}">
                          </div>
                      </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>NIK</p>
                  </div>
                  <div class="col-md-10">
                    <input type="number" class="form-control" name="nik" placeholder="" value="{{ old('nik') ? old('nik') : $data->nik }}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Email</p>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="email" placeholder="" value="{{ old('email') ? old('email') : $data->email }}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Alamat</p>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="alamat" placeholder="" value="{{ old('alamat') ? old('alamat') : $data->alamat }}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Nomor Telepon</p>
                  </div>
                  <div class="col-md-10">
                    <input type="number" class="form-control" name="no_telepon" placeholder="" value="{{ old('no_telepon') ? old('no_telepon') : $data->no_telepon }}">
                  </div>
              </div>      
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:10px;">
                  <div class="col-md-2">
                      <p>Username</p>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="username" placeholder="" value="{{ old('username') ? old('username') : $data->username }}">
                  </div>
              </div>                                 
          </div>
          <div class="row mt-3">
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('profile/'.Auth::user()->id.'')}}'">Kembali</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
          </div>
        </div>
        {!!Form::close()!!}
      </div>
    </section>
    <!-- /.content -->
@endsection

@section('javascript')
<script>
        $(function(){


            // Select2
            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
            $('.select2').select2();

            // Datepicker
            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'yy-mm-dd'
            });

        });

    </script>

@endsection
