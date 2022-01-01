<?php

namespace App\Http\Livewire;

use App\Models\DocumentType;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LogsCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $sortId;
    public $sortUser;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $documentStatus = "";
    public function render()
    {
        return view('livewire.logs-crud', [
            'orders' => $this->orders,
            'statuses' => Status::all(),
            'users' => User::select('id', 'name')->get(),
            'documentTypes' => DocumentType::select('id', 'name', 'code')->orderBy('name')->get()
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function getOrdersProperty()
    {
        $documentStatus = $this->documentStatus;
        $searchTerm = $this->searchTerm;
        $sortId = $this->sortId;
        $sortUser = $this->sortUser;
        return Order::with('status', 'document_type')
        ->when($documentStatus, function ($q) use ($documentStatus) {
            $q->where('status_id', $documentStatus);
        })
        ->when($sortId, function($q) use ($sortId) {
            $q->where('document_type_id', $sortId);
        })
        ->when($sortUser, function($q) use ($sortUser) {
            $q->where('user_id', $sortUser);
        })
        ->when($searchTerm, function($q) use ($searchTerm) {
            $q->where('or_no', $searchTerm)
              ->orWhere('ctr_no', $searchTerm)
              ->orWhere('name', $searchTerm);
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
        $this->selectedItems = [];
        $this->selectAll = false;
        $this->resetPage();
        return $this->documentStatus = $status;
    }
}
