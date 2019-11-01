@extends('layout')

@section('css')
    <link href="{{asset('lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Detail Klien
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">User</a></li>
        <li><a href="{{url('user/klien')}}">Daftar Klien</a></li>
        <li class="active">Detail Klien</li>
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
                        <td>Nama</td>
                        <td>{{$user->name}}</td>
                        <td rowspan="8" align="center">
                        @if (!$user->foto)
                            <img class="img-detail" src="{{asset('images/user.png')}}" class="img-responsive" style="width: 150px;">
                        @else
                            <img class="img-detail" src="{{url('images/'.$user->foto)}}" class="img-responsive" style="width: 150px;">
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>{{$user->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>{{\Carbon\Carbon::parse($user->tanggal_lahir)->format('l, j F Y')}} </td>
                    </tr>
                    <tr>
                        <td>Anak ke</td>
                        <td>{{$user->klien['anak_ke']}}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Saudara</td>
                        <td>{{$user->klien['jumlah_saudara']}}</td>
                    </tr>
                    <tr>
                        <td>Pendidikan Terakhir</td>
                        <td>{{$user->klien['pendidikan_terakhir']}}</td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>
                            @php if($user->nik) echo $user->nik;
                                else echo "-"; 
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>
                            @php if($user->alamat) echo $user->alamat;
                                else echo "-"; 
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>
                            @php if($user->no_telepon) echo $user->no_telepon;
                                else echo "-"; 
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            @php if($user->email) echo $user->email;
                                else echo "-"; 
                            @endphp
                        </td>
                    </tr>  
                    <tr>
                        <td>Username</td>
                        <td>
                            @php if($user->username) echo $user->username;
                                else echo "-"; 
                            @endphp
                        </td>
                    </tr>  
                    <tr>
                        <td>Kategori klien</td>
                        <td>
                            @if(!$user->klien->kategori_id) 
                                -
                            @else 
                                {{$user->klien->kategori['nama']}} 
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Didaftarkan Oleh</td>
                        <td>
                            @php if($user->klien->parent_id) echo $user->klien->parent->user->name;
                                else echo "-"; 
                            @endphp
                        </td>
                    </tr>  
                    <tr>
                        <td>Hubungan pendaftar</td>
                        <td>
                            @php if($user->klien->hub_pendaftar) echo $user->klien->hub_pendaftar;
                                else echo "-"; 
                            @endphp
                        </td>
                    </tr>                      
                  </tbody>
              </table>
          </div>
          <div class="row mt-3">
                <div class="col-lg" style="text-align: center">
                  <button type="button" class="btn btn-success" onclick="location.href='{{url('user/klien')}}'">Kembali</button>
                </div>
          </div>
          </div>              
        </form>
      </div>
    </section>
@endsection

@section('javascript')
    <script src="{{asset('lib/highlightjs/highlight.pack.js')}}"></script>
    <script src="{{asset('lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('lib/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('lib/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('lib/jquery/jquery.chained.min.js')}}"></script>



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

            // Select2
            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
            $('.select2').select2();

            // Datepicker
            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'dd-mm-yy'
            });

        });

    </script>
@endsection
