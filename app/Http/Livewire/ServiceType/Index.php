<?php

namespace App\Http\Livewire\ServiceType;

use App\Models\ServiceType;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    //Tools
    public $perPage = 20;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    //Listeners
    protected $listeners = ['render'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = ServiceType::count();
        $serviceTypes = ServiceType::orderBy('id', 'desc');

        if($this->search){
            $serviceTypes = $serviceTypes->where('name', 'LIKE', "%{$this->search}%");
        }

        $serviceTypes = $serviceTypes->paginate($this->perPage);

        return view('livewire.service-type.index', compact('count', 'serviceTypes'));
    }

    public function destroy(ServiceType $serviceType)
    {
        try{
            $serviceType->delete();
            $this->alert('success', 'Eliminación con exito');
        }catch(Exception $e){
            $this->alert('error', 
                'Ocurrio un error en la eliminación: '.$e->getMessage(), 
                [
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entiendo',
                    'timer' => null,
                ]);
        }
    }
}
