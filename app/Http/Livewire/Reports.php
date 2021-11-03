<?php

namespace App\Http\Livewire;

use App\Exports\MonthlyExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Department;
use App\Models\DocumentType;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class Reports extends Component
{
    public $month;
    // public $isPrint = false;
    // public $monthYear;
    public $report, $departments, $documentTypes, $totalCountPerDocs, $totalCount;
    public function render()
    {
        $query = Order::select([
            'department_id',
            'document_type_id',
            // DB::raw("DATE_FORMAT(created_at, '%m') as month"),
            DB::raw('COUNT(id) as ordersCount'),
        ])
        ->where('status_id', 3)
        ->whereYear('created_at', now()->year)
        ->whereMonth('created_at', $this->month)
        ->groupBy('department_id')
        ->groupBy('document_type_id')
        ->orderBy('document_type_id')
        ->get();

        $report = [];
        $documentTypes = DocumentType::pluck('name', 'id');
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
        $this->report = $report;
        $this->documentTypes = $documentTypes;

        $departments = Department::select('name', 'id')->get();
        $this->departments = $departments;
        // $total = [];
        $totalCountPerDocs = Order::select([
            'document_type_id', 
            DB::raw('COUNT(id) as total'),
        ])
        ->where('status_id', 3)
        ->whereYear('created_at', now()->year)
        ->whereMonth('created_at', $this->month)
        ->groupBy('document_type_id')
        ->orderBy('document_type_id')
        ->get()
        ->pluck('total', 'document_type_id')
        ->toArray();
        $this->totalCountPerDocs = $totalCountPerDocs;

        $totalCount = Order::select('id')
        ->where('status_id', 3)
        ->whereYear('created_at', now()->year)
        ->whereMonth('created_at', $this->month)
        ->count();
        $this->totalCount = $totalCount;

        // dd($query, $report);
        return view('livewire.reports', compact('report', 'departments', 'documentTypes', 'totalCountPerDocs', 'totalCount'));
    }

    public function mount()
    {
        $this->month = now()->month - 1;
        // $this->monthYear = Carbon::createFromFormat('m', $this->month)->format('F')." ". now()->year;
    }
    
    public function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx', 'pdf']), Response::HTTP_NOT_FOUND);
        return Excel::download(new MonthlyExport($this->report, $this->departments, $this->documentTypes, $this->totalCountPerDocs, $this->totalCount, $this->month), 'monthly-accomplishment-report.' .$ext);
    }
}
