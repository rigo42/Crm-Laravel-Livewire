<?php

namespace App\Http\Livewire\Setting\CategoryService;

use App\Models\CategoryService;
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
        'renderCategoryServices' => 'render',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = CategoryService::count();
        $categoryServices = CategoryService::orderBy('id', 'desc');

        if($this->search){
            $categoryServices = $categoryServices->where('name', 'LIKE', "%{$this->search}%");
        }

        $categoryServices = $categoryServices->paginate($this->perPage);

        return view('livewire.setting.category-service.index', compact('count', 'categoryServices'));
    }

    public function destroy($id)
    {
        try{
            CategoryService::where('id', $id)->delete();
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
