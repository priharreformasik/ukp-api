@extends('layout')

@section('content-header')
    <section class="content-header">
      <h1>
        TRANSAKSI
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Transaksi</li>
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
          <div class="box-body">
            <div class="col-md-6 pl-5 pr-5" style="float:left">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>ID Transaksi</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" placeholder="Asesmen" value="{{old('nama')}}">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Klien</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="harga" placeholder="Harga" value="{{old('harga')}}">
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Tanggal</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="total" placeholder="Harga" value="{{old('harga')}}">
                  </div>
              </div>                                           
            </div>
            <div class="col-md-6 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Total</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="harga" placeholder="Harga" value="{{old('harga')}}">
                  </div>
              </div> 
            </div>
          </div>   
        </div>
        <div class="box box-default" style="padding-top: 30px; ">
          <div class="box-body">
          <div class="col-md-12">
              <div class="col-md-3" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>ID</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" placeholder="Asesmen" value="{{old('nama')}}">
                  </div>
              </div>
              <div class="col-md-4" style="margin-top: 5px;">
                  <div class="col-md-6">
                      <p>Asesmen & Charge</p>
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="nama" placeholder="Asesmen" value="{{old('nama')}}">
                  </div>
              </div>
              <div class="col-md-3" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Harga</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" placeholder="Asesmen" value="{{old('nama')}}">
                  </div>
              </div>
              <div class="col-md-2" style="margin-top: 5px;">
                  <button type="button" class="btn btn-info" onclick="location.href='{{url('data/asesmen')}}'">Cari
                  </button>
              </div>
            </div>
          </div>   
        </div>

        <div class="box box-default" style="padding-top: 30px; ">
          <table id="datatable1" class="table table-bordered table-striped" >
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">LAYANAN</th>
                <th class="text-center" width="300px;">ASESMEN/CHARGE</th>
                <th class="text-center">HARGA</th>
                <th class="text-center" class="wd-10p">ACTION</th>
              </tr>
            </thead>
            <tbody>                        
                <tr>
                    <td align="center">1</td>
                    <td>nama</td>
                    <td>layanan</td>
                    <td>harga</td>
                    <td>x</td>
                </tr>                                                            
            </tbody>
          </table>
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
