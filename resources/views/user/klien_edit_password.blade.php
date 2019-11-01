@extends('layout')

@section('css')
    <link href="{{asset('lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Edit Password
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">User</a></li>
        <li><a href="{{url('user/klien')}}">Daftar Klien</a></li>
        <li class="{{url(''user/klien/'.$data->id.'/edit'')}}">Edit Data Klien</li>
        <li class="active">Edit Password</li>
      </ol>
    </section>
@stop

@section('content')
    <section class="content">
      @if(count($errors)>0)
          <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <li>
                {{$error}}
              </li>
            @endforeach
          </div>
      @endif
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default" style="padding-top: 30px; ">
        <!-- /.box-header -->
        {!! Form::open(array('url'=>'user/klien/'.$data->id.'/edit', 'method'=>'POST','enctype'=>'multipart/form-data'))!!}
          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:10px;">
                  <div class="col-md-4">
                      <p>Password</p>
                  </div>
                  <div class="col-md-8">
                    <input type="password" class="form-control" name="password" placeholder="" value="{{ old('password') ? old('password') : $data->password }}">
                  </div>
              </div>
        </div>
        {!!Form::close()!!}
      </div>
    </section>
    <!-- /.content -->
@endsection

@section('javascript')
<script src="{{asset('lib/highlightjs/highlight.pack.js')}}"></script>
<script src="{{asset('lib/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('lib/datatables-responsive/dataTables.responsive.js')}}"></script>
<script src="{{asset('lib/select2/js/select2.min.js')}}"></script>

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
                
            });
 

        });
</script>
<script src="{{asset('js/jquery-chained/jquery.chained.remote.js')}}"></script>
@endsection
