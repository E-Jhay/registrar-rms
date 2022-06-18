<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;

class Que extends Component
{
    protected $listeners = [
        '$refresh',
    ];

    public function render()
    {
        return view('livewire.que', [
            'processing'    =>  Order::select('or_no')->where('status_id', 1)->get(),
            'collecting'    =>  Order::select('or_no')->where('status_id', 2)->get()
        ]);
    }
}
