<?php

namespace App\Http\Livewire\Expense;

use App\Models\Client;
use App\Models\Expense;
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
    //Client passed by parameter
    public $client;

    //Tools
    public $perPage = 10;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    public function mount($user = null, $client = null){
        $this->userPresent = User::find(Auth::id());
        if($user){
            $this->user = User::findOrFail($user->id);
        }else if($client){
            $this->client = Client::findOrFail($client->id);
        }
        
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = Expense::query();
        $expenses = Expense::orderBy('id', 'desc');

        if($this->user){
            $count = $count->where('user_id', $this->user->id);
            $expenses = $expenses->where('user_id', $this->user->id);

        }elseif($this->client){
            $count = $count->where('client_id', $this->client->id);
            $expenses = $expenses->where('client_id', $this->client->id);

        }elseif(!$this->userPresent->hasRole('Administrador')){
            $count = $count->where('user_id', $this->userPresent->id);
            $expenses = $expenses->where('user_id', $this->userPresent->id);
        }

        if($this->search){
            $expenses = $expenses->where('name', 'LIKE', "%{$this->search}%");
        }

        $count = $count->count();
        $expenses = $expenses->paginate($this->perPage);
        return view('livewire.expense.index', compact('count', 'expenses'));
    }

    public function destroy($id)
    {
        try{
            $payment = Expense::findOrFail($id);
            if($payment->image && Storage::exists($payment->image->url)){
                Storage::delete($payment->image->url);
            }
            $payment->delete();
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
