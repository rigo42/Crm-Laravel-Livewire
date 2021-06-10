<?php

namespace App\Http\Livewire\Prospect;

use App\Models\Prospect;
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
    public $userPresent;
    //User passed by parameter
    public $user;

    //Tools
    public $perPage = 10;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    public function mount($user = null){
        $this->userPresent = User::find(Auth::id());
        if($user){
            $this->user = User::findOrFail($user->id);
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = Prospect::query();
        $prospects = Prospect::orderBy('id', 'desc');

        if($this->user){
            $count = $count->where('user_id', $this->user->id);
            $prospects = $prospects->where('user_id', $this->user->id);

        }elseif(!$this->userPresent->hasRole('Administrador')){
            $count = $count->where('user_id', $this->userPresent->id);
            $prospects = $prospects->where('user_id', $this->userPresent->id);
        }

        if($this->search){
            $prospects = $prospects->where('name', 'LIKE', "%{$this->search}%");
        }

        $count = $count->count();
        $prospects = $prospects->paginate($this->perPage);
        return view('livewire.prospect.index', compact('count', 'prospects'));
    }

    public function destroy($id)
    {
        try{
            $prospect = Prospect::findOrFail($id);
            if($prospect->image && Storage::exists($prospect->image->url)){
                Storage::delete($prospect->image->url);
            }
            $prospect->delete();
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
