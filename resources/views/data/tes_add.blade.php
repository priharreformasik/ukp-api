@extends('layout')

@section('content-header')
    <section class="content-header">
      <h1>
        Tambah Tes
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index3.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="tes_list.html">Data</a></li>
        <li><a href="tes_list.html">Daftar Tes & Tarif</a></li>
        <li class="active">Tambah Tes</li>
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
        {!! Form::open(array('url'=>'data/tes/simpan','method'=>'POST', 'files'=>'true','class'=>'form-horizontal'))!!}
          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Tes</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" placeholder="" value="{{old('nama')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Deskripsi</p>
                  </div>
                  <div class="col-md-8">
                    <textarea class="form-control" name="deskripsi" placeholder="" value="{{old('deskripsi')}}"></textarea>
                  </div>
              </div>             
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:20px;">
                  <div class="col-md-4">
                      <p>Harga</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="harga" placeholder="" value="{{old('harga')}}">
                  </div>
              </div>                             
          </div>
             <div class="row mt-3">
                <div class="col-lg" style="text-align: center ; padding-bottom:10px; ">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('data/tes')}}'">Kembali</button>
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
