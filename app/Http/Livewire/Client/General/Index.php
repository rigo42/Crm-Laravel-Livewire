<?php

namespace App\Http\Livewire\Client\General;

use App\Models\Client;
use Exception;
use Illuminate\Support\Facades\Storage;
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = Client::count();
        $clients = Client::orderBy('id', 'desc');

        if($this->search){
            $clients = $clients->where('name', 'LIKE', "%{$this->search}%");
        }

        $clients = $clients->paginate($this->perPage);
        return view('livewire.client.general.index', compact('count', 'clients'));
    }

    public function destroy($id)
    {
        try{
            $client = Client::findOrFail($id);
            if($client->image && Storage::exists($client->image->image)){
                Storage::delete($client->image->image);
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
