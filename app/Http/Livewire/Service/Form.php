<?php

namespace App\Http\Livewire\Service;

use App\Models\CategoryService;
use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Queue\Listener;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{

    //User actual
    public $user;
    
    public $method;
    public $service;

    protected $listeners = ['render'];

    public function mount(Service $service, $method){
        $this->service = $service;
        $this->method = $method;
    }

    protected function rules()
    {
        return [
            'service.name' => 'required',
            'service.category_service_id' => 'required',
            'service.client_id' => 'required',
            'service.name' => 'required',
            'service.start_date' => 'required',
            'service.due_day' => 'required',
            'service.price' => 'required',
            'service.note' => 'nullable',
        ];
    }

    public function render()
    {
        $users = User::orderBy('name')->cursor();
        $categoryServices = CategoryService::orderBy('id', 'desc')->cursor();
        $clients = Client::orderBy('id', 'desc')->cursor();
        $this->emit('renderJs');
        return view('livewire.service.form', compact('users', 'categoryServices', 'clients'));
    }

    public function store(){
        $this->validate();
        $this->service->start_date = Carbon::createFromFormat( 'd/m/Y', $this->service->start_date);
        $this->service->save();
        session()->flash('alert','Servicio agregado con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('service.index');
    }

    public function update(){
        $this->validate();
        $this->service->start_date = Carbon::parse($this->service->start_date)->format('Y-m-d');
        $this->service->update();
        session()->flash('alert','Servicio actualizado con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('service.index');
    }

}
