
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
                    <input type="text" id="tanggal" class="form-control fc-datepicker datepicker" name="tanggal" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" value="{{old('tanggal')}}">
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Klien</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" id="klien" name="klien" placeholder="Pilih Klien">
                    </select>
                  </div>
              </div> 
            </div>
          </div>   
        </div>

        <div class="box box-default" style="padding-top: 30px; ">
          <div class="box-body">
            <div class="col-md-12" style="margin-bottom:50px;" >
              <div class="col-md-4" style="margin-top: 5px;">
                  <div class="col-md-6">
                      <p>Asesmen & Charge</p>
                  </div>
                  <div class="col-md-6">
                     <select class="form-control select2" id="asesmen" name="asesmen" placeholder="Pilih Asesmen/Charge">
                    </select>
                  </div>
              </div>
              <div class="col-md-3" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Harga</p>
                  </div>
                  <div class="col-md-8">
                    <input disabled type="number" class="form-control" id="harga" name="harga" placeholder="harga" value="{{old('harga')}}">
                  </div>
              </div>
              <div class="col-md-2" style="margin-top: 5px;">
                  <button type="button" id="tambah" class="btn btn-info">Tambah</button>
              </div>
            </div>

            <table id="list-asesmen" class="table table-bordered table-striped" >
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center" width="50%;">ASESMEN/CHARGE</th>
                  <th class="text-center">HARGA</th>
                  <th class="text-center">ACTION</th>
                </tr>
              </thead>
              <tbody>                                                                                  
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
                    <input disabled type="number" class="form-control" id="total" name="total" placeholder="total" value="{{old('harga')}}">
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Bayar</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" id="bayar" name="bayar" placeholder="bayar" value="{{old('harga')}}">
                  </div>
              </div> 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Kembalian</p>
                  </div>
                  <div class="col-md-8">
                    <input disabled type="number" class="form-control" id="kembalian" name="kembalian" placeholder="kembalian" value="{{old('kembalian')}}">
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
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {
    
    $('#tanggal').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        dateFormat: 'dd-mm-yy',
        autoclose: true,
        todayHighlight: true
    });

    $('#tanggal').on('change', function(e) {
        var tanggal = e.target.value;
        $.get('/transaksi/klien?tanggal=' + tanggal, function(data) {
            $('#klien').empty();
            $('#klien').append('<option value="0" disabled="true" selected="true">Pilih Klien</option>');

            $.each(data, function(index, klien){
                $('#klien').append('<option value="'+ klien.transaksi.id +'">'+ klien.klien.user.name +'</option>');
            })
        });
    });

    $.get('/transaksi/asesmen', function(data) {
        $('#asesmen').empty();
        $('#asesmen').append('<option value="0" disabled="true" selected="true">Pilih Asesmen</option>');

        $.each(data, function(index, asesmen){
            $('#asesmen').append('<option value="'+ asesmen.id +'">'+ asesmen.nama +'</option>');
        })
    });

    $('#asesmen').on('change', function(e) {
        $.get('/transaksi/asesmen-harga?id=' + $(this).val(), function(data) {
            $('#harga').val(data.harga);
        });
    });

    var i=0;
    var total = 0;
    $('#tambah').on( 'click', function () {
        // i++;
        $('#list-asesmen').append('<tr>'+
        '<td class="no"></td>'+
        '<td><input type="hidden" name="daftarAsesmen[]" value="'+$('select[name=asesmen]').val()+'">'+$('#asesmen').find('option:selected').text()+'</td>'+
        '<td class="harga"><input type="hidden" name="harga[]" value="'+$('input[name=harga]').val()+'">'+$('input[name=harga]').val()+'</td>'+
        '<td><input type="button" class="btn btn-danger btn-sm" value="Delete"></td>'+'</tr>');
        $('td.no').text(function (i) {
          return i + 1;
        });
        $('#harga').val('');
        $('#asesmen').prop('selectedIndex',0).trigger('change');

        total = 0;
        $('td.harga').each(function(index) {
            var value = parseInt($(this).text());
            if (!isNaN(value)) {
                total += value;
            }

        });

        $('#total').val(total);
    });
        
    $('#list-asesmen').on('click', 'input[type="button"]', function () {
        total = 0;
        $(this).closest('tr').remove();
        $('td.no').text(function (i) {
          return i + 1;
        });

        $('td.harga').each(function(index) {
            var value = parseInt($(this).text());
            if (!isNaN(value)) {
                total += value;
            }

        });

        $('#total').val(total);
    });

    $('#bayar').keyup(function() {
      var total = parseInt($('#total').val());
      $('#kembalian').val(parseInt($(this).val()) - total);
    });   

  });
</script>
@endsection
