@extends('layout')

@section('css')
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Edit Foto
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">User</a></li>
        <li><a href="{{url('user/klien')}}">Daftar Klien</a></li>
        <li><a href="{{url('user/klien/'.$data->id.'/edit')}}">Edit Data Klien</a></li>
        <li class="active">Edit Foto</li>
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
        {!! Form::open(array('url'=>'user/klien/'.$data->id.'/edit_foto', 'method'=>'POST','enctype'=>'multipart/form-data'))!!}
          <div class="box-body" style="padding-left: 200px; padding-right: 200px;">
            <div class="col-md-12 pl-5 pr-5">
              
              <div class="row pl-5 pr-5" style="margin-top: 5px; margin-bottom: 20px;">
                  <div class="col-md-2">
                      <p>Foto</p>
                  </div>
                  <div class="col-md-10">
                    <input type="file" class="form-control" name="foto" placeholder="" value="{{old('foto') ? old('foto') : $data->foto}}">
                  </div>
              </div>                            
          </div>
          <div class="row mt-3">
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('user/klien/'.$data->id.'/edit')}}'">Kembali</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
          </div>
        </div>
        {!!Form::close()!!}
      </div>
    </section>
    <!-- /.content -->
@endsection

@section('javascript')

@endsection
