<?php

namespace App\Http\Livewire\Setting\Permission;

use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

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
        'renderPermissions' => 'render',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = Permission::count();
        $permissions = Permission::orderBy('id', 'desc');

        if($this->search){
            $permissions = $permissions->where('name', 'LIKE', "%{$this->search}%");
        }

        $permissions = $permissions->paginate($this->perPage);

        return view('livewire.setting.permission.index', compact('count', 'permissions'));
    }

    public function destroy($id)
    {
        try{
            $permission = Permission::findOrFail($id);
            $permission->delete();
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
