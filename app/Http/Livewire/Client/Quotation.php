<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
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
        $count = Client::query();
        $quotations = $this->client->quotations()->orderBy('id', 'desc');

        if($this->search){
            $quotations = $quotations->where('concept', 'LIKE', "%{$this->search}%");
        }

        $count = $count->count();
        $quotations = $quotations->paginate($this->perPage);
        return view('livewire.client.quotation', compact('count', 'quotations'));
    }
}
