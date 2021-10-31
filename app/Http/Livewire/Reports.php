<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\DocumentType;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reports extends Component
{
    public $month;
    // public $isPrint = false;
    public function render()
    {
        $query = Order::select([
            'department_id',
            'document_type_id',
            // DB::raw("DATE_FORMAT(created_at, '%m') as month"),
            DB::raw('COUNT(id) as ordersCount'),
        ])
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
        $query->each(function ($item) use (&$report, &$documentTypes){
            $report[$item->document_type_id][$item->department_id] = [
                'count' => $item->ordersCount
            ];
        });
        $departments = Department::select('name', 'id')->get();
        // $total = [];
        $totalCountPerDocs = Order::select([
            'document_type_id', 
            DB::raw('COUNT(id) as total'),
        ])
        ->whereYear('created_at', now()->year)
        ->whereMonth('created_at', $this->month)
        ->groupBy('document_type_id')
        ->orderBy('document_type_id')
        ->get()
        ->pluck('total', 'document_type_id')
        ->toArray();

        $totalCount = Order::select('id')
        ->whereYear('created_at', now()->year)
        ->whereMonth('created_at', $this->month)
        ->count();

        // dd($query, $report);
        return view('livewire.reports', compact('report', 'departments', 'documentTypes', 'totalCountPerDocs', 'totalCount'));
    }

    public function mount()
    {
        $this->month = now()->month;
    }
    
    // public function print()
    // {
    //     if($this->isPrint)
    //         $this->isPrint = false;
    //     else
    //         $this->isPrint = true;
    // }
}
