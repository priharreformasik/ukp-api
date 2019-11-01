@extends('layout')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection

@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <h1>
        Rekap Konsultasi Klien
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Rekap Konsultasi</a></li>
        <li class="active">Rekap Konsultasi Klien</li>
      </ol>
    </div>
@endsection

@section('content')
<section class="content">

    <div class="box-body">
      <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Grafik Konsultasi Berdasarkan Klien</h3>
                </div>
                {!! Form::open(array('url'=>'statistik/report_all_klien','method'=>'POST', 'files'=>'true', 'class'=>'form-horizontal'))!!}

                <div class="row pl-5 pr-5"  style="margin-left:20px; margin-top:5px;">
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                <input name="from" type="text" class="form-control fc-datepicker" id="datepicker"  placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{old('from')}}" required="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                <input name="until" type="text" class="form-control fc-datepicker" id="datepicker"  placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{old('until')}}" required="">
                            </div>
                        </div>
                  <div class="col-lg" style="text-align: left;margin-left: 50px;">
                    <button type="submit" class="btn btn-success" >Submit</button>
                  </div>
                </div>
                {!!Form::close()!!}
                <div class="box-body chart-responsive">
                  <!-- <div class="chart" id="bar-chart" style="height: 350px;"></div> -->
                  {!! $chart->container() !!}
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.nav-tabs-custom -->
            </section>
        </div>
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-success">
            <div class="box-body" style="margin-right: 15px; margin-left: 15px;">
              <div class="row pl-5 pr-5" style="margin-top: 5px;margin-bottom: 20px;" align="center">
                  <b>REKAP KONSULTASI KLIEN</b><br>
                  <b>UNIT KONSULTASI PSIKOLOGI</b><br>
                  <b>FAKULTAS PSIKOLOGI UGM</b><br><br>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-1">
                      <p>Dari</p>
                  </div>
                      <div class="col-md-11">
                          {{\Carbon\Carbon::parse($request->from)->format('l, j F Y')}}
                      </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px; margin-bottom: 20px">
                  <div class="col-md-1">
                      <p>Sampai</p>
                  </div>
                      <div class="col-md-11">
                          {{\Carbon\Carbon::parse($request->until)->format('l, j F Y')}}
                      </div>
              </div>

              <table id="datatable1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NAMA KLIEN</th>
                            <th class="text-center">TANGGAL</th>
                            <th class="text-center">JAM</th>
                            <th class="text-center">JENIS KELAMIN</th>
                            <th class="text-center">KATEGORI KLIEN</th>
                            <th class="text-center">NAMA PSIKOLOG</th>
                            <th class="text-center">JENIS LAYANAN</th>
                        </tr>
                </thead>
                  <tbody>  
                    @foreach($list as $value => $jadwal)                        
                    <tr>
                        <td align="center">{{$value+1}}</td>
                        <td>{{$jadwal->klien->user->name}}</td>
                        <td>{{\Carbon\Carbon::parse($jadwal->tanggal)->format('l, j F Y')}}</td>
                        <td>{{$jadwal->sesi->jam}}</td>
                        <td>{{$jadwal->klien->user->jenis_kelamin}}</td>
                        <td>
                            @if(!$jadwal->klien) 
                                -
                            @else 
                                    {{$jadwal->klien->kategori['nama']}} 
                            @endif
                        </td>
                        <td>{{$jadwal->psikolog->user->name}}</td>
                        <td>{{$jadwal->layanan->nama}}</td>
                    </tr>
                    @endforeach                                              
                  </tbody>
              </table>
            <div class="row mt-3" style="margin-top:20px;">
                <div class="col-lg" style="text-align: center">
                  <div class="pull-left">
                  <button type="button" class="btn btn-success" onclick="location.href='{{url('statistik/statistik_klien')}}'">Kembali</button>
                  </div>
                  <div class="pull-right" style="margin-left: 5px;">
                  {!! Form::open(array('url'=>'/report_klien/pdf','method'=>'GET','class'=>'form-horizontal')) !!}
                  <!-- <input type="hidden" name="layanan" value="{{$request->layanan}}"> -->
                  <input type="hidden" name="from" value="{{$request->from}}">
                  <input type="hidden" name="until" value="{{$request->until}}">
                  <button type="submit" class="btn btn-info">Download PDF</button>
                  {!!Form::close()!!}
                </div>
                <div class="pull-right">
                  {!! Form::open(array('url'=>'/report_klien/excel','method'=>'GET','class'=>'form-horizontal')) !!}
                  <!-- <input type="hidden" name="layanan" value="{{$request->layanan}}"> -->
                    <input type="hidden" name="from" value="{{$request->from}}">
                    <input type="hidden" name="until" value="{{$request->until}}">
                    <button type="submit" class="btn btn-info">Download Excel</button>
                  {!!Form::close()!!}
                  </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- /.nav-tabs-custom -->
        </section>
      </div>
      <!-- /.row (main row) -->
    </div>

    </section>
    <!-- /.content -->
@endsection

@section('javascript')
<!-- DataTables -->
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
     <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
        {!! $chart->script() !!}
    <script>
         $(function(){
            'use strict';

            $('#datatable1').DataTable({
                //scrollX: true,
                responsive: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });
        });
    </script>
@endsection

