@extends('layout')

@section('css')
    <link href="{{asset('lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content-header')
    <div class="content-header">
      <h1>
        Tambah Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li><a href="{{url('user/admin')}}">Daftar Admin</a></li>
        <li class="active">Tambah Admin</li>
      </ol>
    </div>
@stop

@section('content')
    <!-- Main content -->
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
        {!! Form::open(array('url'=>'user/admin/simpan','method'=>'POST', 'files'=>'true', 'class'=>'form-horizontal','enctype'=>'multipart/form-data'))!!}
          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Nama</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="name" placeholder="nama" value="{{old('name')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Jenis Kelamin</p>
                  </div>
                  <div class="col-md-8">
                    <input class=col-md-1 name="jenis_kelamin" type="radio" value="Laki-laki" {{ (old('jenis_kelamin')=="Laki-laki")? "checked" : "" }}>Laki-laki <br>
                  <input class=col-md-1 name="jenis_kelamin" type="radio" value="Perempuan"{{ (old('jenis_kelamin')=="Perempuan")? "checked" : "" }}>Perempuan
                </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Tanggal Lahir</p>
                  </div>
                      <div class="col-md-8">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="tanggal_lahir" type="text" class="form-control fc-datepicker" id="datepicker"  placeholder="DD-MM-YYYY" data-date-format="yyyy-mm-dd" value="{{old('tanggal')}}">
                          </div>
                      </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>NIK</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="nik" placeholder="NIK" value="{{old('nik')}}">
                  </div>
              </div>     
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Email</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="email" placeholder="email" value="{{old('email')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Alamat</p>
                  </div>
                  <div class="col-md-8">
                    <textarea class="form-control" name="alamat" placeholder="alamat">{{old('alamat')}}</textarea>
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Nomor Telepon</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="no_telepon" placeholder="nomor telepon" value="{{old('no_telepon')}}">
                  </div>
              </div>                 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Foto</p>
                  </div>
                  <div class="col-md-8">
                    <input type="file" class="form-control" name="foto" placeholder="foto" value="{{old('foto')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Username</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="username" placeholder="username" value="{{old('username')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px; margin-bottom: 10px;">
                  <div class="col-md-4">
                      <p>Password</p>
                  </div>
                  <div class="col-md-8">
                    <input type="password" class="form-control" name="password" placeholder="password" value="{{old('password')}}">
                  </div>
              </div>          
          </div>
          <div class="row mt-3" >
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('user/admin')}}'">Kembali</button>
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
    <script src="{{asset('lib/highlightjs/highlight.pack.js')}}"></script>
    <script src="{{asset('lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('lib/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('lib/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('lib/jquery/jquery.chained.min.js')}}"></script>

    <script>
        $(function(){

            'use strict';

            $('#datatable1').DataTable({
//                scrollX: true,
                responsive: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });

            // Select2
            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
            $('.select2').select2();

          
            // Datepicker
            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'dd-mm-yy'
            });

        });

    </script>
@endsection
