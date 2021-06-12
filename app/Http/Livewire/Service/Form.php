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
            'service.type' => 'required',
            'service.category_service_id' => 'required',
            'service.client_id' => 'required',
            'service.name' => 'required',
            'service.start_date' => 'required',
            'service.due_date' => 'nullable',
            'service.due_day' => 'nullable',
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
        $this->save();
        $this->service->save();
        session()->flash('alert','Servicio agregado con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('service.index');
    }

    public function update(){
        $this->validate();
        $this->save();
        $this->service->update();
        session()->flash('alert','Servicio actualizado con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('service.index');
    }

    public function save(){
        if($this->service->type == 'Proyecto'){
            $this->validate([
                'service.due_date' => 'required',
            ]);
        }elseif($this->service->type == 'Mensual'){
            $this->validate([
                'service.due_day' => 'required',
            ]);
        }
    }

}
