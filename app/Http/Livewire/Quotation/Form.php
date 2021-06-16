<?php

namespace App\Http\Livewire\Quotation;

use App\Models\Client;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Permission;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Form extends Component
{

    use WithFileUploads;
    
    //User actual
    public $user;

    public $method;
    public $quotation;

    //Tools
    public $quotationTmp;
    public $userId;

    protected $listeners = ['render'];

    protected function rules()
    {
        return [
            'quotation.client_id' => 'required|exists:clients,id',
            'quotation.total' => 'required',
            'quotation.concept' => 'required',
        ];
    }

    public function mount(Quotation $quotation, $method){
        $this->user = User::find(Auth::user()->id);
        $this->quotation = $quotation;
        $this->method = $method;
        $this->userId = $quotation->user_id;
        
        if(request()->client){
            $this->quotation->client_id = request()->client;
        }
    }

    public function render()
    {
        $clients = Client::orderBy('id', 'desc');

        if(!$this->user->hasRole('Administrador')){
           $clients = $clients->where('user_id', $this->user->id);
        }

        $clients = $clients->cursor();

        $this->emit('renderJs');
        return view('livewire.quotation.form', compact('clients'));
    }

    public function store(){
        $this->validate();
        $this->validate([
            'quotationTmp' => 'required',
        ]);
        $this->saveQuotation();
        $this->quotation->save();
        session()->flash('alert', 'Cotización agregada');
        session()->flash('alert-type', 'success');
        
        return redirect()->route('quotation.show', $this->quotation);
    }

    public function update(){
        $this->validate();
        $this->saveQuotation();
        $this->quotation->update();
        session()->flash('alert', 'Cotización actualizada con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('quotation.show', $this->quotation);
    }


    public function saveQuotation(){
        if($this->quotationTmp){
            if(Storage::exists($this->quotation->url)){
                Storage::delete($this->quotation->url);
            }

            $path = $this->quotationTmp->store('public/client/quotation');
            $this->quotation->url = $path;
        }
    }

    public function removeQuotation(){
        if($this->quotation->url){
            if(Storage::exists($this->quotation->url)){
                Storage::delete($this->quotation->url);
            }
            
            $this->quotation->url = null;
            $this->quotation->update();
        }
        $this->reset('quotationTmp');
        $this->alert('success', 'Cotización eliminada con exito');
    }
}
