<?php

namespace App\Http\Livewire;

use App\Models\DocumentType;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class OrdersCreate extends Component
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

    public function render()
    {
        return view('livewire.orders-create');
    }
    
    // Add Item to array
    public function addItem()
    {
        $this->orderItems[] = ['document_type_id' => '', 'name' => ''];
    }

    // Remove Item to array
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

    // Store Orders/Request to the db
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

        $documentExpirationDay = [];
        $documentTypes = [];
        $documents_array = DocumentType::select('id', 'code', 'days_before_expire')->get();

        // store documents in an array format 0-n
        foreach ($documents_array as $document){
            array_push($documentTypes, $document['code']);
            array_push($documentExpirationDay, $document['days_before_expire']);
        }
        try{
            foreach($this->orderItems as $item){
                if($item['name'] != null){
                    $count = Order::where('document_type_id', $item['document_type_id'] + 1)->count() + 1;
                    $code = $documentTypes[$item['document_type_id']];
                    if($count < 10)
                        $ctr_no = $code ."-0". $count;
                    else
                        $ctr_no = $code ."-". $count;
                    Order::create([
                        'ctr_no'        =>  $ctr_no,
                        'name'          =>  $item['name'],
                        'mobile'        =>  $this->mobile,
                        'document_type_id' =>  $item['document_type_id'] + 1,
                        'status_id'        =>  1,
                        'or_no'         =>  $this->or_no,
                        'expiration_time'         =>  Carbon::now()->addDays($documentExpirationDay[$item['document_type_id']]),
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
    
}
