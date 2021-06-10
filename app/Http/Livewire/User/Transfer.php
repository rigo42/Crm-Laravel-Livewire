<?php

namespace App\Http\Livewire\User;

use App\Models\Prospect;
use App\Models\User;
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

    public $searchProspect;
    protected $queryString = ['searchProspect' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'userIdNew' => 'required',
            'prospectArray' => 'required',
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

        //prospects
        $prospects = $this->user->prospects()->orderBy('id', 'desc');
        $countProspects = $this->user->prospects()->count();

        //Users to transfers selections
        $users = User::where('id', '!=', $this->user->id)->cursor();

        //Filters
        if($this->searchProspect){
            $prospects = $prospects->where('name', 'LIKE', "%{$this->searchProspect}%");
        }

        $prospects = $prospects->cursor();

        return view('livewire.user.transfer', compact('prospects', 'countProspects' ,'users'));
    }

    public function trasnferProspect(){
        $this->validate();
        foreach($this->prospectArray as $id){
            $prospect = Prospect::findOrFail($id);
            $prospect->user_id = $this->userIdNew;
            $prospect->update();
        }
        $this->alert('success', 
                'Transferencia de prospectos con exito ', 
                [
                    'showConfirmButton' => false,
                    'timer' => 2000,
                ]);
    }

    public function addAllProspect(){
        $prospects = $this->user->prospects()->cursor();
        foreach($prospects as $prospect){
            array_push($this->prospectArray, "".$prospect->id."");
        }
        $this->emit('unblockPage');
    }

    public function removeAllProspect(){
        $this->reset('prospectArray');
        $this->emit('unblockPage');
    }

}
