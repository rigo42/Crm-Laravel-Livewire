<?php

namespace App\Http\Livewire\Setting\Role;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;

    //Tools
    public $perPage = 10;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    //Listeners
    protected $listeners = [
        'renderRoles' => 'render',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = Role::count();
        $roles = Role::orderBy('id', 'desc');

        if($this->search){
            $roles = $roles->where('name', 'LIKE', "%{$this->search}%");
        }

        $roles = $roles->paginate($this->perPage);

        return view('livewire.setting.role.index', compact('count', 'roles'));
    }

    public function destroy($id)
    {
        try{
            $role = Role::findOrFail($id);
            $role->delete();
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
