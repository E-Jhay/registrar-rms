<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AccountsCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $sortBy = 'created_at';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $isOpen = 0;
    public $isNewAccount = true;
    public $name, $email, $password, $password_confirmation;
    public $accountId;

    protected $listeners = ['destroyConfirmed' => 'destroy'];

    public function render()
    {
        $searchTerm = '%'. $this->searchTerm .'%';
        return view('livewire.accounts-crud', [
            'accounts' => User::where('name', 'like', $searchTerm)
                            ->orWhere('email', 'like', $searchTerm)
                            ->orderBy($this->sortBy, $this->sortDirection)
                            ->paginate($this->perPage)
        ]);
    }

    public function create()
    {
        $this->isNewAccount = true;
        $this->resetFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            User::create([
                'name'  =>  $this->name,
                'email'  =>  $this->email,
                'password'  =>  $this->password,
            ]);

            $this->dispatchBrowserEvent('alert',[
                'type'  =>  'success',
                'message'   =>  'Account Created'
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
        $this->isNewAccount = false;
        $account = User::findOrFail($id);
        $this->name = $account->name;
        $this->email = $account->email;
        $this->accountId = $id;
        $this->emit('gotoTop');
        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,'.$this->accountId]
        ]);

        try {
            User::where('id', $this->accountId)
                ->update([
                'name'  =>  $this->name,
                'email'  =>  $this->email,
            ]);

            $this->dispatchBrowserEvent('alert',[
                'type'  =>  'success',
                'message'   =>  'Account Updated Successfully'
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

    public function destroyConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:accountsConfirm',[
            'type'  =>  'warning',
            'title' =>  'Are you sure?',
            'text'  =>  '',
            'id'    =>  $id,
        ]);
    }
    
    public function destroy($id)
    {
        try{
            User::findOrFail($id)
            ->delete();

            $this->dispatchBrowserEvent('alert',[
                'type'  =>  'success',
                'message'   =>  'Account Deleted Successfully'
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'  =>  'error',
                'message'   =>  'Something goes wrong!!'
            ]);
        }
        
    }
}
