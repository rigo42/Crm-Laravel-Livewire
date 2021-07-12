<?php

namespace App\Http\Livewire\Quotation;

use App\Models\Client;
use App\Models\Quotation;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $client;
    public $userPresent;

    //Tools
    public $perPage = 10;
    public $search;
    protected $queryString = ['search' => ['except' => '']];   

    //Theme
    protected $paginationTheme = 'bootstrap';

    public function mount($client = null){
        $this->userPresent = User::find(Auth::user()->id);
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
        $count = Quotation::with('client');
        $quotations = Quotation::with('client')->orderBy('id', 'desc');

        if(!$this->userPresent->hasRole('Administrador')){
            $count = $count->whereHas('client', function($query){
                $query->where('user_id', $this->userPresent->id);
            });
            $quotations = $quotations->whereHas('client', function($query){
                $query->where('user_id', $this->userPresent->id);
            });
        }
        
        if($this->client){
            $count = $this->client->quotations();
            $quotations = $quotations->whereHas('client', function($query){
                $query->where('client_id', $this->client->id);
            });
        }
        

        if($this->search){
            $quotations = $quotations->where('concept', 'LIKE', "%{$this->search}%")
                                        ->orWhereHas('client', function($query){
                                            $query->where('name', 'LIKE', "%{$this->search}%");
                                        });
        }

        $count = $count->count();
        $quotations = $quotations->paginate($this->perPage);

        return view('livewire.quotation.index', compact('count', 'quotations'));
    }

    public function destroy($id)
    {
        try{
            $quotation = Quotation::findOrFail($id);
            if(Storage::exists($quotation->url)){
                Storage::delete($quotation->url);
            }
            $quotation->delete();
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
