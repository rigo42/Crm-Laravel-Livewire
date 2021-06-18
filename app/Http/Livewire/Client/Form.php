<?php

namespace App\Http\Livewire\Client;

use App\Mail\ClientNew;
use App\Models\Client;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class Form extends Component
{

    use WithFileUploads;

    //User actual
    public $userPresent;
    
    public $method;
    public $client;

    //Tools
    public $imageTmp;
    public $userId;

    public function mount(Client $client, $method){
        $this->userPresent = User::find(Auth::user()->id);
        $this->client = $client;
        $this->method = $method;
        $this->userId = $client->user_id;
    }

    protected function rules()
    {
        return [
            'client.name' => 'required',
            'client.email' => 'required|email|unique:clients,email,'.$this->client->id,
            'client.phone' => 'nullable',
            'client.origin' => 'nullable',
            'client.company' => 'nullable',
            'client.address' => 'nullable',
            'client.social_reason' => 'nullable',
            'client.fiscal_address' => 'nullable',
            'client.rfc' => 'nullable',
            'client.premium' => 'nullable',
        ];

    }

    public function render()
    {
        $users = User::orderBy('name')->cursor();
        return view('livewire.client.form', compact('users'));
    }

    public function store(){
        $this->validate();
        $this->saveUser();
        $this->saveUserByAdmin();
        $this->client->save();
        $this->saveImage();
        try{
            session()->flash('alert','Cliente agregado y correo de bienvenida enviado con exito');
            session()->flash('alert-type', 'success');
            Mail::to($this->client->email)->send(new ClientNew($this->client));
        }catch(Exception $e){
            session()->flash('alert', 'Ocurrio un problema al enviar el correo de bienvenida: '.$e->getMessage());
            session()->flash('alert-type', 'warning');
        }
        
        return redirect()->route('client.show', $this->client);
    }

    public function storeCustom(){
        $this->validate();
        $this->saveUser();
        $this->saveUserByAdmin();
        $this->client->save();
        $this->saveImage();
        Mail::to($this->client->email)->send(new ClientNew($this->client));
        $this->client = new Client();
        $this->emit('render');
        $this->alert('success', 'Cliente agregado con exito');
    }

    public function update(){
        $this->validate();
        $this->saveUserByAdmin();
        $this->client->update();
        $this->saveImage();
        session()->flash('alert','Cliente actualizado con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('client.show', $this->client);
    }

    public function saveUserByAdmin(){
        if($this->userPresent->hasRole('Administrador')){
            $this->validate([
                'userId' => 'required',
            ]);
            $this->client->user_id = $this->userId;
        }
    }

    public function saveUser(){
        if(!$this->userPresent->hasRole('Administrador')){
            $this->client->user_id = Auth::user()->id;
        }
    }

    public function saveImage(){
        if($this->imageTmp){

            $url = $this->imageTmp->store('public/client');

            if($this->client->image){
                if(Storage::exists($this->client->image->url)){
                    Storage::delete($this->client->image->url);
                }
                $this->client->image()->update([
                    'url' => $url,
                ]);
            }else{
                $this->client->image()->create([
                    'url' => $url,
                ]);
            }

            $imageOptimized = Image::make(Storage::get($url))
                    ->widen(400)
                    ->encode('webp', 80)
                    ->limitColors(255);
            Storage::put($url, (string) $imageOptimized);

        }
    }

    public function removeImage(){
        if($this->client->image){
            if(Storage::exists($this->client->image->url)){
                Storage::delete($this->client->image->url);
            }
            
            $this->client->image()->delete();
            $this->client->image = null;
        }
        $this->reset('imageTmp');
        $this->alert('success', 'Imagen eliminada con exito');
    }
   
}
