<?php

namespace App\Http\Livewire;

use App\Exports\MonthlyExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Department;
use App\Models\DocumentType;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class MonthlyReports extends Component
{
    public $month, $year;
    // public $isPrint = false;
    // public $monthYear;
    // public $report, $departments, $documentTypes, $totalCountPerDocs, $totalCount;
    public function render()
    {
        
        // $this->report = $report;
        // $this->documentTypes = $documentTypes;

        // $departments = Department::select('name', 'id')->get();
        // $this->departments = $departments;
        // // $total = [];
        // $totalCountPerDocs = Order::select([
        //     'document_type_id', 
        //     DB::raw('COUNT(id) as total'),
        // ])
        // ->where('status_id', 3)
        // ->whereYear('created_at', now()->year)
        // ->whereMonth('created_at', $this->month)
        // ->groupBy('document_type_id')
        // ->orderBy('document_type_id')
        // ->get()
        // ->pluck('total', 'document_type_id')
        // ->toArray();
        // $this->totalCountPerDocs = $totalCountPerDocs;

        // $totalCount = Order::select('id')
        // ->where('status_id', 3)
        // ->whereYear('created_at', now()->year)
        // ->whereMonth('created_at', $this->month)
        // ->count();
        // $this->totalCount = $totalCount;

        // $report = $this->report;
        // $departments = $this->departments;
        // $documentTypes = $this->documentTypes;
        // $totalCountPerDocs = $this->totalCountPerDocs;
        // $totalCount = $this->totalCount;
        // dd($query, $report);
        return view('livewire.monthly-reports', [
            'report' => $this->report,
            'departments' => $this->departments,
            'documentTypes' => $this->documentTypes,
            'totalCountPerDocs' => $this->totalCountPerDocs,
            'totalCount' => $this->totalCount,
        ]);
    }

    public function mount()
    {
        $this->month = now()->month;
            $this->year = now()->year;
        // $this->monthYear = Carbon::createFromFormat('m', $this->month)->format('F')." ". now()->year;
    }

    public function getReportProperty()
    {
        $query = Order::select([
            'department_id',
            'document_type_id',
            // DB::raw("DATE_FORMAT(created_at, '%m') as month"),
            DB::raw('COUNT(id) as ordersCount'),
        ])
        ->where('status_id', 3)
        ->whereYear('created_at', $this->year)
        ->whereMonth('created_at', $this->month)
        ->groupBy('department_id')
        ->groupBy('document_type_id')
        ->orderBy('document_type_id')
        ->get();

        $report = [];
        $documentTypes = $this->documentTypes;
        // Set key without to the report Array 
        $documentTypes->each(function ($item, $key) use (&$report){
            $report[$key] = [];
        });

        // Sets value to the report array
        $query->each(function ($item) use (&$report){
            $report[$item->document_type_id][$item->department_id] = [
                'count' => $item->ordersCount
            ];
        });

        return $report;
    }
    

    public function getDocumentTypesProperty()
    {
        return DocumentType::select('name', 'id')
        ->orderBy('name')
        ->pluck('name', 'id');
    }
    public function getDepartmentsProperty()
    {
        return Department::select('name', 'id')->get();
    }

    public function getTotalCountPerDocsProperty()
    {
        return Order::select([
            'document_type_id', 
            DB::raw('COUNT(id) as total'),
        ])
        ->where('status_id', 3)
        ->whereYear('created_at', $this->year)
        ->whereMonth('created_at', $this->month)
        ->groupBy('document_type_id')
        ->orderBy('document_type_id')
        ->get()
        ->pluck('total', 'document_type_id')
        ->toArray();
    }

    public function getTotalCountProperty()
    {
        return Order::select('id')
        ->where('status_id', 3)
        ->whereYear('created_at', $this->year)
        ->whereMonth('created_at', $this->month)
        ->count();
    }
    public function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx']), Response::HTTP_NOT_FOUND);
        return Excel::download(new MonthlyExport($this->report, $this->departments, $this->documentTypes, $this->totalCountPerDocs, $this->totalCount, $this->month), 'monthly-accomplishment-report.' .$ext);
    }
}
