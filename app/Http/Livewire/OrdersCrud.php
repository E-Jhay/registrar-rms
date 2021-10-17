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
    public $documentStatus = 1;
    public $titlePage = "Pending Request";
    // public $itemIdBeingUpdated = null;

    protected $listeners = ['updateConfirmed' => 'update'];
    
    public function render()
    {
        $documentStatus = '%'.$this->documentStatus.'%';
        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.orders-crud', [
            'orders' => Order::with('status', 'document_type')
                            ->where('status_id', 'like', $documentStatus)
                            ->where(function($q) use ($searchTerm) {
                                $q->where('or_no', 'like', $searchTerm)
                                  ->orWhere('ctr_no', 'like', $searchTerm)
                                  ->orWhere('name', 'like', $searchTerm);
                            })
                            // ->where('or_no', 'like', $searchTerm)
                            // ->where('ctr_no', 'like', $searchTerm)
                            // ->where('id', 'like', $searchTerm)
                            ->orderBy($this->sortBy, $this->sortDirection)
                            ->paginate(10),
            'statuses' => Status::all()
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function sort($field)
    {
        if($this->sortDirection == 'desc'){
            $this->sortDirection = 'asc';
        }else{
            $this->sortDirection = 'desc';
        }

        return $this->sortBy = $field;
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

        return $this->documentStatus = $status;
    }

    public function updateConfirm($id)
    {
        // $this->itemIdBeingUpdated = $id;
        $this->dispatchBrowserEvent('swal:confirm',[
            'type'  =>  'warning',
            'title' =>  'Are you sure?',
            'text'  =>  '',
            'id'    =>  $id,
        ]);
    }
    public function update($id)
    {
        try{
            $order = Order::where('id', $id)->first();
            $order->update(['status_id' => $order['status_id'] + 1]);
            // Order::find($id)->update(['status_id' => $this->documentStatus + 1]);
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Order has been Processed"
            ]);
            $this->resetPage();
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong while processing order!"
            ]);
        }
    }
}
