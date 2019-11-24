@extends('layout')

@section('css')
    <link href="{{asset('lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection


@section('content-header')
    <section class="content-header">
      <h1>
        Edit Jenis Asesmen
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">Data</a></li>
        <li><a href="{{url('data/asesmen')}}">Daftar Asesmen</a></li>
        <li class="active">Edit Jenis Asesmen</li>
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
        {!! Form::open(array('url'=>'data/asesmen/'.$data->id.'/edit', 'method'=>'POST'))!!}
          <div class="box-body" style="padding-left: 70px; padding-right: 30px;">
            <div class="col-md-10 pl-5 pr-5" style="padding-left: 80px; ">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Asesmen</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" placeholder="" value="{{ old('nama') ? old('nama') : $data->nama }}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Deskripsi</p>
                  </div>
                  <div class="col-md-8">
                    <textarea class="form-control" name="deskripsi" placeholder="">{{ old('deskripsi') ? old('deskripsi') : $data->deskripsi }}</textarea>
                  </div>
              </div>                
              <div class="row pl-5 pr-5" style="margin-top: 5px; margin-bottom: 10px;">
                  <div class="col-md-2">
                      <p>Harga</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="harga" placeholder="" value="{{ old('harga') ? old('harga') : $data->harga }}">
                  </div>
              </div>   
              <div class="row pl-5 pr-5" style="margin-top: 5px; margin-bottom: 10px;">
                  <div class="col-md-2">
                      <p>Layanan</p>
                  </div>
                  <div class="col-md-8">
                        <select class="form-control select2" name="layanan_id">
                          @if(! $data->layanan_id) 
                            <option value="">Pilih layanan</option>
                            @foreach($layanan as $value)
                                <option value="{{$value->id}}" {{collect(old('layanan'))->contains($value->id) ? 'selected':''}}>{{$value->nama}}</option>
                            @endforeach
                          @else
                            @foreach($layanan as $value)
                                <option value="{{$value->id}}" {{collect(old('layanan'))->contains($value->id) ? 'selected':''}} @if($value->id == $data->layanan_id) selected='selected' @endif>{{$value->nama}}</option>
                            @endforeach
                          @endif
                        </select>
                  </div>
              </div>                                       
          </div>
        </div>
              <div class="row mt-3">
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('data/asesmen')}}'">Kembali</button>
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
