<?php

namespace App\Http\Livewire;

use App\Exports\QuarterlyExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Department;
use App\Models\DocumentType;
use App\Models\Order;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class QuarterlyReports extends Component
{
    public $quarter;
    public $start, $end;
    public $year;

    public function render()
    {
        return view('livewire.quarterly-reports', [
            'report' => $this->report,
            'costPerCustomer' => $this->costPerCustomer,
            'documentType' => $this->documentType,
            'status' => $this->status,
            'documentCode' => $this->documentCode,
        ]);
    }

    public function mount()
    {
        if(now()->month >= 1 && now()->month <= 3){
            $this->year = now()->year - 1;
            $this->start = '1';
            $this->end = '3';
            $this->quarter = '1st';
        }
        elseif(now()->month >= 4 && now()->month <= 6){
            $this->year = now()->year;
            $this->start = '4';
            $this->end = '6';
            $this->quarter = '2nd';
        }
        elseif(now()->month >= 7 && now()->month <= 9){
            $this->year = now()->year;
            $this->start = '7';
            $this->end = '9';
            $this->quarter = '3rd';
        }
        elseif(now()->month >= 10 && now()->month <= 12){
            $this->year = now()->year;
            $this->start = '10';
            $this->end = '12';
            $this->quarter = '4th';
        }
    }

    public function getReportProperty()
    {
        $query = Order::with('document_type')
            ->where('status_id', 3)
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', '>=', $this->start)
            ->whereMonth('created_at', '<=', $this->end)
            ->orderBy('created_at')->get();

        $report = [];
        $query->each(function ($item) use (&$report){
            $report[$item->name][$this->departments[$item->department_id]][$item->id] = [
                'ctr_no' => $item->ctr_no,
                'date_received' => Carbon::parse($item->date_received)->format('Y-m-d'),
                'request_type' => $item->document_type_id,
                'title_of_request' => $item->document_type_id,
                'extension' => $item->date_finished > $item->expiration_time ? 'yes' : 'no',
                'status' => $item->status_id,
                'date_finished' => Carbon::parse($item->date_finished)->format('Y-m-d'),
                'days_lapsed' => Carbon::parse($item->date_finished)->diff($item->created_at)->format("%a"),
                'cost' => $item->cost,
                'appeals' => $item->appeals,
                'remarks' => $item->remarks,
            ];
        });
        return $report;
    }

    public function getCostPerCustomerProperty()
    {
        $costQuery = Order::select([
            'name',
            'department_id',
            DB::raw('SUM(cost) as cost'),
        ])
        ->where('status_id', 3)
        ->whereYear('created_at', $this->year)
        ->whereMonth('created_at', '>=', $this->start)
        ->whereMonth('created_at', '<=', $this->end)
        ->groupBy('name')
        ->groupBy('department_id')
        ->orderBy('created_at')->get();

        $costPerCustomer = [];
        $costQuery->each(function ($item) use (&$costPerCustomer){
            $costPerCustomer[$item->name][$this->departments[$item->department_id]] = [
                'cost' => $item->cost,
            ];
        });
        return $costPerCustomer;
    }

    public function getDepartmentsProperty()
    {
        return Department::pluck('name', 'id');
    }

    public function getDocumentTypeProperty()
    {
        return DocumentType::pluck('name', 'id');
    }

    public function getStatusProperty()
    {
        return Status::pluck('name', 'id');
    }

    public function getDocumentCodeProperty()
    {
        return DocumentType::pluck('code', 'id');
    }

    public function updatedQuarter()
    {
        if($this->quarter == '2nd'){
            $this->start = '04';
            $this->end = '06';
        }
        elseif($this->quarter == '3rd'){
            $this->start = '07';
            $this->end = '09';
        }
        elseif($this->quarter == '4th'){
            $this->start = '10';
            $this->end = '12';
        }
        else{
            $this->start = '01';
            $this->end = '03';
        }

        // dd($this->costPerCustomer);
    }

    public function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx']), Response::HTTP_NOT_FOUND);
        
        return Excel::download(new QuarterlyExport($this->report, $this->costPerCustomer, $this->documentType, $this->status, $this->year, $this->quarter, $this->documentCode), $this->quarter. ' Quarter of ' .$this->year. "." .$ext);
    }
}
