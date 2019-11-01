@extends('layout')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection


@section('content-header')
    <div class="content-header">
      <h1>
        Daftar Psikolog
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active">Psikolog</li>
      </ol>
    </div>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="col-sm-4 col-md-2" style="margin-top: 10px; ">
              <a href="{{url('user/psikolog/tambah')}}" type="button" class="btn btn-block btn-primary"><i class="fa fa-plus mg-r-10"></i> Tambah Psikolog</a>
              </div>
              <div class="pull-right" style="margin-top: 10px; margin-left: 5px; margin-right: 15px;">
              <a href="{{url('psikolog/pdf')}}" type="button" class="btn btn-block btn-primary"><i class="fa fa-download mg-r-10"></i> Download PDF</a>
              </div>
              <div class="pull-right" style="margin-top: 10px; ">
              <a href="{{url('user/psikolog/excel')}}" type="button" class="btn btn-block btn-primary"><i class="fa fa-download mg-r-10"></i> Download Excel</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin-right: 15px; margin-left: 15px;">
              <table id="datatable1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NAMA</th>
                            <th class="text-center" width="20px;">JENIS KELAMIN</th>
                            <th class="text-center">TANGGAL LAHIR</th>
                            <th class="text-center">NIK</th>
                            <th class="text-center">ALAMAT</th>
                            <th class="text-center">N0 TELP</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center" class="wd-10p" width="130px;">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>  
                        @foreach($list as $value => $psikolog)             
                            <tr>
                                <td align="center">{{$counter}}</td>
                                @php $counter++; @endphp      
                                <td>{{$psikolog->name}}</td>
                                <td>{{$psikolog->jenis_kelamin}}</td>
                                <td> {{\Carbon\Carbon::parse($psikolog->tanggal_lahir)->format('j F Y')}} </td>
                                <td>{{$psikolog->nik}}</td>
                                <td>{{$psikolog->alamat}}</td>
                                <td>{{$psikolog->no_telepon}}</td>
                                <td align="center">
                                  @if($psikolog->isActive=="Aktif")
                                    <a style="border-radius:50%;"  href="javascript:if(confirm('Yakin ingin menonaktifkan status?')){window.location.href='{{ url('user/psikolog/'.$psikolog->id.'/status')}}'};" onclick="" class="btn bg-olive btn-xs" title="Aktif" >
                                        <div><i class="fa fa-toggle-on" style="margin:9px 6px 9px 6px;"></i></div>
                                    </a>
                                  @else
                                    <a style="border-radius:50%;" href="javascript:if(confirm('Yakin ingin mengaktifkan status?')){window.location.href='{{ url('user/psikolog/'.$psikolog->id.'/status')}}'};" onclick="" class="btn bg-maroon btn-xs" title="Tidak Aktif">
                                      <div><i class="fa fa-toggle-off" style="margin:9px 6px 9px 6px;"></i></div>
                                    </a>
                                  @endif
                                </td>
                                <td align="center">
                                    <div>
                                    <a href="{{url('user/psikolog/'.$psikolog->id.'/detail')}}" class="btn btn-info btn-icon" style="border-radius:50%;" title="Detail">
                                        <div><i class="fa fa-info" style="margin:5px;"></i></div>
                                    </a>
                                    <a href="{{url('user/psikolog/'.$psikolog->id.'/edit')}}" class="btn btn-warning" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a>
                                    <!-- <a href="#" class="btn btn-danger" style="border-radius:50%;" onclick="javascript:if(confirm('Yakin ingin hapus data?')){window.location.href='{{ url('user/psikolog/'.$psikolog->id.'/delete')}}'};" title="Delete">
                                      <div><i class="fa fa-trash" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a> -->
                                    <a href="{{ url('user/psikolog/'.$psikolog->id.'/delete') }}" class="btn btn-danger btn-sm"
                                       data-tr="tr_{{$psikolog->id}}"
                                       data-toggle="confirmation"
                                       data-btn-ok-label="Hapus" data-btn-ok-icon="fa fa-remove"
                                       data-btn-ok-class="btn btn-sm btn-danger"
                                       data-btn-cancel-label="Kembali"
                                       data-btn-cancel-icon="fa fa-chevron-circle-left"
                                       data-btn-cancel-class="btn btn-sm btn-default pull-right"
                                       data-title="Apakah Anda yakin ingin menghapus ?"
                                       data-placement="left" data-singleton="true"
                                       style="border-radius:50%;" >
                                       <div><i class="fa fa-trash" style="margin:6px 4px 6px 4px;"></i></div>
                                    </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach                                     
                        </tbody>
                    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
@endsection
