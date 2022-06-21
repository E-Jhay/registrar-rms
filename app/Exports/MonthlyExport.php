<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\PHPExcel_Style_Fill;

class MonthlyExport implements FromView, ShouldAutoSize, WithEvents
{

    private $report, $departments, $documentTypes, $totalCountPerDocs, $totalCount, $month;

    public function __construct($report, $departments, $documentTypes, $totalCountPerDocs, $totalCount, $month)
    {
        $this->report = $report;
        $this->departments = $departments;
        $this->documentTypes = $documentTypes;
        $this->totalCountPerDocs = $totalCountPerDocs;
        $this->totalCount = $totalCount;
        $this->month = $month;
    }

    public function view(): View
    {
        return view('exports.monthly', [
            'report' => $this->report,
            'departments' => $this->departments,
            'documentTypes' => $this->documentTypes,
            'totalCountPerDocs' => $this->totalCountPerDocs,
            'totalCount' => $this->totalCount,
            'month' => $this->month,
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
