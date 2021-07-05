<?php

namespace App\Http\Livewire\Setting\CategoryClient;

use App\Models\CategoryClient;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $categoryClient;

    protected function rules()
    {
        return [
            'categoryClient.name' => 'required|unique:category_clients,name,'.$this->categoryClient->id,
            'categoryClient.description' => 'required',
        ];
    }

    public function mount(CategoryClient $categoryClient, $method){
        $this->categoryClient = $categoryClient;
        $this->method = $method;
    }

    public function render()
    {
        return view('livewire.setting.category-client.form');
    }

    public function store(){
        $this->validate();
        $this->categoryClient->save();
        $this->categoryClient = new CategoryClient();
        $this->alert('success', 'Categoría de cliente agregada con exito');
        $this->emit('render');
        $this->emit('closeModal');
    }

    public function update(){
        $this->validate();
        $this->categoryClient->update();
        $this->emit('render');
        $this->alert('success', 'Categoría modificada con exito');
        $this->emit('closeModal');
    }
}
