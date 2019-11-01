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
use Illuminate\Support\Facades\Input;

class Klien extends Model implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $table = 'klien';
    protected $fillable = [
    	'pendidikan_terakhir','anak_ke','jumlah_saudara','kategori_id','user_id','parent_id','hub_pendaftar'
    ];
    public $timestamps = true;
    //protected $dates = ['deleted_at', 'tanggal_lahir'];

   	public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'klien_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Kategori', 'kategori_id', 'id');
    }

    public function children()
    {
        return $this->belongsTo('App\Klien', 'parent_id', 'id')->with('children');
    }

    public function parent()
    {
        return $this->belongsTo('App\Klien', 'parent_id', 'id')->with('parent');
    }

    public function collection()
    {
        return Klien::leftjoin('users','klien.user_id','=','users.id')
                        ->select('users.name','users.jenis_kelamin','users.tanggal_lahir','users.nik','users.alamat','users.email','users.no_telepon','klien.anak_ke','klien.jumlah_saudara','klien.pendidikan_terakhir','klien.parent_id','klien.hub_pendaftar')
                        ->where('level','Klien')
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
            'Anak ke-',
            'Jumlah Saudara',
            'Pendidikan Terakhir',
            'Didaftarkah Oleh',
            'Hubungan Pendaftar'
        ];
    }

    public function registerEvents(): array
    {
        $styleArray = [
          'font' => [
            'bold' => true,
          ]
        ];
        return [
            BeforeSheet::class => function(BeforeSheet $event) use ($styleArray){
              $event->sheet->setCellValue('A1', 'Daftar Klien');
              $event->sheet->setCellValue('A2', 'Unit Konsultasi Psikologi');
              $event->sheet->setCellValue('A3', 'Fakultas Psikologi Universitas Gadjah Mada');
              $event->sheet->setCellValue('A4', '');
              $event->sheet->mergeCells('A1:L1');
              $event->sheet->mergeCells('A2:L2');
              $event->sheet->mergeCells('A3:L3');
              $event->sheet->mergeCells('A4:L4');
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
