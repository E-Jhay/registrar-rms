<?php

namespace App\Http\Livewire;

use App\Models\DocumentType;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Node\Stmt\TryCatch;

class DocumentsCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $isOpen = 0;
    public $buttonText = "Insert Document";
    public $name, $code, $days_before_expire, $price, $documentId;

    public function render()
    {
        return view('livewire.documents-crud', [
            'documents' => DocumentType::select('id', 'name', 'code', 'price', 'days_before_expire')->orderBy('name')->paginate(10),
        ]);
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'name'  =>  'required',
            'code'  =>  'required',
            'price'  =>  'required',
            'days_before_expire'    =>  ['required', 'numeric'],
        ]);

        try {
            DocumentType::updateOrCreate(['id' => $this->documentId], [
                'name'  =>  $this->name,
                'code'  =>  $this->code,
                'price'  =>  $this->price,
                'days_before_expire'  =>  $this->days_before_expire,
            ]);

            $this->dispatchBrowserEvent('alert',[
                'type'  =>  'success',
                'message'   =>  $this->documentId ? 'Document Updated Successfully' : 'Document Created'
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong!!"
            ]);
        }
        

        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $this->buttonText = "Update Document";
        $document = DocumentType::findOrFail($id);
        $this->name = $document->name;
        $this->code = $document->code;
        $this->price = $document->price;
        $this->days_before_expire = $document->days_before_expire;
        $this->documentId = $id;
        $this->emit('gotoTop');
        $this->openModal();

    }

    public function resetFields(){
        $this->name = '';
        $this->code = '';
        $this->price = '';
        $this->days_before_expire = '';
        $this->documentId = '';
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->buttonText = "Insert Document";
        $this->isOpen = false;
    }
}
