<?php

namespace App\Http\Livewire\Client\General;

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class Form extends Component
{

    use WithFileUploads;
    
    public $method;
    public $client;

    //Tools
    public $imageTmp;

    public function mount(Client $client, $method){
        $this->client = $client;
        $this->method = $method;
    }

    protected function rules()
    {
        return [
            'client.user_id' => 'required|exists:users,id',
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
        return view('livewire.client.general.form', compact('users'));
    }

    public function store(){
        $this->validate();
        $this->client->save();
        $this->saveImage();
        session()->flash('alert','Cliente agregado con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('client.index');
    }

    public function update(){
        $this->validate();
        $this->client->update();
        $this->saveImage();
        session()->flash('alert','Cliente actualizado con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('client.index');
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
