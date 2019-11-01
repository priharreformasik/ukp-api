@extends('layout')

@section('css')
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Detail Jadwal Konsultasi
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                        <td>Ruangan</td>
                        <td>{{$jadwal->ruangan['nama']}}</td>
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
                        <td>Status</td>
                        <td>{{$jadwal->status['nama']}}</td>
                    </tr>                               
                  </tbody>
              </table>
          </div>
          <div class="row mt-3">
                <div class="col-lg" style="text-align: center">
                  <button type="button" class="btn btn-success" onclick="location.href='{{url('/home')}}'">Kembali</button>
                </div>
          </div>
          </div>              
        </form>
      </div>
    </section>
@endsection

@section('javascript')

@endsection
