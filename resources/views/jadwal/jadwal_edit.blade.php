@extends('layout')

@section('css')
@endsection

@section('content-header')
    <section class="content-header">
      <h1>
        Edit Jadwal Konsultasi
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('jadwal')}}">Jadwal</a></li>
        <li><a href="{{url('jadwal')}}">Jadwal Konsultasi</a></li>
        <li class="active">Edit Jadwal Konsultasi</li>
      </ol>
    </section>
@stop

@section('content')
    <section class="content">
      <!-- @if(count($errors)>0)
          <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <li>
                {{$error}}
              </li>
            @endforeach
          </div>
      @endif -->
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default" style="padding-top: 30px; ">
        <!-- /.box-header -->
        {!! Form::open(array('url'=>'jadwal/'.$data->id.'/edit', 'method'=>'POST'))!!}
          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Tanggal</p>
                  </div>
                      <div class="col-md-8">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="tanggal" type="text" class="form-control datepicker"   placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" value="{{ old('tanggal') ? old('tanggal') : \Carbon\Carbon::parse($data->tanggal)->format('Y-m-d') }}">
                          </div>
                      </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Jam</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="sesi_id">
                      @if(! $data['sesi_id']) 
                            <option value="">Pilih Sesi</option>
                            @foreach($sesi as $value)
                                <option value="{{$value->id}}" {{collect(old('sesi'))->contains($value->id) ? 'selected':''}}>{{$value->jam}}</option>
                            @endforeach
                          @else 
                            @foreach($sesi as $value)
                                <option value="{{$value->id}}" {{collect(old('sesi'))->contains($value->id) ? 'selected':''}} @if($value->id == $data['sesi_id']) selected='selected' @endif>{{$value->jam}}</option>
                            @endforeach
                      @endif
                    </select>
                  </div>
              </div>              
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                        <p>Nama Klien</p>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control select2" name="klien_id">
                            @foreach($klien as $value => $key)
                                <option value="{{$key->id}}" {{collect(old('klien'))->contains($key->id) ? 'selected':''}} @if($key->id == $data['klien_id']) selected='selected' @endif>{{$key->user['name']}}</option>
                            @endforeach
                        </select>
                    </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Keluhan</p>
                  </div>
                  <div class="col-md-8">
                    <textarea class="form-control" name="keluhan" placeholder="">{{ old('keluhan') ? old('keluhan') : $data->keluhan }}</textarea>
                  </div>
              </div>  
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                        <p>Layanan</p>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control select2" name="layanan_id" id="layanan">
                            @foreach($layanan as $value)
                                <option value="{{$value->id}}" {{collect(old('layanan'))->contains($value->id) ? 'selected':''}} @if($value->id == $data['layanan_id']) selected='selected' @endif>{{$value->nama}}</option>
                            @endforeach
                        </select>
                    </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                        <p>Nama Psikolog</p>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control select2" name="psikolog_id" id="psikolog">
                            @foreach($psikolog as $value => $key)
                                <option value="{{$key->id}}" {{collect(old('psikolog'))->contains($key->id) ? 'selected':''}} @if($key->id == $data['psikolog_id']) selected='selected' @endif>{{$key->user['name']}}</option>
                            @endforeach
                        </select>
                    </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                        <p>Ruangan</p>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control select2" name="ruangan_id">
                          @if(! $data['ruangan_id']) 
                            <option value="">Pilih Ruangan</option>
                            @foreach($ruangan as $value)
                                <option value="{{$value->id}}" {{collect(old('ruangan'))->contains($value->id) ? 'selected':''}}>{{$value->nama}}</option>
                            @endforeach
                          @else 
                            @foreach($ruangan as $value)
                                <option value="{{$value->id}}" {{collect(old('ruangan'))->contains($value->id) ? 'selected':''}} @if($value->id == $data['ruangan_id']) selected='selected' @endif>{{$value->nama}}</option>
                            @endforeach
                          @endif
                        </select>
                    </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                <div class="col-md-4">
                      <p>Status</p>
                  </div>
                    <div class="col-md-8">
                      <select class="form-control select2" name="status_id">
                            @foreach($status as $value)
                                <option value="{{$value->id}}" {{collect(old('status'))->contains($value->id) ? 'selected':''}} @if($value->id == $data['status_id']) selected='selected' @endif>{{$value->nama}}</option>
                            @endforeach
                        </select>
                    </div>
              </div>
              </div>                                   
          </div>
          <div class="row mt-3">
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='{{url('jadwal')}}'">Kembali</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
          </div>
        
        {!!Form::close()!!}
      </div>
    </section>
    <!-- /.content -->
@endsection

@section('javascript')
<script src="{{asset('js/jquery-chained/jquery.chained.remote.js')}}"></script>

<script>
        $(function(){
            $('.select2').select2();

         

        });

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
      $('#layanan').on('change', function(e) {
                var id_layanan = e.target.value;
                console.log(id_layanan);

                $.get('/api/layananPsikolog/web?layanan_id=' + id_layanan, function(data) {
                    console.log(data);
                    $('#psikolog').empty();
                    $('#psikolog').append('<option value="0" disabled="true" selected="true">Pilih Psikolog</option>');

                    $.each(data, function(index, user){
                        $('#psikolog').append('<option value="'+ user.psikolog.id +'">'+ user.name +'</option>');
                    })
                });
            });    
    </script>
@endsection
