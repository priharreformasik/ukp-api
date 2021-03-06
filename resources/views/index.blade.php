@extends('layout')

@section('css')
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
   <!-- bootstrap wysihtml5 - text editor -->
   <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection

@section('content-header')
    <div class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </div>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">              
              <h3 id="count-psikolog">{{ $psikolog->count() }}</h3>
              <p>Psikolog</p>              
            </div>
            <div class="icon">              
              <i class="ion ion-person-add"></i>
            </div>            
            <a href="{{url('pengaturan/aproval/psikolog')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="count-pengalihan-psikolog">{{ $pengalihan_psikolog->count() }}</h3>
              <p>Pengalihan Psikolog</p>
            </div>
            <div class="icon">
              <i class="ion ion-calendar"></i>
            </div>
            <a href="{{url('pengaturan/aproval')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="count-waiting">{{ $menunggu_konfirmasi->count() }}</h3>

              <p>Menunggu Konfirmasi</p>
            </div>
            <div class="icon">
              <i class="ion ion-calendar"></i>
            </div>
            <a href="{{url('pengaturan/aproval')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="count-terjadwal">{{ $terjadwal->count() }}</h3>

              <p>Terjadwal</p>
            </div>
            <div class="icon">
              <i class="ion ion-calendar"></i>
            </div>
            <a href="{{url('jadwal')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Konsultasi Hari Ini</h3>
            </div>
            <div class="box-body chart-responsive">
              <!-- <div class="chart" id="bar-chart" style="height: 350px;"></div> -->
              <table id="datatable1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">TANGGAL</th>
                            <th class="text-center">JAM</th>
                            <th class="text-center">NAMA KLIEN</th>
                            <th class="text-center">NAMA PSIKOLOG</th>
                            <!-- <th class="text-center">LAYANAN</th> -->
                            <th class="text-center">RUANGAN</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center" class="wd-10p">ACTION</th>
                        </tr>
                </thead>
                        <tbody> 
                        @foreach($list as $value => $jadwal)                         
                            <tr>
                                <td align="center">{{$counter}}</td>
                                @php $counter++; @endphp   
                                <td>{{\Carbon\Carbon::parse($jadwal->tanggal)->format('l, j F Y')}}</td>
                                <td>{{$jadwal->sesi['jam']}}</td>
                                <td>{{$jadwal->klien->user['name']}}</td>
                                <td>{{$jadwal->psikolog->user['name']}}</td>
                                <!-- <td>{{$jadwal->layanan['nama']}}</td> -->
                                <td>{{$jadwal->ruangan['nama']}}</td>
                                <td>{{$jadwal->nama}}</td>
                                <td align="center">
                                    <div>
                                    <a href="{{url('home/'.$jadwal->id.'/detail')}}" class="btn btn-info btn-icon" style="border-radius:50%;" title="Detail">
                                        <div><i class="fa fa-info" style="margin:5px;"></i></div>
                                    </a>
                                    <a href="{{url('home/'.$jadwal->id.'/edit')}}" class="btn btn-warning" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a>
                                    <!-- <a href="#" class="btn btn-danger" style="border-radius:50%;" onclick="javascript:if(confirm('Yakin ingin hapus data?')){window.location.href='{{ url('jadwal/'.$jadwal->id.'/delete')}}'};" title="Delete">
                                      <div><i class="fa fa-trash" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a> -->
                                    </div>
                                </td>
                            </tr> 
                        @endforeach                           
                        </tbody>
                    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
      </div>
      <!-- /.row (main row) -->
      <!-- Main row -->
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Konsultasi Bulan {{ \Carbon\Carbon::now()->format('F') }}</h3>
            </div>
            <div class="box-body chart-responsive">
              <!-- <div class="chart" id="bar-chart" style="height: 350px;"></div> -->
              {!! $jadwalChart->container() !!}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
       
        <!-- Left col -->
        <section class="col-lg-4 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Layanan Tahun {{ now()->year }}</h3>
            </div>
            <div class="box-body chart-responsive">
              <!-- <div class="chart" id="bar-chart" style="height: 350px;"></div> -->
              {!! $chart->container() !!}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
        <section class="col-lg-4 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Layanan Bulan {{ \Carbon\Carbon::now()->format('F') }}</h3>
<!--               {{ now()->month }}
 -->            </div>
            <div class="box-body chart-responsive" id="setOption">
              <!-- <div class="chart" id="bar-chart" style="height: 350px;"></div> -->
              {!! $lineChart->container() !!}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
        <section class="col-lg-4 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Layanan Minggu Ini</h3>
            </div>
            <div class="box-body chart-responsive">
              <!-- <div class="chart" id="bar-chart" style="height: 350px;"></div> -->
              {!! $barChart->container() !!}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
      </div>

    </section>
@endsection

@section('javascript')
<!-- DataTables -->
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

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
        });


</script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
        {!! $jadwalChart->script() !!}
        {!! $chart->script() !!}
        {!! $lineChart->script() !!}
        {!! $barChart->script() !!}

<script type="text/javascript">
  function loadCounter() {
    $(function() {
       $.getJSON(
        '{{env('APP_URL')}}/api/dashboard',
        function(json){
        // set ke html
        $('#count-pengalihan-psikolog').text(json.result.pengalihan_psikolog);
        $('#count-psikolog').text(json.result.psikolog);
        $('#count-waiting').text(json.result.waiting);
        $('#count-terjadwal').text(json.result.terjadwal);
        });
    })
  }

  $('document').ready(function() {
    setInterval(loadCounter, 10000 );
  })
</script>
<!-- <script type="text/javascript">
 Highcharts.chart( {
    title: {
        "text": "Grafik Konsultasi Per Bulan"
    }
    , subtitle: {
        "text": "UKP UGM"
    }
    , yAxis: {
        "text": "This Y Axis"
    }
    , xAxis: {
        "categories":['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'], 
        "labels": {
            "rotation":15, "align":"top", "formatter":"startJs:function(){return this.value}:endJs"
            }
        }
    }
    , legend: {
        "layout": "vertikal", "align": "right", "verticalAlign": "middle"
    }
    , series: [ {
        'name'=> 'Konsultasi',
        'data'=>[$konsultasi1, $konsultasi2, $konsultasi3, $konsultasi4, $konsultasi5, $konsultasi6, $konsultasi7, $konsultasi8, $konsultasi9, $konsultasi10, $konsultasi11, $konsultasi12]
    }
    ], chart: {
        "type": "line", "renderTo": "chart1"
    }
    , colors: ["#0c2959"], credits:false
}

);
</script> -->
@endsection
