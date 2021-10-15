<?php

namespace App\Http\Livewire;

use App\Models\Order;
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
                            ->paginate(10)
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
        if($status == 1)
            $this->titlePage = 'Pending Requests';

        elseif($status == 2)
            $this->titlePage = 'Finished Requests';

        else{
            $this->titlePage = 'All Requests';
            return $this->documentStatus = $status;
        }

        return $this->documentStatus = $status;
    }
}
