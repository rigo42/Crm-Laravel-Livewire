<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GraphStat extends Component
{
    //User actual
    public $userPresent;

    public $payments = [];
    public $expenses = [];
    public $invoices = [];
    public $expensesTotal = 0;
    public $paymentsTotal = 0;
    public $invoicesTotal = 0;
    public $months = array(
        array(
            "number" => "01",
            "name" => "Ene"
        ),
        array(
            "number" => "02",
            "name" => "Feb"
        ),
        array(
            "number" => "03",
            "name" => "Mar"
        ),
        array(
            "number" => "04",
            "name" => "Abr"
        )
        ,array(
            "number" => "05",
            "name" => "May"
        )
        ,array(
            "number" => "06",
            "name" => "Jun"
        )
        ,array(
            "number" => "07",
            "name" => "Jul"
        )
        ,array(
            "number" => "08",
            "name" => "Ago"
        )
        ,array(
            "number" => "09",
            "name" => "Sep"
        )
        ,array(
            "number" => "10",
            "name" => "Oct"
        )
        ,array(
            "number" => "11",
            "name" => "Nov"
        )
        ,array(
            "number" => "12",
            "name" => "Dic"
        ),
    );
    
    public function mount(){
        $this->userPresent = User::find(Auth::id());
    }
    
    public function render()
    {
        $this->thisYear();
        return view('livewire.dashboard.graph-stat');
    }

    public function thisYear(){
        foreach($this->months as $month){
            //Payments
            $payments = Payment::whereMonth('date', $month['number'])
                                ->whereYear('date', date('Y'));
            //Expenses
            $expenses = Expense::whereMonth('date', $month['number'])
                                ->whereYear('date', date('Y'));

            //Expenses
            $invoices = Invoice::whereMonth('start_date', $month['number'])
                                ->whereYear('start_date', date('Y'));

            if(!$this->userPresent->hasRole('Administrador')){
                $payments = $payments->whereHas('client', function($query){
                    $query->where('user_id', $this->userPresent->id);
                });
                $expenses = $expenses->whereHas('client', function($query){
                    $query->where('user_id', $this->userPresent->id);
                });
                $invoices = $invoices->whereHas('client', function($query){
                    $query->where('user_id', $this->userPresent->id);
                });
            }

            $payments = $payments->cursor();
            $expenses = $expenses->cursor();
            $invoices = $invoices->cursor();

            $totalPaymentThisMonth = 0;
            foreach($payments as $payment){
                $totalPaymentThisMonth += $payment->monto;
                $this->paymentsTotal += $payment->monto;
            }
            array_push($this->payments, $totalPaymentThisMonth);

            
            $totalThisExpenseMonth = 0;
            foreach($expenses as $expense){
                $totalThisExpenseMonth += $expense->monto;
                $this->expensesTotal += $expense->monto;
            }
            array_push($this->expenses, $totalThisExpenseMonth);


            $totalThisInvoiceMonth = 0;
            foreach($invoices as $invoice){
                $totalThisInvoiceMonth += $invoice->total;
                $this->invoicesTotal += $invoice->total;
            }
            array_push($this->invoices, $totalThisInvoiceMonth);
            
        }
        
    }
}
