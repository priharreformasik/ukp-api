@extends('layout')

@section('css')
    <link href="{{asset('lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Detail Psikolog
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">User</a></li>
        <li><a href="{{url('user/psikolog')}}">Daftar Psikolog</a></li>
        <li class="active">Detail Psikolog</li>
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
                        <td>{{$user->name}}</td>
                        <td rowspan="8" align="center">
                            @if (!$user->foto)
                              <img class="img-detail" src="{{asset('images/user.png')}}" class="img-responsive" style="width: 150px;">
                            @else
                              <img class="img-detail" src="{{url('images/'.$user->foto)}}" class="img-responsive" style="width: 150px;">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>{{$user->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <!-- <td>{{\Carbon\Carbon::parse($user->tanggal_lahir)->format('d-m-y')}}</td> -->
                        <td> {{\Carbon\Carbon::parse($user->tanggal_lahir)->format('l, j F Y')}} </td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>{{$user->nik}}</td>
                    </tr>
                    
                    <tr>
                        <td>Nomor SIPP</td>
                        <td>{{$user->psikolog['no_sipp']}}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{$user->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>{{$user->no_telepon}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>{{$user->username}}</td>
                    </tr>  
                    <!-- <tr>
                        <td>Password</td>
                        <td>{{$user->password}}</td>
                    </tr> -->   
                   <!--  <tr>
                        <td>Keahlian</td>
                        <td>
                            @if(!$user->psikolog->keahlian_id) 
                                -
                            @else 
                                {{$user->psikolog->keahlian['nama']}} 
                            @endif
                        </td>
                    </tr>  -->  
                    <tr>
                        <td>Keahlian</td>
                        <td>
                            @foreach($user->psikolog->layanan as $value)
                                <li>{{$value->nama}}</li>
                            @endforeach
                        </td>
                    </tr>  
                    <tr>
                        <td>Status</td>
                        <td>{{$user->isActive}}</td>
                    </tr>                
                  </tbody>
              </table>
          </div>
          <div class="row mt-3">
                <div class="col-lg" style="text-align: center">
                  <button type="button" class="btn btn-success" onclick="location.href='{{url('user/psikolog')}}'">Kembali</button>
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
