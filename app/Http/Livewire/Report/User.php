<?php

namespace App\Http\Livewire\Report;

use App\Models\User as ModelsUser;
use Carbon\Carbon;
use Livewire\Component;

class User extends Component
{

    public $dates;
    public $startDate;
    public $endDate;
    public $userId;
    public $user;

    //Info report
    public $prospects = [];
    public $clients = [];
    public $projects = [];
    public $services = [];
    public $quotations = [];
    public $invoices = [];
    public $payments = [];
    public $expenses = [];


    protected function rules()
    {
        return [
            'dates' => 'required',
            'userId' => 'required',
        ];
    }

    public function render()
    {
        $users = ModelsUser::orderBy('id', 'desc')->cursor();
        return view('livewire.report.user', compact('users'));
    }

    public function generate(){
        $this->validate();
        
        $this->startDate = Carbon::parse(explode('-', $this->dates)[0])->format('Y-m-d');
        $this->endDate = Carbon::parse(explode('-', $this->dates)[1])->format('Y-m-d');

        $this->user = ModelsUser::findOrFail($this->userId);

        $this->prospects = $this->prospects();
        $this->clients = $this->clients();
        $this->projects = $this->projects();
        $this->services = $this->services();
        $this->quotations = $this->quotations();
        $this->invoices = $this->invoices();
        $this->payments = $this->payments();
        $this->expenses = $this->expenses();

        $this->emit('reportView');
    }

    public function prospects(){
        return $this->user->prospects()->whereBetween('created_at', [$this->startDate, $this->endDate])->get();
    }

    public function clients(){
        return $this->user->clients()->whereBetween('created_at', [$this->startDate, $this->endDate])->get();
    }

    public function projects(){
        return $this->user->services()->where('type', 'Proyecto')->whereBetween('services.created_at', [$this->startDate, $this->endDate])->get();
    }

    public function services(){
        return $this->user->services()->where('type', 'Mensual')->whereBetween('services.created_at', [$this->startDate, $this->endDate])->get();
    }

    public function quotations(){
        return $this->user->quotations()->whereBetween('quotations.start_date', [$this->startDate, $this->endDate])->get();
    }

    public function invoices(){
        return $this->user->invoices()->whereBetween('invoices.start_date', [$this->startDate, $this->endDate])->get();
    }

    public function payments(){
        return $this->user->payments()->whereBetween('date', [$this->startDate, $this->endDate])->get();
    }

    public function expenses(){
        return $this->user->expenses()->whereBetween('date', [$this->startDate, $this->endDate])->get();
    }

}
