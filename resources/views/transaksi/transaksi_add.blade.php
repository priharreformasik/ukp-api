
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
                      <p>Tanggal</p>
                  </div>
                  <div class="col-md-8">
                    <input type="date" class="form-control" name="tanggal" placeholder="tanggal" value="{{old('harga')}}">
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Klien</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="klien" placeholder="Pilih Asesmen/Charge">
                        <option value="klien">nama klien</option>
                    </select>
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>ID Transaksi</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="id" placeholder="Pilih ID transaksi">
                        <option value="asesmen">id transaksi</option>
                    </select>
                  </div>
              </div>                                          
            </div>
            <div class="col-md-6 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Total</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="harga" placeholder="Total" value="{{old('harga')}}">
                  </div>
              </div> 
            </div>
          </div>   
        </div>

        <div class="box box-default" style="padding-top: 30px; ">
          <div class="box-body">
            <div class="col-md-12" style="margin-bottom:50px;" >
              <div class="col-md-3" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>ID</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="id" placeholder="Pilih ID">
                        <option value="id">1</option>
                    </select>
                  </div>
              </div>
              <div class="col-md-4" style="margin-top: 5px;">
                  <div class="col-md-6">
                      <p>Asesmen & Charge</p>
                  </div>
                  <div class="col-md-6">
                     <select class="form-control select2" name="asesmen" placeholder="Pilih Asesmen/Charge">
                        <option value="asesmen">asesmen</option>
                    </select>
                  </div>
              </div>
              <div class="col-md-3" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Harga</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" placeholder="harga" value="{{old('nama')}}">
                  </div>
              </div>
              <div class="col-md-2" style="margin-top: 5px;">
                  <button type="button" class="btn btn-info" onclick="location.href='{{url('data/asesmen')}}'">Tambah
                  </button>
              </div>
            </div>

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
                      <td>
                        <button type="button" class="btn btn-danger" onclick="location.href='{{url('data/asesmen')}}'">Hapus
                    </button>
                      </td>
                  </tr>                                                            
              </tbody>
            </table>
          </div>
        </div>

        <div class="box box-default" style="padding-top: 30px; ">
          <div class="box-body">
            <div class="col-md-6 pl-5 pr-5" style="float:left">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Total</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="total" placeholder="total" value="{{old('harga')}}">
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Bayar</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="total" placeholder="bayar" value="{{old('harga')}}">
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Kembalian</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="total" placeholder="kembalian" value="{{old('kembalian')}}">
                  </div>
              </div>                                          
            </div>
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-left: 10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('data/asesmen')}}'">Batal
                  </button>
                 <button type="button" class="btn btn-success" onclick="location.href='{{url('data/asesmen')}}'">Simpan
                  </button>
              </div> 
            </div>
          </div>   
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
