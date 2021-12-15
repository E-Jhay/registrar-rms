<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\DocumentType;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class OrdersCreate extends Component
{
    public $mobile, $or_no;
    public $document_types = [];
    public $departments = [];
    public $orderItems = [];

    public function mount()
    {
        $this->document_types = DocumentType::select('id', 'name')->orderBy('name')->get();
        $this->departments = Department::select('id', 'name')->get();
        $this->orderItems = [
            ['document_type_id' => '', 'name' => '', 'department_id' => '']
        ];
    }

    public function render()
    {
        return view('livewire.orders-create');
    }
    
    // Add Item to array
    public function addItem()
    {
        $this->orderItems[] = ['document_type_id' => '', 'name' => '', 'department_id' => ''];
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
            ['document_type_id' => '', 'name' => '', 'department_id' => '']
        ];
    }

    // Store Orders/Request to the db
    public function storeItem()
    {
        $this->validate([
            'mobile'                        =>  ['required', 'regex:/^9\d{9}$/'],
            'or_no'                         =>  ['required'],
            'orderItems.*.name'             =>  ['required'],
            'orderItems.*.document_type_id' =>  ['required'],
            'orderItems.*.department_id'    =>  ['required'],
            ],
            [
            'orderItems.*.name.required'             =>  'The name is required',
            'orderItems.*.document_type_id.required'  =>  'The document type is required',
            'orderItems.*.department_id.required'  =>  'The department is required',
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

                    $cost = DocumentType::select('price')->where('id', $item['document_type_id'] + 1)->pluck('price')->toArray();
                    Order::create([
                        'ctr_no'        =>  $ctr_no,
                        'name'          =>  $item['name'],
                        'mobile'        =>  $this->mobile,
                        'cost'        =>  $cost[0],
                        'department_id' =>  $item['department_id'] + 1,
                        'document_type_id' =>  $item['document_type_id'] + 1,
                        'status_id'        =>  1,
                        'or_no'         =>  $this->or_no,
                        'expiration_time'         =>  Carbon::now()->addDays($documentExpirationDay[$item['document_type_id']]),
                    ]);
                }
            }
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Document/s Successfully Requested"
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong"
            ]);
        }

        $this->resetFields();

    }
    
}
