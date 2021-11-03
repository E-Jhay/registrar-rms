<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MonthlyExport implements FromView, ShouldAutoSize
{

    private $report, $departments, $documentTypes, $totalCountPerDocs, $totalCount, $month;

    public function __construct($report, $departments, $documentTypes, $totalCountPerDocs, $totalCount, $month)
    {
        $this->report = $report;
        $this->departments = $departments;
        $this->documentTypes = $documentTypes;
        $this->totalCountPerDocs = $totalCountPerDocs;
        $this->totalCount = $totalCount;
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
    
}
