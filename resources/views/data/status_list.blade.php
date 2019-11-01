@extends('layout')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection


@section('content-header')
    <section class="content-header">
      <h1>
        Daftar Status
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">Data</a></li>
        <li class="active">Daftar Status</li>
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
              <a href="{{url('data/status/tambah')}}" type="button" class="btn btn-block btn-primary"><i class="fa fa-plus mg-r-10"></i> Tambah Status </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin-right: 15px; margin-left: 15px;">
              <table id="datatable1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th class="text-center" width="30px;">NO</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">DESKRIPSI</th>
                            <th class="text-center"  width="100px;">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $value => $status)                          
                            <tr>
                                <td align="center">{{$value+1}}</td>
                                <td>{{$status->nama}}</td>
                                <td>
                                  @php if($status->deskripsi) echo $status->deskripsi;
                                    else echo "-"; 
                                  @endphp
                                </td>
                                <td align="center">
                                    <div>
                                    <a href="{{url('data/status/'.$status->id.'/edit')}}" class="btn btn-warning" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a>
                                    <a href="{{ url('data/status/'.$status->id.'/delete') }}" class="btn btn-danger btn-sm"
                                       data-tr="tr_{{$status->id}}"
                                       data-toggle="confirmation"
                                       data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                       data-btn-ok-class="btn btn-sm btn-danger"
                                       data-btn-cancel-label="Cancel"
                                       data-btn-cancel-icon="fa fa-chevron-circle-left"
                                       data-btn-cancel-class="btn btn-sm btn-default pull-right"
                                       data-title="Are you sure you want to delete ?"
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
    <script src="{{asset('vendor/sweetsalert/sweetsalert.all.js')}}"></script>

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
