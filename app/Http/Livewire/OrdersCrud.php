<?php

namespace App\Http\Livewire;

use App\Models\DocumentType;
use App\Models\Order;
use App\Models\Status;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Nexmo\Laravel\Facade\Nexmo;

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
            'documentTypes' => DocumentType::select('id', 'name', 'code')->orderBy('name')->get()
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
            'title' =>  'Are you sure you want to update selected items?',
            'text'  =>  '',
            // 'id'    =>  $id,
        ]);
    }
    public function update($appeals, $remarks)
    {
        // dd($appeals, $remarks);
        
        try{
            $this->validate([
                'selectedItems.*' => ['required', 'in:1,2,4'],
            ]);
            
            // Get the numbers of the selected items
            $numbers = Order::find(array_keys($this->selectedItems))
            ->where('status_id', 2)
            ->pluck('mobile')
            ->toArray();
            // make the number unique
            $unique_numbers = array_unique($numbers);
            // dd($unique_numbers);

            foreach($unique_numbers as $key => $mobile){
                Nexmo::message()->send([
                    'to'    =>  '63'.$mobile,
                    'from'  =>  '639959423520',
                    'text'  =>  'Your request at the registrar is ready to claim!2'
                ]);
            }

            foreach($this->selectedItems as $index => $item){
                if($item == 1){
                    Order::where('id', $index)->update([
                        'status_id' => $item + 1,
                        'date_finished' => now(),
                        'appeals' => $appeals ? $appeals : 'none',
                        'remarks' => $remarks ? $remarks : 'none'
                    ]);
                }
                elseif($item == 2){
                    Order::where('id', $index)->update([
                        'status_id' => $item + 1,
                        'date_received' => now(),
                        'appeals' => $appeals ? $appeals : 'none',
                        'remarks' => $remarks ? $remarks : 'none'
                    ]);
                }
                elseif($item == 4){
                    Order::where('id', $index)->update([
                        'status_id' => 1,
                        'expiration_time' => Carbon::tomorrow(),
                        'appeals' => $appeals ? $appeals : 'none',
                        'remarks' => $remarks ? $remarks : 'none'
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
                'message'=>$e
            ]);
        }

    }

}
