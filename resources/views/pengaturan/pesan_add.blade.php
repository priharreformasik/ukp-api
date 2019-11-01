@extends('layout')

@section('css')
  <link rel="stylesheet" href="{{asset('bower_components/admin-lte/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/admin-lte/dist/css/skins/_all-skins.min.css')}}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('bower_components/admin-lte/plugins/iCheck/all.css')}}">
@section('content-header')
    <section class="content-header">
      <h1>
        Tulis Pesan
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('pengaturan/pesan')}}">Pengaturan</a></li>
        <li><a href="{{url('pengaturan/pesan')}}">Daftar Pesan</a></li>
        <li class="active">Tulis Pesan</li>
      </ol>
    </section>
@stop

@section('content')
    <section class="content">
          <div class="box-body">
            <div class="box box-primary">
            <div class="box-header">
              <i class="fa fa-envelope"></i>
              <h3 class="box-title">Pesan</h3>
            </div>
            
            <!-- {!! Form::open(array('url'=>'haha','method'=>'POST', 'files'=>'true','class'=>'form-horizontal'))!!} -->
            {!! Form::open(array('url'=>'pengaturan/pesan/simpan','method'=>'POST', 'files'=>'true', 'class'=>'form-horizontal'))!!}
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 10px;">
                  <div class="col-md-12">
                  <select id="select-psikolog" class="form-control select2-psikolog" multiple="true" name="user_id[]" placeholder="Pilih User">
                        @foreach($user as $value)
                            <option value="{{$value->id}}" {{collect(old('user'))->contains($value->id) ? 'selected':''}}>{{$value->name."-".$value->level}}</option>
                        @endforeach
                    </select>
                    <label>
                      <input type="checkbox" id="select-psikolog-all">
                    </label>
                  </div>
              </div>
            </div>
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 10px;">
                  <div class="col-md-12">                
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
              </div>
            </div>
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 10px; margin-bottom: 20px;">
                <div class="col-md-12">   
                  <textarea class="textarea" name="pesan" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                  </textarea>
                </div>
              </div>
            </div>           
                <div class="box-footer clearfix">
                  <button type="submit" class="pull-right btn btn-default">Kirim
                    <i class="fa fa-arrow-circle-right"></i></button>
                  <button type="button" class="pull-left btn btn-default" id="sendEmail" onclick="location.href='{{url('pengaturan/pesan')}}'"><i class="fa fa-arrow-circle-left"></i> Kembali</button>
                </div>
            {!!Form::close()!!}
      </div>
      </div>
    </section>
@endsection

@section('javascript')
<!-- AngularJS -->

<!-- <script src="{{asset('firebase/index.js')}}"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function () {

      $('.select2-psikolog').select2();
       
        $('#select-psikolog-all').on('click', function (e) {
          var checked = e.target.checked;
          // console.log("clicked", e.target.checked);
          if (checked) {
            $('.select2-psikolog').select2('destroy').find('option').prop('selected', 'selected').end().select2();
          } else {
            $('.select2-psikolog').select2('destroy').find('option').prop('selected', false).end().select2();
          }
          
        });
    });

</script>
@endsection
