<?php

namespace App\Http\Livewire\Setting\Account;

use App\Models\Account;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $account;

    protected function rules()
    {
        return [
            'account.name' => 'required|unique:accounts,name,'.$this->account->id,
            'account.type' => 'required',
        ];
    }

    public function mount(Account $account, $method){
        $this->account = $account;
        $this->method = $method;
    }

    public function render()
    {
        return view('livewire.setting.account.form');
    }

    public function store(){
        $this->validate();
        $this->account->save();
        $this->account = new Account();
        $this->alert('success', 'Cuenta de servicio agregada con exito');
        $this->emit('render');
        $this->emit('closeModal');
    }

    public function update(){
        $this->validate();
        $this->account->update();
        $this->emit('render');
        $this->alert('success', 'Cuenta modificada con exito');
        $this->emit('closeModal');
    }
}
