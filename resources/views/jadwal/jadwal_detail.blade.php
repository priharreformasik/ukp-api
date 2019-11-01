@extends('layout')

@section('css')
    <link href="{{asset('lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Detail Jadwal Konsultasi
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('jadwal')}}">Jadwal</a></li>
        <li><a href="{{url('jadwal')}}">Daftar Jadwal Konsultasi</a></li>
        <li class="active">Detail Jadwal Konsultasi</li>
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
                        <td>Tanggal</td>
                        <td>{{\Carbon\Carbon::parse($jadwal->tanggal)->format('l, j F Y')}}</td>
                    </tr>
                    <tr>
                        <td>Jam</td>
                        <td>{{$jadwal->sesi['jam']}}</td>
                    </tr> 
                    <tr>
                        <td>Nama Klien</td>
                        <td>{{$jadwal->klien->user['name']}}</td>
                    </tr>
                    <tr>
                        <td>Keluhan</td>
                        <td>{{$jadwal->keluhan}}</td>
                    </tr> 
                    <tr>
                        <td>Layanan</td>
                        <td>{{$jadwal->layanan['nama']}}</td>
                    </tr>                    
                    <tr>
                        <td>Nama Psikolog</td>
                        <td>
                            @if(!$jadwal->psikolog) 
                                    -
                            @else 
                                    {{$jadwal->psikolog->user['name']}} 
                            @endif
                        </td>
                    </tr>                     
                    <tr>
                        <td>Ruangan</td>
                        <td>{{$jadwal->ruangan['nama']}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>{{$jadwal->status['nama']}}</td>
                    </tr>                               
                  </tbody>
              </table>
          </div>
          <div class="row mt-3">
                <div class="col-lg" style="text-align: center">
                  <button type="button" class="btn btn-success" onclick="location.href='{{url('jadwal')}}'">Kembali</button>
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
