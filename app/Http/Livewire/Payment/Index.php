<?php

namespace App\Http\Livewire\Payment;

use App\Models\Account;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Service;
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
    //Service passed by parameter
    public $service;
    //Service passed by parameter
    public $account;

    //Tools
    public $perPage = 10;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['renderPayments' => 'render'];

    public function mount($user = null, $client = null, $service = null, $account = null){
        $this->userPresent = User::find(Auth::id());
        if($user){
            $this->user = User::findOrFail($user->id);
        }else if($client){
            $this->client = Client::findOrFail($client->id);
        }
        else if($service){
            $this->service = Service::findOrFail($service->id);
        }
        else if($account){
            $this->account = Account::findOrFail($account->id);
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

        }elseif($this->service){
            $count = $count->whereHas('service', function($query){
                $query->where('service_id', $this->service->id);
            });
            $payments = $payments->whereHas('service', function($query){
                $query->where('service_id', $this->service->id);
            });

        }elseif($this->account){
            $count = $count->where('account_id', $this->account->id);
            $payments = $payments->where('account_id', $this->account->id);

        }elseif(!$this->userPresent->hasRole('Administrador')){
            $count = $count->where('user_id', $this->userPresent->id);
            $payments = $payments->where('user_id', $this->userPresent->id);
        }

        if($this->search){
            $payments = $payments->where('concept', 'LIKE', "%{$this->search}%")
                                ->orWhere('note', 'LIKE', "%{$this->search}%")
                                ->orWhereHas('user', function($query){
                                    $query->where('name', 'LIKE', "%{$this->search}%");
                                })
                                ->orWhereHas('client', function($query){
                                    $query->where('name', 'LIKE', "%{$this->search}%");
                                })
                                ->orWhereHas('client', function($query){
                                    $query->where('company', 'LIKE', "%{$this->search}%");
                                })
                                ->orWhereHas('paymentType', function($query){
                                    $query->where('name', 'LIKE', "%{$this->search}%");
                                });
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
