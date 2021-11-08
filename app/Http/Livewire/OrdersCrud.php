<?php

namespace App\Http\Livewire;

use App\Models\DocumentType;
use App\Models\Order;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $sortId;
    public $sortBy = 'created_at';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $documentStatus = 1;
    public $titlePage = "Pending Request";
    public $selectedItems = [];
    public $bulkDisabled = true;
    public $selectAll = false;

    protected $listeners = ['updateConfirmed' => 'update'];
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectedItems) < 1;
        return view('livewire.orders-crud', [
            'orders' => $this->orders,
            'statuses' => Status::all(),
            'documentTypes' => DocumentType::select('id', 'name', 'code')->get()
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if($value){
            $this->selectedItems = $this->ordersQuery->pluck('status_id', 'id')->map(fn ($item) => (string) $item)->toArray();
        }else{
            $this->selectedItems = [];
        }
    }

    public function updatedSelectedItems()
    {
        foreach (array_keys($this->selectedItems, false, true) as $key) {
            unset($this->selectedItems[$key]);
        }
        $this->selectAll = false;
    }

    public function getOrdersProperty()
    {
        return $this->OrdersQuery->paginate($this->perPage);
    }

    public function getOrdersQueryProperty()
    {
        $documentStatus = $this->documentStatus;
        $searchTerm = $this->searchTerm;
        $sortId = $this->sortId;
        return Order::with('status', 'document_type')
        ->when($documentStatus, function ($q) use ($documentStatus) {
            $q->where('status_id', $documentStatus);
        })
        ->when($sortId, function($q) use ($sortId) {
            $q->where('document_type_id', $sortId);
        })
        ->when($searchTerm, function($q) use ($searchTerm) {
            $q->where('or_no', $searchTerm)
              ->orWhere('ctr_no', $searchTerm)
              ->orWhere('name', $searchTerm);
        })
        ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function changeStatus($status)
    {
        $fetchStatuses = Status::select('id', 'name')->get();
        foreach($fetchStatuses as $fetchStatus){
            if($status == $fetchStatus['id'])
                $this->titlePage = $fetchStatus['name'] ." Request";
            elseif($status == '')
                $this->titlePage = "All Request";

        }
        $this->resetPage();
        return $this->documentStatus = $status;
    }

    public function updateConfirm()
    {
        $this->dispatchBrowserEvent('swal:ordersConfirm',[
            'type'  =>  'warning',
            'title' =>  'Are you sure?',
            'text'  =>  '',
            // 'id'    =>  $id,
        ]);
    }
    public function update()
    {
        // dd($this->selectedItems);
        
        try{
            $this->validate([
                'selectedItems.*' => ['required', 'in:1,2,4'],
            ]);
            foreach($this->selectedItems as $index => $item){
                if($item == 1){
                    Order::where('id', $index)->update([
                        'status_id' => $item + 1,
                        'date_finished' => now()
                    ]);
                }
                elseif($item == 2){
                    Order::where('id', $index)->update([
                        'status_id' => $item + 1,
                        'date_received' => now()
                    ]);
                }
                elseif($item == 4){
                    Order::where('id', $index)->update([
                        'status_id' => 1,
                    ]);
                }
            }
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Order has been Processed"
            ]);
            $this->selectedItems = [];
            $this->selectAll = false;
            $this->resetPage();
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong while processing order!"
            ]);
        }

    }

}
