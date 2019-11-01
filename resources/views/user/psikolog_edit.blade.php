@extends('layout')

@section('css')
<!--     <link href="{{asset('lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('lib/select2/css/select2.min.css')}}" rel="stylesheet"> -->
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Edit Psikolog
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">User</a></li>
        <li><a href="{{url('user/psikolog')}}">Daftar Psikolog</a></li>
        <li class="active">Edit Psikolog</li>
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
      <div class="box box-default">
        <div class="box-header" style="padding-left: 70px; padding-right: 170px; padding-top: 20px">
          <div style="float:right; ">
              <a href="{{url('ganti_password/'.$data->id.'/psikolog')}}" type="button" class="btn btn-block btn-warning"><i class="fa fa-pencil"></i> Ganti Password</a>
          </div>
        </div>
        <!-- /.box-header -->
        {!! Form::open(array('url'=>'user/psikolog/'.$data->id.'/edit', 'method'=>'POST', 'enctype'=>'multipart/form-data'))!!}
          <div class="box-body" style="padding-left: 70px; padding-right: 30px;">
            <div class="col-md-2 pl-5 pr-5">              
              @if (!$data->foto)
                  <img class="img-detail" src="{{asset('images/user.png')}}" class="img-responsive" style="width: 150px;">
              @else
                  <img class="img-detail" src="{{url('images/'.$data->foto)}}" class="img-responsive" style="width: 150px;">
              @endif
              <div align="center" style="margin-top: 10px;">
                <a href="{{url('user/psikolog/'.$data->id.'/edit_foto')}}"><i class="fa fa-pencil"></i> Ganti Foto</a>
              </div>
            </div>
            <div class="col-md-10 pl-5 pr-5" style="padding-left: 80px;">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Nama</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="name" placeholder="" value="{{ old('name') ? old('name') : $data->name }}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Jenis Kelamin</p>
                  </div>
                  <div class="col-md-8">
                    <input class="col-md-1" name="jenis_kelamin" type="radio" value="Laki-laki" {{ ($data->jenis_kelamin=="Laki-laki")? "checked" : "" }}> Laki-laki<br>
                    <input class="col-md-1" name="jenis_kelamin" type="radio" value="Perempuan" type="radio" {{ ($data->jenis_kelamin=="Perempuan")? "checked" : "" }}> Perempuan
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Tanggal Lahir</p>
                  </div>
                      <div class="col-md-8">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="tanggal_lahir" type="text" class="form-control fc-datepicker" id="datepicker" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{ old('tanggal_lahir') ? old('tanggal_lahir') : \Carbon\Carbon::parse($data->tanggal_lahir)->format('Y-m-d') }}">
                          </div>
                      </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>NIK</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="nik" placeholder="" value="{{ old('nik') ? old('nik') : $data->nik }}">
                  </div>
              </div>  
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Gelar</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="gelar" placeholder="" value="{{ old('gelar') ? old('gelar') : $data->psikolog['gelar'] }}">
                  </div>
              </div>      
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Nomor SIPP</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="no_sipp" placeholder="" value="{{ old('no_sipp') ? old('no_sipp') : $data->psikolog['no_sipp'] }}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Alamat</p>
                  </div>
                  <div class="col-md-8">
                    <textarea class="form-control" name="alamat" placeholder="">{{ old('alamat') ? old('alamat') : $data->alamat }}</textarea>
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Nomor Telepon</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="no_telepon" placeholder="" value="{{ old('no_telepon') ? old('no_telepon') : $data->no_telepon }}">
                  </div>
              </div>         
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Email</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="email" placeholder="" value="{{ old('email') ? old('email') : $data->email }}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Username</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="username" placeholder="" value="{{ old('username') ? old('username') : $data->username }}">
                  </div>
              </div>
            <!--   <div class="row pl-5 pr-5" style="margin-top: 5px; ">
                  <div class="col-md-2">
                      <p>Password</p>
                  </div>
                  <div class="col-md-8">
                    <input type="password" class="form-control" name="password" placeholder="" value="{{ old('password') ? old('password') : $data->password }}">
                  </div>
              </div>    -->  
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:20px;">
                  <div class="col-md-2">
                        <p>Keahlian</p>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control select2" multiple="true" name="layanan_id[]">
                            @foreach($layanan as $value)
                                <option value="{{$value->id}}" {{collect(old('layanan'))->contains($value->id) ? 'selected':''}} {{collect($dataLayanan)->contains($value->id) ? 'selected':''}}>{{$value->nama}}</option>
                            @endforeach
                        </select>
                    </div>
              </div>
          </div>
          
          <div class="row mt-3">
                <div class="col-lg" style="text-align: center ; padding-bottom:20px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('user/psikolog')}}'">Kembali</button>
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
@endsection

        