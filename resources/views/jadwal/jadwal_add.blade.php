@extends('layout')

@section('css')
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Tambah Jadwal Konsultasi
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('#')}}">Jadwal</a></li>
        <li><a href="{{url('jadwal')}}">Jadwal Konsultasi</a></li>
        <li class="active">Tambah Jadwal Konsultasi</li>
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
        {!! Form::open(array('url'=>'jadwal/simpan','method'=>'POST', 'files'=>'true', 'class'=>'form-horizontal'))!!}
          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Tanggal</p>
                  </div>
                      <div class="col-md-8">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input id="tanggal" name="tanggal" type="text" class="form-control fc-datepicker datepicker" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" value="{{old('tanggal')}}">
                          </div>
                      </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Layanan</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="layanan_id" id="layanan">
                        <option value="">Pilih Layanan</option>
                        @foreach($layanan as $value)
                            <option value="{{$value->id}}" {{collect(old('layanan'))->contains($value->id) ? 'selected':''}}>{{$value->nama}}</option>
                        @endforeach
                    </select>
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px; ">
                  <div class="col-md-4">
                      <p>Nama Psikolog</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="psikolog_id" id='psikolog'>
                    </select>
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Sesi</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="sesi_id" id="sesi">              
                    </select>
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Nama Klien</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="klien_id">
                        <option value="">Pilih Klien</option>
                        @foreach($klien as $value => $key)
                            <option value="{{$key->id}}">{{$key->user['name']}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>    
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Keluhan</p>
                  </div>
                  <div class="col-md-8">
                    <textarea class="form-control" name="keluhan" placeholder="Keluhan">{{old('keluhan')}}</textarea>
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Ruangan</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="ruangan_id" id="ruangan">
                    </select>
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;margin-bottom: 10px;">
                  <div class="col-md-4">
                      <p>Status</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="status_id">
                        <option value="">Pilih Status</option>
                        @foreach($status as $value)
                            <option value="{{$value->id}}" {{collect(old('status'))->contains($value->id) ? 'selected':''}}>{{$value->nama}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>                                  
          </div>
          <div class="row mt-3" >
                <div class="col-lg" style="text-align: center ;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('jadwal')}}'">Kembali</button>
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
    <script src="{{asset('lib/jquery/jquery.chained.min.js')}}"></script>

    <script>
      $(function () {
        //Date picker
        $('.datepicker').datepicker({
          autoclose: true,
          endDate: "+14d",
          startDate: "dd",
          todayHighlight: true
        })
      })
    </script>

    <script>
      $(function () {
        //Date picker
        $('.datepicker').datepicker({
          autoclose: true,
          endDate: "+14d",
          startDate: "dd",
          todayHighlight: true
        })
      })
    </script>

    <script>
        $(function(){

            'use strict';

            
            $('.select2').select2();

            // Datepicker
            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'yy-mm-dd'
            });

            // Select2
            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

        });

    </script>
    <script>
      $('#layanan').on('change', function(e) {
          var id_layanan = e.target.value;

          $.get('/api/layananPsikolog/web?layanan_id=' + id_layanan, function(data) {
              $('#psikolog').empty();
              $('#psikolog').append('<option value="0" disabled="true" selected="true">Pilih Psikolog</option>');

              $.each(data, function(index, user){
                  $('#psikolog').append('<option value="'+ user.psikolog.id +'">'+ user.name +'</option>');
              })
          });
      });  

      $('#psikolog').on('change', function(e) {
          var id_layanan = $('#layanan').val();
          var id_psikolog = e.target.value;
          var tanggal = $('#tanggal').val();

          $.get('/api/layananSesi/web?layanan_id=' + id_layanan + '&' + 'psikolog_id=' + id_psikolog + '&' + 'tanggal=' + tanggal, function(data) {
              $('#sesi').empty();
              $('#sesi').append('<option value="0" disabled="true" selected="true">Pilih Sesi</option>');

              $.each(data, function(index, sesi){
                  $('#sesi').append('<option value="'+ sesi.id +'">'+ sesi.nama +'</option>');
              })
          });
      });  

      $('#sesi').on('change', function(e) {
          var id_layanan = $('#layanan').val();
          var id_sesi = e.target.value;
          var tanggal = $('#tanggal').val();

          $.get('/api/layananRuangan/web?layanan_id=' + id_layanan + '&' + 'sesi_id=' + id_sesi + '&' + 'tanggal=' + tanggal, function(data) {
              $('#ruangan').empty();
              $('#ruangan').append('<option value="0" disabled="true" selected="true">Pilih Ruangan</option>');

              $.each(data, function(index, ruangan){
                  $('#ruangan').append('<option value="'+ ruangan.id +'">'+ ruangan.nama +'</option>');
              })
          });
      });
      </script>

@endsection
