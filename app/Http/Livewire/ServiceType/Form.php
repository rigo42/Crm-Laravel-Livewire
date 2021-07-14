<?php

namespace App\Http\Livewire\ServiceType;

use App\Models\ServiceType;
use Livewire\Component;

class Form extends Component
{   
    public $method;
    public $serviceType;

    protected function rules()
    {
        return [
            'serviceType.name' => 'required|unique:service_types,name,'.$this->serviceType->id,
            'serviceType.price' => 'required|numeric',
        ];
    }

    public function mount(ServiceType $serviceType, $method){
        $this->serviceType = $serviceType;
        $this->method = $method;
    }

    public function render()
    {
        return view('livewire.service-type.form');
    }

    public function store(){
        $this->validate();
        $this->serviceType->save();
        $this->serviceType = new ServiceType();
        $this->alert('success', 'Tipo de servicio agregado con exito');
        $this->emit('render');
        $this->emit('closeModal');
    }

    public function storeCustom(){
        $this->validate();
        $this->serviceType->save();
        $this->serviceType = new ServiceType();
        $this->emit('render');
        $this->alert('success', 'Tipo de servicio agregado con exito');
    }

    public function update(){
        $this->validate();
        $this->serviceType->update();
        $this->emit('render');
        $this->alert('success', 'Tipo de servicio modificado con exito');
        $this->emit('closeModal');
    }
}
