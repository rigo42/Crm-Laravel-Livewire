<?php

namespace App\Http\Livewire\Client\General;

use Livewire\Component;

class Form extends Component
{
    public $method;

    public function render()
    {
        return view('livewire.client.general.form');
    }

    public function store(){
        session()->flash('alert','Cliente agregado con exito');
        session()->flash('alert-type','success');
    }
}
