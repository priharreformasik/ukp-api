<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\User;


class Psikolog extends Model implements FromCollection, WithHeadings, ShouldAutoSize,  WithEvents
{
    use SoftDeletes;
    
    protected $table = 'psikolog';
    // protected $fillable = ['id','nama','nik','jenis_kelamin','tanggal_lahir','nik','alamat','no_sipp','alamat','no_telepon','foto','user_id'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'gelar','no_sipp', 'keahlian_id', 'user_id','layanan_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function keahlian()
    {
        return $this->belongsTo('App\Keahlian', 'keahlian_id', 'id');
    }

    public function layanan()
    {
        return $this->belongsToMany('App\Layanan', 'layanan_psikolog', 'psikolog_id', 'layanan_id');
    }

    public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'psikolog_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function collection()
    {
        return Psikolog::leftjoin('users','psikolog.user_id','=','users.id')
              ->select('users.name','users.jenis_kelamin','users.tanggal_lahir','users.nik','users.alamat','users.email','users.no_telepon','psikolog.no_sipp','psikolog.gelar')
              ->where('level','Psikolog')
              ->where('status','Approved')
              ->orderBy('users.name')
              ->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'NIK',
            'Alamat',
            'Email',
            'No Telepon',
            'No SIPP',
            'Gelar',
        ];
    }

    public function registerEvents(): array
    {
        $styleArray = [
          'font' => [
            'bold' => true,
            'text-align' => 'center'
          ]
        ];
        return [
            BeforeSheet::class => function(BeforeSheet $event) use ($styleArray){
              $event->sheet->setCellValue('A1', 'Daftar Psikolog');
              $event->sheet->setCellValue('A2', 'Unit Konsultasi Psikologi');
              $event->sheet->setCellValue('A3', 'Fakultas Psikologi Universitas Gadjah Mada');
              $event->sheet->setCellValue('A4', '');
              $event->sheet->mergeCells('A1:I1');
              $event->sheet->mergeCells('A2:I2');
              $event->sheet->mergeCells('A3:I3');
              $event->sheet->mergeCells('A4:I4');
            },
            // Handle by a closure.
            AfterSheet::class => function (AfterSheet $event) use ($styleArray){
              $event->sheet->getStyle('A1:Z1')->applyFromArray($styleArray);
              $event->sheet->getStyle('A2:Z2')->applyFromArray($styleArray);
              $event->sheet->getStyle('A3:Z3')->applyFromArray($styleArray);
              $event->sheet->getStyle('A5:Z5')->applyFromArray($styleArray);
            },
        ];
    }
}
