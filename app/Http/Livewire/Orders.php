<?php

namespace App\Http\Livewire;

use App\Models\DocumentType;
use Livewire\Component;

class Orders extends Component
{
    public $document_types = [];
    public $orderItems = [];

    public function mount()
    {
        $this->document_types = DocumentType::all();
        $this->orderItems = [
            ['document_type_id' => '', 'name' => '']
        ];
    }

    public function addItem()
    {
        $this->orderItems[] = ['document_type_id' => '', 'name' => ''];
    }

    public function removeItem($index)
    {
        unset($this->orderItems[$index]);
        $this->orderItems = array_values($this->orderItems);
    }
    public function render()
    {
        return view('livewire.orders');
    }
}
