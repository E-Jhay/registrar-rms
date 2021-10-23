<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
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
            'statuses' => Status::all()
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if($value){
            $this->selectedItems = $this->orders->pluck('status_id', 'id')->map(fn ($item) => (string) $item)->toArray();
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
        $documentStatus = '%'.$this->documentStatus.'%';
        $searchTerm = '%'.$this->searchTerm.'%';
        return Order::with('status', 'document_type')
        ->where('status_id', 'like', $documentStatus)
        ->where(function($q) use ($searchTerm) {
            $q->where('or_no', 'like', $searchTerm)
              ->orWhere('ctr_no', 'like', $searchTerm)
              ->orWhere('name', 'like', $searchTerm);
        })
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);
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
        $this->dispatchBrowserEvent('swal:confirm',[
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
                'selectedItems.*' => ['required', 'in:1,2'],
            ]);
            foreach($this->selectedItems as $index => $item){
                Order::where('id', $index)->update(['status_id' => $item + 1]);
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
