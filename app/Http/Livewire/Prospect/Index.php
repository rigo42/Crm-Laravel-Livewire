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
        $count = Prospect::query();
        $prospects = Prospect::orderBy('id', 'desc');

        if(!$this->user->hasRole('Administrador')){
            $count = $count->where('user_id', Auth::user()->id);
            $prospects = $prospects->where('user_id', Auth::user()->id);
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
            $prospect = User::findOrFail($id);
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
