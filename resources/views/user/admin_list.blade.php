@extends('layout')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection


@section('content-header')
    <div class="content-header">
      <h1>
        Daftar Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active">Daftar Admin</li>
      </ol>
    </div>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">

    <!-- @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
    @endif
    @if ($message = Session::get('warning'))
      <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
    @endif -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="col-sm-4 col-md-2" style="margin-top: 10px; ">
              <a href="{{url('user/admin/tambah')}}" type="button" class="btn btn-block btn-primary"><i class="fa fa-plus mg-r-10"></i> Tambah Admin</a>
              </div>
              <!-- <div class="col-sm-4 col-md-2" style="margin-top: 10px; float:right; ">
              <a href="{{url('user/admin')}}" type="button" class="btn btn-block btn-primary"><i class="fa fa-print mg-r-10"></i> Print</a>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin-right: 15px; margin-left: 15px;">
              <table id="datatable1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NAMA</th>
                            <th class="text-center" width="20px;">JENIS KELAMIN</th>
                            <th class="text-center" width="100px;">TANGGAL LAHIR</th>
                            <th class="text-center">NIK</th>
                            <th class="text-center">ALAMAT</th>
                            <th class="text-center" width="25px;">N0 TELP</th>
                            <!-- <th class="text-center" width="25px;">LEVEL</th> -->
                            <th class="text-center" class="wd-10p" width="150px;">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>  
                        @foreach($list as $value => $admin)                        
                            <tr>
                                <td align="center">{{$counter}}</td>
                                @php $counter++; @endphp   
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->jenis_kelamin}}</td>
                                <td> {{$admin->tanggal_lahir->format('j F Y')}} </td>
                                <td>{{$admin->nik}}</td>
                                <td>{{$admin->alamat}}</td>
                                <td>{{$admin->no_telepon}}</td>
                                <!-- <td>{{$admin->level}}</td> -->
                                <td align="center">
                                    <div>
                                    <a href="{{url('user/admin/'.$admin->id.'/detail')}}" class="btn btn-info btn-icon" style="border-radius:50%;" title="Detail">
                                        <div><i class="fa fa-info" style="margin:5px;"></i></div>
                                    </a>
                                    <a href="{{url('user/admin/'.$admin->id.'/edit')}}" class="btn btn-warning" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a>
                                    @if (Auth::user()->level == 'Super Admin')
                                    <a href="#" class="btn btn-danger" style="border-radius:50%;" onclick="javascript:if(confirm('Yakin ingin hapus data?')){window.location.href='{{ url('user/admin/'.$admin->id)}}'};" title="Delete">
                                      <div><i class="fa fa-trash" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a>
                                    @endif
                                    <!-- <button class="delete-modal btn btn-danger" style="border-radius:50%;" data-id="{{$admin->id}}">
                                      <div><i class="fa fa-trash" style="margin:5px 2px 5px 2px;"></i></div>
                                    </button> -->
                                    
                                    <!-- <a href="{{ url('user/admin/'.$admin->id.'/delete') }}" class="btn btn-danger btn-sm"
                                       data-tr="tr_{{$admin->id}}"
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
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div id="deleteModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-body text-center">
          <i class="fa fa-4x fa-trash"></i>
          <h6>Yakin ingin hapus data?</h6>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger delete" data-dismiss="modal">Ok</button>
        </div>
      </div>
      </div>
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
    <script type="text/javascript">
        var id;
        var id_to_delete;
        $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Hapus');
            $('#deleteModal').modal('show');
            id_to_delete = $(this).data('id');
            // console.log(id_to_delete);
        });
        $('.modal-body').on('click', '.delete', function() {
          // console.log("click");
            $.ajax({
                type: 'GET',
                headers: {
                  'Accept': 'application/json'
                },
                url: '{{ env('APP_URL') }}/user/admin/' + id_to_delete,
                success: function(data) {
                  console.log("coba"+data);
                    location.reload();
                    // toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
                    $('.item-' + id_to_delete).remove();
                    $('.col1').each(function (index) {
                        $(this).html(index+1);
                    });
                }
            });
        });
    </script>
@endsection
