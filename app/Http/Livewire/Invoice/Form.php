<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $method;
    public $invoice;
    public $client;

    //Tools
    public $invoiceTmp;
    public $serviceArray = [];

    protected function rules()
    {
        return [
            'invoice.client_id' => 'required|exists:clients,id',
            'invoice.total' => 'required',
            'invoice.start_date' => 'required',
            'invoice.due_date' => 'required',
            'invoice.concept' => 'required',
        ];
    }

    public function mount(Invoice $invoice, $method){
        $this->invoice = $invoice;
        $this->method = $method;
        $this->client = $invoice->client ? Client::findOrFail($invoice->client_id) : new Client();

        foreach($this->invoice->services as $service){
            array_push($this->serviceArray, "".$service->id."");
        }

        if(request()->client){
            $this->invoice->client_id = request()->client;
            $this->clientChange(request()->client);
        }
    }

    public function render()
    {
        $clients = Client::orderBy('id', 'desc')->cursor();
        return view('livewire.invoice.form', compact('clients'));
    }

    public function store(){
        $this->validate();
        $this->validate([
            'invoiceTmp' => 'required',
        ]);
        $this->saveInvoice();
        $this->invoice->save();
        $this->saveServices();
        session()->flash('alert', 'Factura agregada');
        session()->flash('alert-type', 'success');
        
        return redirect()->route('invoice.show', $this->invoice);
    }

    public function update(){
        $this->validate();
        $this->saveInvoice();
        $this->invoice->update();
        $this->saveServices();
        session()->flash('alert', 'Factura actualizada con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('invoice.show', $this->invoice);
    }

    public function saveServices(){
        $this->invoice->services()->sync($this->serviceArray);
    }

    public function clientChange($id){
        $this->serviceArray = [];
        if($id){
            $this->client = Client::findOrFail($id);
            foreach($this->invoice->services as $service){
                array_push($this->serviceArray, "".$service->id."");
            }
        }else{
            $this->client = new Client();
        }
    }

    public function saveInvoice(){
        if($this->invoiceTmp){
            if(Storage::exists($this->invoice->url)){
                Storage::delete($this->invoice->url);
            }

            $path = $this->invoiceTmp->store('public/client/invoice');
            $this->invoice->url = $path;
        }
    }

}
