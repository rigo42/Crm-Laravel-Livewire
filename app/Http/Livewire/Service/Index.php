<?php

namespace App\Http\Livewire\Service;

use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    //User actual
    public $userPresent;
    //Client passed by parameter
    public $client;

    //Tools
    public $perPage = 10;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    public function mount($client = null){
        $this->userPresent = User::find(Auth::id());
        if($client){
            $this->client = Client::findOrFail($client->id);
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = Service::query();
        $services = Service::orderBy('id', 'desc');

        if($this->client){
            $count = $count->where('client_id', $this->client->id);
            $services = $services->where('client_id', $this->client->id);

        }elseif(!$this->userPresent->hasRole('Administrador')){
            $count = $count->whereHas('client', function($query){
                $query->where('user_id', $this->userPresent->id);
            });
            $services = $services->whereHas('client', function($query){
                $query->where('user_id', $this->userPresent->id);
            });
        }

        if($this->search){
            $services = $services->where('name', 'LIKE', "%{$this->search}%")
                                    ->orWhereHas('client', function($query){
                                        $query->where('name', 'LIKE', "%{$this->search}%");
                                    })
                                    ->orWhereHas('categoryService', function($query){
                                        $query->where('name', 'LIKE', "%{$this->search}%");
                                    });
        }

        $count = $count->count();
        $services = $services->paginate($this->perPage);
        return view('livewire.service.index', compact('count', 'services'));
    }

    public function destroy($id)
    {
        try{
            $service = Service::find($id)->delete();
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
