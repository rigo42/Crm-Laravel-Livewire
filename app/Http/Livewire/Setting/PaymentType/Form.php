<?php

namespace App\Http\Livewire\Setting\PaymentType;

use App\Models\PaymentType;
use Livewire\Component;

class Form extends Component
{

    public $method;
    public $paymentType;

    protected function rules()
    {
        return [
            'paymentType.name' => 'required|unique:payment_types,name,'.$this->paymentType->id,
        ];
    }

    public function mount(PaymentType $paymentType, $method){
        $this->paymentType = $paymentType;
        $this->method = $method;
    }

    public function render()
    {
        return view('livewire.setting.payment-type.form');
    }

    public function store(){
        $this->validate();
        $this->paymentType->save();
        $this->paymentType = new PaymentType();
        $this->alert('success', 'Tipo de pago agregada con exito');
        $this->emit('render');
        $this->emit('closeModal');
    }

    public function storeCustom(){
        $this->validate();
        $this->paymentType->save();
        $this->paymentType = new PaymentType();
        $this->emit('render');
        $this->alert('success', 'Tipo de pago agregada con exito');
        
    }

    public function update(){
        $this->validate();
        $this->paymentType->update();
        $this->emit('render');
        $this->alert('success', 'Tipo modpagocon exito');
        $this->emit('closeModal');
    }
}
