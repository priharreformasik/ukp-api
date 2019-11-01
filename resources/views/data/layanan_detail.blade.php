@extends('layout')

@section('content-header')
    <section class="content-header">
      <h1>
        Detail Layanan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="layanan_list.html">Data</a></li>
        <li><a href="layanan_list.html">Daftar Layanan</a></li>
        <li class="active">Detail Layanan</li>
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
                        <td>Layanan</td>
                        <td>{{$layanan->nama}}</td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>{{$layanan->deskripsi}}</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>{{$layanan->harga}}</td>
                    </tr>                              
                  </tbody>
              </table>
          </div>
          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="row mt-3">
                <div class="col-lg" style="text-align: center">
                  <button type="button" class="btn btn-success" onclick="location.href='{{url('data/layanan')}}'">Back</button>
                </div>
            </div>
              </div>
              <!-- /.box-footer -->
        </form>
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