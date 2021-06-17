<?php

namespace App\Http\Livewire\Setting\Account;

use App\Models\Account;
use Exception;
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

    //Listeners
    protected $listeners = ['render'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = Account::count();
        $accounts = Account::orderBy('id', 'desc');

        if($this->search){
            $accounts = $accounts->where('name', 'LIKE', "%{$this->search}%");
        }

        $accounts = $accounts->paginate($this->perPage);

        return view('livewire.setting.account.index', compact('count', 'accounts'));
    }

    public function destroy($id)
    {
        try{
            Account::where('id', $id)->delete();
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
