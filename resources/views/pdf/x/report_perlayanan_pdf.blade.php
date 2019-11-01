<html>
<head>
<style>
body{
    font-family:cambria;
    font-size: 12px;
}
table {
  width:100%;
  font-size: 12px;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: center;
}
.header{
  text-align: center;
  float:left;
  color: black;
  width:100%;
  border-bottom: double;
  margin-top: 5px;
  }
.content{
  text-align: center;
  float:left;
  color: black;
  width:100%;
  }
.title{
    padding-top:20px;
    padding-bottom:20px;
    align:center;
    }

</style>
</head>
<body>
    <header>
        <img src="bower_components/admin-lte/dist/img/ugm2.png" height="70px;" width="70px;" style="padding-top:20px; padding-right:20px; clear:both;float:left">
        <div style="height:70px;padding: 20px;">
          <b>UNIT KONSULTASI PSIKOLOGI</b><br>
          <b>FAKULTAS PSIKOLOGI UNIVERSITAS GADJAH MADA</b><br>
          Gedung D lantai 2 Jl. Sosio Humaniora Bulaksumur Telp (274)550435<br>
          Website: ukp.psikologi@ugm.ac.id, Email: ukpugm@gmail.com<br>
          Yogyakarta Indonesia Kode Pos: 55281<br>
        </div>
    </header>
    <div class="content">
        <div class="title">
            <b>REKAP KONSULTASI LAYANAN</b><br>
        </div>
        <div align="left">
            Layanan : {{$layanan->nama}} <br>
            Dari    : {{\Carbon\Carbon::parse($request->from)->format('l, j F Y')}} <br>
            Sampai  : {{\Carbon\Carbon::parse($request->until)->format('l, j F Y')}} <br><br>
        </div>
        <table>
                    <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">TANGGAL</th>
                                <th class="text-center">NAMA PSIKOLOG</th>
                                <th class="text-center">NAMA KLIEN</th>
                                <th class="text-center">JENIS KELAMIN</th>
                                <th class="text-center">KATEGORI KLIEN</th>

                            </tr>
                    </thead>
                      <tbody>  
                        @foreach($data as $value => $jadwal)                        
                        <tr>
                            <td align="center">{{$value+1}}</td>
                            <td>{{\Carbon\Carbon::parse($jadwal->tanggal)->format('l, j F Y')}}</td>
                            <td>{{$jadwal->psikolog->user->name}}</td>
                            <td>{{$jadwal->klien->user->name}}</td>
                            <td>{{$jadwal->klien->user->jenis_kelamin}}</td>
                            <td>{{$jadwal->klien->kategori->nama}}</td>
                        </tr>
                        @endforeach                                              
                      </tbody>
        </table>
    </div>
</body>
</html>
