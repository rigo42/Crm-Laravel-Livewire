<?php

namespace App\Http\Livewire\Setting\CategoryService;

use App\Models\CategoryService;
use Livewire\Component;

class Form extends Component
{

    public $method;
    public $categoryService;

    protected function rules()
    {
        return [
            'categoryService.name' => 'required|unique:category_services,name,'.$this->categoryService->id,
        ];
    }

    public function mount(CategoryService $categoryService, $method){
        $this->categoryService = $categoryService;
        $this->method = $method;
    }

    public function render()
    {
        return view('livewire.setting.category-service.form');
    }

    public function store(){
        $this->validate();
        $this->categoryService->save();
        $this->categoryService = new CategoryService();
        $this->alert('success', 'Categoría de servicio agregada con exito');
        $this->emit('render');
        $this->emit('closeModal');
    }

    public function storeCustom(){
        $this->validate();
        $this->categoryService->save();
        $this->categoryService = new CategoryService();
        $this->emit('render');
        $this->alert('success', 'Categoría de servicio agregada con exito');
        
    }

    public function update(){
        $this->validate();
        $this->categoryService->update();
        $this->emit('render');
        $this->alert('success', 'Categoría modificada con exito');
        $this->emit('closeModal');
    }


}
