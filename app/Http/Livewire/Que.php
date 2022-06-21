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
            'processing'    =>  Order::distinct('or_no')->where('status_id', 1)->get('or_no'),
            'collecting'    =>  Order::distinct('or_no')->where('status_id', 2)->get('or_no')
        ]);
    }
}
