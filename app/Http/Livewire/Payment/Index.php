<?php

namespace App\Http\Livewire\Payment;

use App\Models\Client;
use App\Models\Payment;
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
        $count = Payment::query();
        $payments = Payment::orderBy('id', 'desc');

        if($this->user){
            $count = $count->where('user_id', $this->user->id);
            $payments = $payments->where('user_id', $this->user->id);

        }elseif($this->client){
            $count = $count->where('client_id', $this->client->id);
            $payments = $payments->where('client_id', $this->client->id);

        }elseif(!$this->userPresent->hasRole('Administrador')){
            $count = $count->where('user_id', $this->userPresent->id);
            $payments = $payments->where('user_id', $this->userPresent->id);
        }

        if($this->search){
            $payments = $payments->where('name', 'LIKE', "%{$this->search}%");
        }

        $count = $count->count();
        $payments = $payments->paginate($this->perPage);
        return view('livewire.payment.index', compact('count', 'payments'));
    }

    public function destroy($id)
    {
        try{
            $payment = Payment::findOrFail($id);
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
