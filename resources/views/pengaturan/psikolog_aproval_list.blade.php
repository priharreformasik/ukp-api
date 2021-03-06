@extends('layout')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection


@section('content-header')
    <div class="content-header">
      <h1>
        Approval Psikolog
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengaturan</a></li>
        <li class="active">Approval Psikolog</li>
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
                            <th class="text-center" class="wd-10p">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>  
                        @foreach($list as $value => $psikolog)             
                            <tr>
                                <td align="center">{{$counter}}</td>
                                @php $counter++; @endphp      
                                <td>{{$psikolog->name}}</td>
                                <td>{{$psikolog->jenis_kelamin}}</td>
                                <td> {{\Carbon\Carbon::parse($psikolog->tanggal_lahir)->format('l, j F Y')}} </td>
                                <td>{{$psikolog->nik}}</td>
                                <td>{{$psikolog->alamat}}</td>
                                <td>{{$psikolog->no_telepon}}</td>
                                <td align="center">
                                    <div>
                                    @if($psikolog->status=="Sudah Diapprove")
                                    <a style="border-radius:50%;"  href="javascript:if(confirm('Yakin ingin menonaktifkan status psikolog?')){window.location.href='{{ url('pengaturan/aproval/psikolog/'.$psikolog->id.'/status')}}'};" onclick="" class="btn bg-olive btn-xs" title="Sudah Diapprove" >
                                        <div><i class="fa fa-toggle-on" style="margin:9px 6px 9px 6px;"></i></div>
                                    </a>
                                  @else
                                    <a style="border-radius:50%;" href="javascript:if(confirm('Yakin ingin mengaktifkan status?')){window.location.href='{{ url('pengaturan/aproval/psikolog/'.$psikolog->id.'/status')}}'};" onclick="" class="btn bg-maroon btn-xs" title="Belum Diaprove">
                                      <div><i class="fa fa-toggle-off" style="margin:9px 6px 9px 6px;"></i></div>
                                    </a>
                                  @endif
                                    <a href="{{url('pengaturan/aproval/psikolog/'.$psikolog->id.'/detail')}}" class="btn btn-info btn-icon" style="border-radius:50%;" title="Detail">
                                        <div><i class="fa fa-info" style="margin:4px;"></i></div>
                                    </a>
                                    <!-- <a href="#" class="btn btn-danger" style="border-radius:50%;" onclick="javascript:if(confirm('Yakin ingin hapus data?')){window.location.href='{{ url('user/psikolog/'.$psikolog->id.'/delete')}}'};" title="Delete">
                                      <div><i class="fa fa-trash" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a> -->
                                    <a href="{{ url('pengaturan/aproval/psikolog/'.$psikolog->id.'/delete') }}" class="btn btn-danger btn-sm"
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
