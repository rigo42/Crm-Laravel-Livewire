<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use App\Models\Quotation as ModelsQuotation;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Quotation extends Component
{
    public $client; 
    
    //Tools
    public $perPage = 10;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    public function mount(Client $client){
        $this->client = $client;
    }

    public function render()
    {
        $count = ModelsQuotation::query();
        $quotations = $this->client->quotations()->orderBy('id', 'desc');

        if($this->search){
            $quotations = $quotations->where('concept', 'LIKE', "%{$this->search}%");
        }

        $count = $count->count();
        $quotations = $quotations->paginate($this->perPage);
        return view('livewire.client.quotation', compact('count', 'quotations'));
    }

    public function destroy($id)
    {
        try{
            $quotation = ModelsQuotation::findOrFail($id);
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
