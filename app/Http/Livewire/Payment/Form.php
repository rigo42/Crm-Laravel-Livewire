<?php

namespace App\Http\Livewire\Payment;

use App\Models\Account;
use App\Models\Client;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Form extends Component
{
    use WithFileUploads;

    //User actual
    public $userPresent;
    
    //Object
    public $payment;
    public $client;

    //Tools    
    public $method;
    public $imageTmp;
    public $userId;
    public $serviceArray = [];

    protected $listeners = ['render'];

    protected function rules()
    {
        return [
            'payment.client_id' => 'required|exists:clients,id',
            'payment.payment_type_id' => 'required|exists:payment_types,id',
            'payment.account_id' => 'required|exists:accounts,id',
            'payment.invoice_id' => 'nullable|exists:invoices,id',
            'payment.date' => 'required',
            'payment.monto' => 'required|numeric',
            'payment.concept' => 'required',
            'payment.note' => 'nullable',
        ];

    }

    public function mount(Payment $payment, $method){
        $this->userPresent = User::find(Auth::user()->id);
        $this->payment = $payment;
        $this->method = $method;
        $this->userId = $payment->user_id;    
        $this->client = $payment->client ? Client::findOrFail($payment->client_id) : new Client();
        
        if(request()->client){
            $this->client = Client::findOrFail(request()->client);
            $this->payment->client_id = request()->client;
        }
        
        foreach($this->payment->services as $service){
            array_push($this->serviceArray, "".$service->id."");
        }
    }

    public function render()
    {
        $users = User::orderBy('name')->cursor();
        $clients = Client::orderBy('id', 'desc')->cursor();
        $paymentTypes = PaymentType::orderBy('id', 'desc')->cursor();
        $accounts = Account::orderBy('id', 'desc')->cursor();
        $this->emit('renderJs');
        return view('livewire.payment.form', compact('users', 'clients', 'paymentTypes', 'accounts'));
    }

    public function store(){
        $this->validate();
        $this->saveUser();
        $this->saveUserByAdmin();
        $this->payment->save();
        $this->saveImage();
        $this->saveServices();
        return redirect()->route('payment.show', $this->payment);
    }

    public function update(){
        $this->validate();
        $this->saveUserByAdmin();
        $this->validateForeignKey();
        $this->payment->update();
        $this->saveImage();
        $this->saveServices();
        session()->flash('alert','paymente actualizado con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('payment.show', $this->payment);
    }

    public function clientChange($id){
        $this->serviceArray = [];
        if($id){
            $this->client = Client::findOrFail($id);
            foreach($this->payment->services as $service){
                array_push($this->serviceArray, "".$service->id."");
            }
        }else{
            $this->client = new Client();
        }
    }

    public function saveServices(){
        $this->payment->services()->sync($this->serviceArray);
    }

    public function saveUserByAdmin(){
        if($this->userPresent->hasRole('Administrador')){
            $this->validate([
                'userId' => 'required',
            ]);
            $this->payment->user_id = $this->userId;
        }
    }

    public function saveUser(){
        if(!$this->userPresent->hasRole('Administrador')){
            $this->payment->user_id = Auth::user()->id;
        }
    }

    public function saveImage(){
        if($this->imageTmp){

            $url = $this->imageTmp->store('public/payment');

            if($this->payment->image){
                if(Storage::exists($this->payment->image->url)){
                    Storage::delete($this->payment->image->url);
                }
                $this->payment->image()->update([
                    'url' => $url,
                ]);
            }else{
                $this->payment->image()->create([
                    'url' => $url,
                ]);
            }

            $imageOptimized = Image::make(Storage::get($url))
                    ->widen(800)
                    ->encode('webp', 80)
                    ->limitColors(255);
            Storage::put($url, (string) $imageOptimized);

        }
    }

    public function removeImage(){
        if($this->payment->image){
            if(Storage::exists($this->payment->image->url)){
                Storage::delete($this->payment->image->url);
            }
            
            $this->payment->image()->delete();
            $this->payment->image = null;
        }
        $this->reset('imageTmp');
        $this->alert('success', 'Commprobante eliminada con exito');
    }

    public function validateForeignKey(){
        if($this->payment->invoice_id == ''){
            $this->payment->invoice_id = NULL;
        }
    }
}
