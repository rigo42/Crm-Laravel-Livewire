<?php

namespace App\Http\Livewire\Setting\CategoryClient;

use App\Models\CategoryClient;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

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
    protected $listeners = ['render'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = CategoryClient::count();
        $categoryClients = CategoryClient::orderBy('id', 'desc');

        if($this->search){
            $categoryClients = $categoryClients->where('name', 'LIKE', "%{$this->search}%");
        }

        $categoryClients = $categoryClients->paginate($this->perPage);

        return view('livewire.setting.category-client.index', compact('count', 'categoryClients'));
    }

    public function destroy($id)
    {
        try{
            CategoryClient::where('id', $id)->delete();
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
