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
        Rekap Konsultasi Psikolog
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Rekap Konsultasi</a></li>
        <li class="active">Rekap Konsultasi Psikolog</li>
      </ol>
    </div>
@endsection

@section('content')
<section class="content">

    <div class="box-body">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-success">
            <div class="box-body" style="margin-right: 15px; margin-left: 15px;">
              <div class="box-header with-border">
                  {!! Form::open(array('url'=>'statistik/psikolog_report','method'=>'GET', 'files'=>'true', 'class'=>'form-horizontal'))!!}
                  <input type="hidden" name="psikolog" value="{{$request->psikolog}}">
                  <div class="row pl-5 pr-5">
                      <div class="col-md-2">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="from" type="text" class="form-control" id="datepicker"  placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{\Carbon\Carbon::parse($request->from)->format('Y-m-d')}}" required="">
                          </div>
                      </div>
                      <div class="col-md-2">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="until" type="text" class="form-control" id="datepicker1"  placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{\Carbon\Carbon::parse($request->until)->format('Y-m-d')}}" required="">
                          </div>
                      </div>
                      <div class="col-lg">
                        <button type="submit" class="btn btn-success" >Submit</button>
                      </div>
                  </div>
                  
                  {!!Form::close()!!}
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;margin-bottom: 20px;" align="center">
                  <h4><b>REKAP KONSULTASI PSIKOLOG</b></h4>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px; ">
                  <div class="col-md-2">
                      <p>Nama Psikolog</p>
                  </div>
                      <div class="col-md-10">
                          {{$psikolog->name}}
                      </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Dari</p>
                  </div>
                      <div class="col-md-10">
                          {{\Carbon\Carbon::parse($request->from)->format('l, j F Y')}}
                      </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px; margin-bottom: 20px">
                  <div class="col-md-2">
                      <p>Sampai</p>
                  </div>
                      <div class="col-md-10">
                          {{\Carbon\Carbon::parse($request->until)->format('l, j F Y')}}
                      </div>
              </div>
              <table id="datatable1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">TANGGAL</th>  
                            <th class="text-center">JAM</th> 
                            <th class="text-center">KLIEN</th>
                            <th class="text-center">JENIS LAYANAN</th>
                            <th class="text-center">RUANGAN</th> 
                            <th class="text-center">STATUS</th>

                        </tr>
                </thead>
                  <tbody>  
                    @foreach($list as $value => $jadwal)                        
                    <tr>
                        <td align="center">{{$value+1}}</td>
                        <td>{{\Carbon\Carbon::parse($jadwal->tanggal)->format('l, j F Y')}}</td>
                        <td>{{$jadwal->sesi->jam}}</td>
                        <td>{{$jadwal->klien->user->name}}</td>
                        <td>{{$jadwal->layanan->nama}}</td>
                        <td>{{$jadwal->ruangan['nama']}}</td>
                        <td>{{$jadwal->status->nama}}</td>
                    </tr>
                    @endforeach                                              
                  </tbody>
              </table>
            <div class="row mt-3" style="margin-top:20px;">
                <div class="col-lg" style="text-align: center">
                  <div class="pull-left">
                  <button type="button" class="btn btn-success" onclick="location.href='{{url('statistik/statistik_psikolog')}}'">Kembali</button>
                  </div>
                  <div class="pull-right" style="margin-left: 5px;">
                    {!! Form::open(array('url'=>'/report_perpsikolog/pdf','method'=>'GET','class'=>'form-horizontal')) !!}
                    <input type="hidden" name="psikolog" value="{{$request->psikolog}}">
                    <input type="hidden" name="from" value="{{$request->from}}">
                    <input type="hidden" name="until" value="{{$request->until}}">
                    <button type="submit" class="btn btn-info">Download PDF</button>
                    {!!Form::close()!!}
                  </div>
                  <div class="pull-right">
                  {!! Form::open(array('url'=>'/report_perpsikolog/excel','method'=>'GET','class'=>'form-horizontal')) !!}
                    <input type="hidden" name="psikolog" value="{{$request->psikolog}}">
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

