<?php

namespace App\Http\Livewire;

use App\Models\DocumentType;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\Request;

class Orders extends Component
{
    public $mobile, $or_no;
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

    public function resetFields(){
        $this->mobile = '';
        $this->or_no = '';
        $this->orderItems = [
            ['document_type_id' => '', 'name' => '']
        ];
    }
    public function storeItem()
    {
        $this->validate([
            'mobile'                        =>  ['required', 'regex:/^09\d{9}$/'],
            'or_no'                         =>  ['required'],
            'orderItems.*.name'             =>  ['required'],
            'orderItems.*.document_type_id' =>  ['required'],
            ],
            [
            'orderItems.*.name.required'             =>  'The name is required',
            'orderItems.*.document_type_id.required'  =>  'The document type is required',
        ]);

        $expiration_time = Carbon::now()->addDays(10);
        $documents_array = array(1 => 'ROR', 2 => 'COR', 3 => 'COG', 4 => 'TOR', 5 => 'CAV', 6 => 'ATL', 7 => 'GWA');

        try{
            foreach($this->orderItems as $item){
                if($item['name'] != null){
                    $count = Order::where('document_type_id', $item['document_type_id'])->count() + 1;
                    $code = $documents_array[$item['document_type_id']];
                    if($count < 10)
                        $ctr_no = $code ."-0". $count;
                    else
                    $ctr_no = $code ."-". $count;
                    $order = Order::create([
                        'ctr_no'        =>  $ctr_no,
                        'name'          =>  $item['name'],
                        'mobile'        =>  $this->mobile,
                        'document_type_id' =>  $item['document_type_id'],
                        'status_id'        =>  1,
                        'or_no'         =>  $this->or_no,
                        'expiration_time'         =>  $expiration_time,
                    ]);
                }
            }
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Order Inserted Successfully!!"
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong while creating Order!!"
            ]);
        }

        $this->resetFields();

    }
    
    public function render()
    {
        return view('livewire.orders');
    }
}
