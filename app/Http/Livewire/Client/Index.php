<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    //User actual
    public $user;

    //Tools
    public $perPage = 10;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->user = User::find(Auth::user()->id);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = Client::query();
        $clients = Client::orderBy('id', 'desc');

        if(!$this->user->hasRole('Administrador')){
            $count = $count->where('user_id', Auth::user()->id);
            $clients = $clients->where('user_id', Auth::user()->id);
        }

        if($this->search){
            $clients = $clients->where('name', 'LIKE', "%{$this->search}%");
        }

        $count = $count->count();
        $clients = $clients->paginate($this->perPage);
        return view('livewire.client.index', compact('count', 'clients'));
    }

    public function destroy($id)
    {
        try{
            $client = Client::findOrFail($id);
            if($client->image && Storage::exists($client->image->url)){
                Storage::delete($client->image->url);
            }
            $client->delete();
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
