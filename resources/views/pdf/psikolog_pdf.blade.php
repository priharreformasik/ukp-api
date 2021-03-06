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
th{
  padding: 5px;
  text-align: center;
}
td {
  padding: 5px;
  text-align: left;
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
        <b>DAFTAR PSIKOLOG</b><br>
    </div>
    <div align="left" style="padding-bottom: 10px;">
      Tanggal : {{date('d-m-Y')}}
    </div>
    <table>
        <thead>
            <tr>
                <th style="text-align: center;">NO</th>
                <th>NAMA</th>
                <th>JENIS KELAMIN</th>
                <th>TANGGAL LAHIR</th>
                <th>NIK</th>
                <th>ALAMAT</th>
                <th>EMAIL</th>
                <th>NO TELP</th>
                <th>NOMOR SIPP</th>
                <th>GELAR</th>
            </tr>
        </thead>
        <tbody>  
        @foreach($data as $value => $psikolog)                        
            <tr>
                <td style="text-align: center;">{{$value+1}}</td>
                <td>{{$psikolog->name}}</td>
                <td>{{$psikolog->jenis_kelamin}}</td>
                <td>{{\Carbon\Carbon::parse($psikolog->tanggal_lahir)->format('d-m-Y')}}</td>
                <td>{{$psikolog->nik}}</td>
                <td>{{$psikolog->alamat}}</td>
                <td>{{$psikolog->email}}</td>
                <td>{{$psikolog->no_telepon}}</td>
                <td>{{$psikolog->no_sipp}}</td>
                <td>{{$psikolog->gelar}}</td>
            </tr>
        @endforeach                          
        </tbody>
    </table>
</div>
</body>
</html>