@extends('layout')

@section('css') 
  <link rel="stylesheet" type="text/css" href="{{asset('components/timepicker/jquery.timepicker.css')}}" />
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Tambah Sesi
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">Data</a></li>
        <li><a href="{{url('data/sesi')}}">Daftar Sesi</a></li>
        <li class="active">Tambah Sesi</li>
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
        {!! Form::open(array('url'=>'data/sesi/simpan','method'=>'POST', 'files'=>'true','class'=>'form-horizontal'))!!}
          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:10px;">
                  <div class="col-md-4">
                      <p>Nama</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" placeholder="Nama sesi" value="{{old('nama')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:10px;">
                  <div class="col-md-4">
                      <p>Jam</p>
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control"  id="timeformatExample1"  name="jam1" placeholder="00:00" value="{{old('jam1')}}">
                  </div>
                  <div class="col-md-1" align="center">
                    -
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control"  id="timeformatExample2"  name="jam2" placeholder="00:00" value="{{old('jam2')}}">
                  </div>
              </div>                                          
              </div>             
                <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:10px;">
                     <div class="col-md-4">
                        <p>Layanan</p>
                    </div>
                    <div class="col-md-8">
                      <select class="form-control select2" multiple="true" name="layanan_id[]" placeholder="Pilih Layanan">
                          @foreach($layanan as $value)
                              <option value="{{$value->id}}" {{collect(old('layanan'))->contains($value->id) ? 'selected':''}}>{{$value->nama}}</option>
                          @endforeach
                      </select>
                    </div>
                </div>       

          <div class="row mt-3">
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('data/sesi')}}'">Kembali</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
              </div>
        </div>
        {!!Form::close()!!}
      </div>
    </section>
@endsection

@section('javascript')

<script type="text/javascript" src="{{asset('components/timepicker/jquery.timepicker.js')}}"></script>
<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
  })

  $(function() {
       $('#timeformatExample1').timepicker({ 
        'step': 15,
        'timeFormat': 'h:i A'
      });
      $('#timeformatExample2').timepicker({ 
        'step': 15,
        'timeFormat': 'h:i A'
      });
  
  });
</script>
@endsection
