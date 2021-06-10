<?php

namespace App\Http\Livewire\User;

use App\Models\Client;
use App\Models\Prospect;
use App\Models\User;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Transfer extends Component
{
    use WithPagination;

    //Object
    public $user; 

    //Atributes
    public $userIdNew;
    public $prospectArray = [];
    public $clientArray = [];

    public $searchProspect;
    public $searchClient;
    protected $queryString = [
        'searchProspect' => ['except' => ''],
        'searchClient' => ['except' => ''],
    ];

    //Theme
    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'userIdNew' => 'required',
        ];
    }

    public function updatingSearchProspect()
    {
        $this->resetPage();
    }


    public function mount(User $user){
        $this->user = $user;
    }

    public function render()
    {

        //Prospects
        $prospects = $this->user->prospects()->orderBy('id', 'desc');
        $countProspects = $this->user->prospects()->count();

        //Client
        $clients = $this->user->clients()->orderBy('id', 'desc');
        $countClients = $this->user->clients()->count();

        //Users to transfers selections
        $users = User::where('id', '!=', $this->user->id)->cursor();

        //Filters
        if($this->searchProspect){
            $prospects = $prospects->where('name', 'LIKE', "%{$this->searchProspect}%");
        }
        if($this->searchClient){
            $clients = $clients->where('name', 'LIKE', "%{$this->searchClient}%");
        }

        $prospects = $prospects->cursor();
        $clients = $clients->cursor();

        return view('livewire.user.transfer', compact('prospects', 'countProspects', 'clients', 'countClients' ,'users'));
    }

    public function trasnferProspect(){
        $this->validate();
        $this->validate([
            'prospectArray' => 'required',
        ]);
        try{

            foreach($this->prospectArray as $id){
                $prospect = Prospect::findOrFail($id);
                $prospect->user_id = $this->userIdNew;
                $prospect->update();
            }

            $this->reset('userIdNew', 'prospectArray');

            $this->alert('success', 
                    'Transferencia de prospectos con exito ', 
                    [
                        'showConfirmButton' => false,
                        'timer' => 2000,
                    ]);
        }catch(Exception $e){
            $this->alert('error', 
                'Ocurrio un error al transferir: '.$e->getMessage(), 
                [
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entiendo',
                    'timer' => null,
                ]);
        }
    }

    public function trasnferClient(){
        $this->validate();
        $this->validate([
            'clientArray' => 'required',
        ]);
        try{
            foreach($this->clientArray as $id){
                $client = Client::findOrFail($id);
                $client->user_id = $this->userIdNew;
                $client->update();
            }

            $this->reset('userIdNew', 'prospectArray');

            $this->alert('success', 
                'Transferencia de clientes con exito ', 
                [
                    'showConfirmButton' => false,
                    'timer' => 2000,
                ]);

        }catch(Exception $e){
            $this->alert('error', 
                'Ocurrio un error al transferir: '.$e->getMessage(), 
                [
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entiendo',
                    'timer' => null,
                ]);
        }
    }

    public function addAllProspect(){
        try{
            $prospects = $this->user->prospects()->cursor();
            foreach($prospects as $prospect){
                array_push($this->prospectArray, "".$prospect->id."");
            }
        }catch(Exception $e){
            $this->alert('error', 
                'Ocurrio un error al seleccionar todos los prospectos: '.$e->getMessage(), 
                [
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entiendo',
                    'timer' => null,
                ]);
        }
        
        $this->emit('unblockPage');
    }

    public function addAllClient(){
        try{
            $clients = $this->user->clients()->cursor();
            foreach($clients as $client){
                array_push($this->clientArray, "".$client->id."");
            }
        }catch(Exception $e){
            $this->alert('error', 
                'Ocurrio un error al seleccionar todos los clientes: '.$e->getMessage(), 
                [
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entiendo',
                    'timer' => null,
                ]);
        }

        $this->emit('unblockPage');
    }

    public function removeAllProspect(){
        $this->reset('prospectArray');
        $this->emit('unblockPage');
    }

    public function removeAllClient(){
        $this->reset('clientArray');
        $this->emit('unblockPage');
    }

}
