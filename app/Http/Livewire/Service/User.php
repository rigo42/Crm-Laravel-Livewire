<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use App\Models\User as ModelsUser;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class User extends Component
{
    public $service; 
    
    //Tools
    public $perPage = 10;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    public function mount(Service $service){
        $this->service = $service;
    }

    public function render()
    {
        $count = $this->service->users()->count();
        $users = $this->service->users()->orderBy('id', 'desc');

        if($this->search){
            $users = $users->where('name', 'LIKE', "%{$this->search}%")
                            ->orWhereHas('roles', function($query){
                                $query->where('name', 'LIKE', "%{$this->search}%");
                            });
        }

        $users = $users->paginate($this->perPage);
        return view('livewire.service.user', compact('count', 'users'));
    }

    public function removeUser($id)
    {
        try{
            $this->service->users()->detach($id);
            $this->alert('success', 'Se removio con exito');
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
