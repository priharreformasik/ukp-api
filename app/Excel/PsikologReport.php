<?php

namespace App\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Illuminate\Support\Facades\Input;

class PsikologReport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
// ShouldAutoSize
// WithEvents
// FromQuery
{
    use Exportable;
    public function __construct($collection)
    {
        $this->collection = $collection;
    }
    public function collection()
    {
        $excel  = $this->collection;
        // dd($excel);
        return $excel;
    }
    public function headings(): array
    {
        return [          
            'Tanggal',
            'Jam',        
            'Nama Klien',
            'Jenis Layanan',
            'Ruangan',
            'Status'
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
              $event->sheet->setCellValue('A1', 'Rekap Konsultasi Psikolog');
              $event->sheet->setCellValue('A2', 'Unit Konsultasi Psikologi');
              $event->sheet->setCellValue('A3', 'Fakultas Psikologi Universitas Gadjah Mada');
              $event->sheet->setCellValue('A4', '');
              $event->sheet->mergeCells('A1:F1');
              $event->sheet->mergeCells('A2:F2');
              $event->sheet->mergeCells('A3:F3');
              $event->sheet->mergeCells('A4:F4');
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
