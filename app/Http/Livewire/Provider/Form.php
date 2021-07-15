<?php

namespace App\Http\Livewire\Provider;

use App\Models\Provider;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Form extends Component
{

    use WithFileUploads;
    
    public $method;
    public $provider;
    public $imageTmp;

    protected function rules()
    {
        return [
            'provider.name' => 'required|unique:service_types,name,'.$this->provider->id,
            'provider.description' => 'required|max:191',
        ];
    }

    public function mount(Provider $provider, $method){
        $this->provider = $provider;
        $this->method = $method;
    }

    public function render()
    {
        return view('livewire.provider.form');
    }

    public function store(){
        $this->validate();
        $this->provider->save();
        $this->saveImage();
        $this->provider = new Provider();
        $this->alert('success', 'Proveedor agregado con exito');
        $this->emit('render');
        $this->emit('closeModal');
    }

    public function storeCustom(){
        $this->validate();
        $this->provider->save();
        $this->saveImage();
        $this->provider = new Provider();
        $this->reset('imageTmp');
        $this->emit('render');
        $this->alert('success', 'Proveedor agregado con exito');
    }

    public function update(){
        $this->validate();
        $this->provider->update();
        $this->saveImage();
        $this->emit('render');
        $this->alert('success', 'Proveedor modificado con exito');
        $this->emit('closeModal');
    }

    public function saveImage(){
        if($this->imageTmp){

            $url = $this->imageTmp->store('public/provider');

            if($this->provider->image){
                if(Storage::exists($this->provider->image->url)){
                    Storage::delete($this->provider->image->url);
                }
                $this->provider->image()->update([
                    'url' => $url,
                ]);
            }else{
                $this->provider->image()->create([
                    'url' => $url,
                ]);
            }

            $imageOptimized = Image::make(Storage::get($url))
                    ->widen(200)
                    ->encode('webp', 80)
                    ->limitColors(255);
            Storage::put($url, (string) $imageOptimized);

        }
    }

    public function removeImage(){
        if($this->provider->image){
            if(Storage::exists($this->provider->image->url)){
                Storage::delete($this->provider->image->url);
            }
            
            $this->provider->image()->delete();
            $this->provider->image = null;
        }
        $this->reset('imageTmp');
        $this->alert('success', 'Imagen eliminada con exito');
    }
}
