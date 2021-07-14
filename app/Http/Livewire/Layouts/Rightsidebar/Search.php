<?php

namespace App\Http\Livewire\Layouts\Rightsidebar;

use App\Models\Client;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Prospect;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $userPresent;

    public function mount(){
        $this->userPresent = User::find(Auth::id());
    }
    
    public function render()
    {
        //Clients
        $clients = [];
        $clientCount = 0;

        //Prospects
        $prospects = [];
        $prospectCount = 0;

        //Servicios
        $services = [];
        $serviceCount = 0;

        //Servicios
        $invoices = [];
        $invoiceCount = 0;

        //Payments
        $payments = [];
        $paymentCount = 0;

        //Expenses
        $expenses = [];
        $expenseCount = 0;


        if($this->search){
            //CLients
            $clientCount = Client::query();
            $clients = Client::query()
                                ->orderBy('id', 'desc')
                                ->where('name', 'LIKE', "%{$this->search}%")
                                ->take(5);

            //Prospects
            $prospectCount = Prospect::query();
            $prospects = Prospect::query()
                                ->orderBy('id', 'desc')
                                ->where('name', 'LIKE', "%{$this->search}%")
                                ->take(5);

            //Services
            $serviceCount = Service::query();
            $services = Service::query()
                                ->orderBy('id', 'desc')
                                ->orWhereHas('client', function($query){
                                    $query->where('name', 'LIKE', "%{$this->search}%");
                                })
                                ->orWhereHas('serviceType', function($query){
                                    $query->where('name', 'LIKE', "%{$this->search}%");
                                })
                                ->take(5);

            //Invoices
            $invoiceCount = Invoice::query();
            $invoices = Invoice::query()
                                ->orderBy('id', 'desc')
                                ->where('concept', 'LIKE', "%{$this->search}%")
                                ->orWhereHas('client', function($query){
                                    $query->where('name', 'LIKE', "%{$this->search}%");
                                })
                                ->take(5);

            //Payments
            $paymentCount = Payment::query();
            $payments = Payment::query()
                                ->orderBy('id', 'desc')
                                ->where('concept', 'LIKE', "%{$this->search}%")
                                ->orWhereHas('client', function($query){
                                    $query->where('name', 'LIKE', "%{$this->search}%");
                                })
                                ->take(5);


            //Payments
            $expenseCount = Expense::query();
            $expenses = Expense::query()
                                ->orderBy('id', 'desc')
                                ->where('concept', 'LIKE', "%{$this->search}%")
                                ->orWhereHas('client', function($query){
                                    $query->where('name', 'LIKE', "%{$this->search}%");
                                })
                                ->take(5);
            
            if(!$this->userPresent->hasRole('Administrador')){
                //Clients
                $clients->where('user_id', $this->userPresent->id);
                $clientCount->where('user_id', $this->userPresent->id);

                //Prospects
                $prospects->where('user_id', $this->userPresent->id);
                $prospectCount->where('user_id', $this->userPresent->id);

                //Services
                $services->whereHas('client', function($query){
                    $query->where('user_id', $this->userPresent->id);
                });
                $serviceCount->whereHas('client', function($query){
                    $query->where('user_id', $this->userPresent->id);
                });

                //Invoices
                $invoices->whereHas('client', function($query){
                    $query->where('user_id', $this->userPresent->id);
                });
                $invoiceCount->whereHas('client', function($query){
                    $query->where('user_id', $this->userPresent->id);
                });

                //Payments
                $payments->whereHas('client', function($query){
                    $query->where('user_id', $this->userPresent->id);
                });
                $paymentCount->whereHas('client', function($query){
                    $query->where('user_id', $this->userPresent->id);
                });

                //Expenses
                $expenses->whereHas('client', function($query){
                    $query->where('user_id', $this->userPresent->id);
                });
                $expenseCount->whereHas('client', function($query){
                    $query->where('user_id', $this->userPresent->id);
                });
            }

            $clients = $clients->cursor();
            $prospects = $prospects->cursor();
            $services = $services->cursor();
            $invoices = $invoices->cursor();
            $payments = $payments->cursor();
            $expenses = $expenses->cursor();

            $clientCount = $clientCount->count();
            $prospectCount = $prospectCount->count();
            $serviceCount = $serviceCount->count();
            $invoiceCount = $invoiceCount->count();
            $paymentCount = $paymentCount->count();
            $expenseCount = $expenseCount->count();
            
        }else{
            $clients = [];
            $prospects = [];
            $services = [];
            $invoices = [];
            $payments = [];
            $expenses = [];
        }

        return view('livewire.layouts.rightsidebar.search', 
            compact(
                'clients', 
                'clientCount', 
                'prospects', 
                'prospectCount', 
                'services', 
                'serviceCount',
                'invoices', 
                'invoiceCount',
                'payments', 
                'paymentCount',
                'expenses', 
                'expenseCount',
            )
        );
    }
}
