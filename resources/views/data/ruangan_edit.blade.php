@extends('layout')

@section('css')
    <link href="{{asset('lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection


@section('content-header')
    <section class="content-header">
      <h1>
        Edit Ruangan
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">Data</a></li>
        <li><a href="{{url('data/ruangan')}}">Daftar Ruangan</a></li>
        <li class="active">Edit Ruangan</li>
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
        {!! Form::open(array('url'=>'data/ruangan/'.$data->id.'/edit', 'method'=>'POST','class'=>'form-horizontal'))!!}
          <div class="box-body" style="padding-left: 200px; padding-right: 100px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px;  padding-bottom:10px;">
                  <div class="col-md-2">
                      <p>Ruangan</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" placeholder="" value="{{ old('nama') ? old('nama') : $data->nama }}">
                  </div>
              </div>  
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:10px;">
                  <div class="col-md-2">
                      <p>Deskripsi</p>
                  </div>
                  <div class="col-md-8">
                    <textarea class="form-control" name="deskripsi" placeholder="">{{ old('deskripsi') ? old('deskripsi') : $data->deskripsi }}</textarea>
                  </div>
              </div>                                        
          </div>
              <div class="row mt-3">
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('data/ruangan')}}'">Kembali</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
              </div> 
        </div>              
        {!!Form::close()!!}
      </div>
    </section>
@endsection

@section('javascript')
<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
  })
</script>
@endsection

