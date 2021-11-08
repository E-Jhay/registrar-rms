<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\PHPExcel_Style_Fill;

class QuarterlyExport implements FromView, ShouldAutoSize, WithEvents
{
    public $report, $costPerCustomer, $documentType, $status, $year, $quarter, $documentCode;

    public function __construct($report, $costPerCustomer, $documentType, $status, $year, $quarter, $documentCode)
    {
        $this->report = $report;
        $this->costPerCustomer = $costPerCustomer;
        $this->documentType = $documentType;
        $this->status = $status;
        $this->year = $year;
        $this->quarter = $quarter;
        $this->documentCode = $documentCode;
    }

    public function view(): View
    {
        return view('exports.quarterly', [
            'report' => $this->report,
            'costPerCustomer' => $this->costPerCustomer,
            'documentType' => $this->documentType,
            'status' => $this->status,
            'year' => $this->year,
            'quarter' => $this->quarter,
            'documentCode' => $this->documentCode,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $to = $event->sheet->getDelegate()->getHighestRowAndColumn();

                $styleArray = [
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => '007bff'],
                    ],
                    'font' => [
                        'color'      =>  ['rgb' => 'FFFFFF'],
                        'bold'      =>  true
                    ],
                ];
                $event->sheet->getStyle('A1:'.$to['column'].'1')->applyFromArray($styleArray);
                // dd($to['column'].'1');

                $event->sheet->getStyle('A1:'.$to['column'].$to['row'])->getAlignment()->applyFromArray(
                    array(
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    )
                );
            },
        ];
    }
}
