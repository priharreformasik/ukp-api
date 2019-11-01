@extends('layout')

@section('css')
    <link href="{{asset('lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Detail Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">User</a></li>
        <li><a href="{{url('user/admin')}}">Daftar Admin</a></li>
        <li class="active">Detail Admin</li>
      </ol>
    </section>
@stop
@section('content')
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default" style="padding-top: 30px; ">
        <!-- /.box-header -->
        <form class="form-horizontal">
          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="col-md-12">
              <table class="table display responsive nowrap ">
                  <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>{{$admin->name}}</td>
                        <td rowspan="7" align="center"><img class="img-detail" src="{{url('images/'.$admin->foto)}}" class="img-responsive" style="width: 150px;"></td>
                    </tr>
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
                    <!-- <tr>
                        <td>Password</td>
                        <td>{{$admin->password}}</td>
                    </tr> --> 
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>{{$admin->no_telepon}}</td>
                    </tr>                   
                  </tbody>
              </table>
          </div>
          <div class="row mt-3">
                <div class="col-lg" style="text-align: center">
                  <button type="button" class="btn btn-success" onclick="location.href='{{url('user/admin')}}'">Kembali</button>
                </div>
          </div>
          </div>              
        </form>
      </div>
    </section>
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
