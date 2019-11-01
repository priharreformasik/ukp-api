@extends('layout')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection


@section('content-header')
    <section class="content-header">
      <h1>
        Daftar Pesan
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/pengaturan/pesan')}}">Pengaturan</a></li>
        <li class="active">Daftar Pesan</li>
      </ol>
    </section>
@endsection

@section('content')
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="col-sm-4 col-md-2" style="margin-top: 10px; ">
              <a href="{{url('pengaturan/pesan/tambah')}}" type="button" class="btn btn-block btn-primary"><i class="fa fa-plus mg-r-10"></i> Tulis Pesan</a>
              </div>
            </div>
          
            <div class="box-body" style="margin-right: 15px; margin-left: 15px;">
              <table id="datatable1" class="table display table-bordered">
                <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center" width="150px;">TANGGAL</th>
                            <th class="text-center">SUBJECT</th>
                            <th class="text-center">PENERIMA</th>
                            <th class="text-center" width="200px;">PESAN</th>
                            <th class="text-center" class="wd-10p">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>                          
                            @foreach($list as $value => $pesan)                         
                            <tr>
                                <td align="center">{{$value+1}}</td>
                                <td>{{\Carbon\Carbon::parse($pesan->updated_at)->format('l, j F Y h:m:s')}}</td>
                                <td>{{$pesan->subject}}</td>
                                <td>
                                  @foreach($pesan->user as $value)
                                    <li>{{$value->name."-".$value->level}}</li>
                                  @endforeach
                                </td>
                                <td>{{$pesan->pesan}}</td>
                                <td align="center">
                                    <div>
                                    <!-- <a href="{{url('pesan/'.$pesan->id.'/detail')}}" class="btn btn-info btn-icon" style="border-radius:50%;" title="Detail">
                                        <div><i class="fa fa-info" style="margin:5px;"></i></div>
                                    </a> -->
                                    <!-- <a href="{{url('pesan/'.$pesan->id.'/edit')}}" class="btn btn-warning" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a> -->
                                    <!-- <a href="#" class="btn btn-danger" style="border-radius:50%;" onclick="javascript:if(confirm('Yakin ingin hapus data?')){window.location.href='{{ url('pesan'.$pesan->id.'/delete')}}'};" title="Delete">
                                      <div><i class="fa fa-trash" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a> -->
                                    <a href="{{ url('pengaturan/pesan/'.$pesan->id.'/delete') }}" class="btn btn-danger btn-sm"
                                       data-tr="tr_{{$pesan->id}}"
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
