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
            <b>DAFTAR KLIEN</b><br>
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
                    <th>N0 TELP</th>
                    <th>ANAK KE</th>
                    <th>JUMLAH SAUDARA</th>
                    <th>PENDIDIKAN TERAKHIR</th>
                    <th>DIDAFTARKAN OLEH</th>
                    <th>HUBUNGAN PENDAFATAR</th>
                </tr>
            </thead>
            <tbody>  
            @foreach($data as $value => $klien)                        
                <tr>
                    <td style="text-align: center;">{{$value+1}}</td>
                    <td>{{$klien->name}}</td>
                    <td>{{$klien->jenis_kelamin}}</td>
                    <td>{{\Carbon\Carbon::parse($klien->tanggal_lahir)->format('d-m-Y')}}</td>
                    <td align="center">
                        @php if($klien->nik) echo $klien->nik;
                            else echo "-"; 
                        @endphp
                    </td>
                    <td align="center">
                        @php if($klien->alamat) echo $klien->alamat;
                            else echo "-"; 
                        @endphp
                    </td>
                    <td align="center">
                        @php if($klien->email) echo $klien->email;
                            else echo "-"; 
                        @endphp
                    </td>
                    <td align="center">
                        @php if($klien->no_telepon) echo $klien->no_telepon;
                            else echo "-"; 
                        @endphp
                    </td>
                    <td>{{$klien->anak_ke}}</td>
                    <td>{{$klien->jumlah_saudara}}</td>
                    <td>{{$klien->pendidikan_terakhir}}</td>
                    <td>
                        @php if($klien->parent_id) echo $klien->parent->user->name;
                            else echo "-"; 
                        @endphp
                    </td>
                    <td>
                        @php if($klien->hub_pendaftar) echo $klien->hub_pendaftar;
                            else echo "-"; 
                        @endphp
                    </td>

                </tr>
            @endforeach                          
            </tbody>
        </table>
    </div>
</body>
</html>