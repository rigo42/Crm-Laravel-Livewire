<?php

namespace App\Http\Livewire\Client\General;

use Livewire\Component;

class Index extends Component
{

    public $user;

    protected $listeners = ['destroy'];

    public function render()
    {
        return view('livewire.client.general.index');
    }

    public function destroy()
    {
        $this->user; //Delete()
        $this->alert('success', 'Eliminación con exito');
    }

    public function confirmDestroy($user)
    {
        $this->confirm('¿Estás seguro?', [
            'text' =>  'No podrá recuperar este cliente y todas las facturas, estimaciones y pagos relacionados.', 
        ]);
    }
}
