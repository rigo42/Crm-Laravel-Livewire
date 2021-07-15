<?php

namespace App\Http\Livewire\Provider;

use App\Models\Provider;
use Exception;
use Illuminate\Support\Facades\Storage;
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
        $count = Provider::count();
        $providers = Provider::orderBy('id', 'desc');

        if($this->search){
            $providers = $providers->where('name', 'LIKE', "%{$this->search}%")
                                    ->orWhere('description', 'LIKE', "%{$this->search}%");
        }

        $providers = $providers->paginate($this->perPage);

        return view('livewire.provider.index', compact('count', 'providers'));
    }

    public function destroy(Provider $provider)
    {
        try{
            if($provider->image && Storage::exists($provider->image->url)){
                Storage::delete($provider->image->url);
            }
            $provider->delete();
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
