@extends('layout')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet" />
@endsection

@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <h1>
        Daftar Klien
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active">Klien</li>
      </ol>
    </div>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- @if(Session::has('info'))
        <div class="modal fade show" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header alert-info" align="center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <i class="fa fa-check-circle fa-3x"></i><br>
              {{ Session::get('info') }}
            </div>
          </div>
        </div>
      </div>
      @endif -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="col-sm-4 col-md-2" style="margin-top: 10px; ">
              <a href="{{url('user/klien/tambah')}}" type="button" class="btn btn-block btn-primary"><i class="fa fa-plus mg-r-10"></i> Tambah Klien</a>
              </div>
              <div class="pull-right" style="margin-top: 10px; margin-left: 5px; margin-right: 15px;">
              <a href="{{ URL::to('/klien/pdf') }}" type="button" class="btn btn-block btn-primary"><i class="fa fa-download mg-r-10"></i> Download PDF</a>
              </div>
              <div class="pull-right" style="margin-top: 10px;">
              <a href="{{ URL::to('/user/klien/excel') }}" type="button" class="btn btn-block btn-primary"><i class="fa fa-download mg-r-10"></i> Download Excel</a>
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
                            <th class="text-center">DIDAFTARKAN OLEH</th>
                            <th class="text-center">NIK</th>
                            <th class="text-center">ALAMAT</th>
                            <th class="text-center">N0 TELP</th>
                            <th class="text-center" class="wd-10p"  width="180px;">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>  
                        @foreach($list as $value => $klien)                        
                            <tr>
                                <td align="center">{{$counter}}</td>
                                @php $counter++; @endphp   
                                <td>{{$klien->name}}</td>
                                <td>{{$klien->jenis_kelamin}}</td>
                                <td align="center">
                                    @php if($klien->parent_id) echo $klien->parent->user->name;
                                        else echo "-"; 
                                    @endphp
                                </td>
                                <td align="center">
                                  @php if($klien->nik) echo $klien->nik;
                                    else echo "-"; 
                                  @endphp
                                </td>
                                <td align="center">
                                  @php if($klien->alamat) echo $klien->alamat;
                                    else echo "-"; 
                                  @endphp
                                </td>
                                <td align="center">
                                  @php if($klien->no_telepon) echo $klien->no_telepon;
                                    else echo "-"; 
                                  @endphp
                                </td>
                                <td align="center">
                                    <div>
                                    <a href="{{url('user/klien/'.$klien->id.'/detail')}}" class="btn btn-info btn-icon" style="border-radius:50%;" title="Detail">
                                        <div><i class="fa fa-info" style="margin:5px;"></i></div>
                                    </a>
                                    @if(!($klien->parent_id))
                                    <a href="{{url('user/klien/'.$klien->id.'/edit')}}" class="btn btn-warning" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a>
                                    @else
                                    <a href="{{url('user/pendaftar/'.$klien->id.'/edit')}}" class="btn btn-warning" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a>
                                    @endif
                                    <!-- <a href="#" class="btn btn-danger" style="border-radius:50%;" onclick="javascript:if(confirm('Yakin ingin hapus data?')){window.location.href='{{ url('user/klien/'.$klien->id.'/delete')}}'};" title="Delete">
                                      <div><i class="fa fa-trash" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a> -->
                                    <a href="{{ url('user/klien/'.$klien->id.'/delete') }}" class="btn btn-danger btn-sm"
                                       data-tr="tr_{{$klien->id}}"
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
                                    @if(!($klien->parent_id))
                                    <a href="{{url('user/pendaftar/'.$klien->id.'/tambah')}}" class="btn btn-success btn-icon" style="border-radius:50%;" title="Tambah">
                                        <div><i class="fa fa-plus" style="margin:5px 2px 5px 2px;;"></i></div>
                                    </a>
                                    @else
                                      <button class="btn btn-default btn-icon child" style="border-radius:50%;" title="Tambah">
                                        <div><i class="fa fa-plus" style="margin:5px 2px 5px 2px;;"></i></div>
                                    </button>
                                    @endif
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.child', function() {
            toastr.error('Klien tidak dapat melakukan pendaftaran klien lain!', 'Peringatan!', {timeOut: 5000});
        });
    </script>


    
@endsection