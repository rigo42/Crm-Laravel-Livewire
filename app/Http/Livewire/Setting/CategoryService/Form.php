<?php

namespace App\Http\Livewire\Setting\CategoryService;

use App\Models\CategoryService;
use Livewire\Component;

class Form extends Component
{

    public $method;
    public $categoryService;

    protected $listeners = [
        'createFormCategoryService' => 'create',
        'editFormCategoryService' => 'edit',
    ];

    protected function rules()
    {
        return [
            'categoryService.name' => 'required|unique:category_services,name,'.$this->categoryService->id,
        ];
    }

    public function mount(CategoryService $categoryService, $method = 'store'){
        $this->categoryService = $categoryService;
        $this->method = $method;
    }

    public function render()
    {
        return view('livewire.setting.category-service.form');
    }

    public function create(){
        $this->method = 'store';
        $this->categoryService = new CategoryService();
    }

    public function store(){
        $this->validate();
        $this->categoryService->save();
        $this->emit('renderCategoryServices');
        $this->emit('closeFormCategoryService');
        $this->alert('success', 'Categoría agregada con exito');
        $this->categoryService = new CategoryService();
    }

    public function edit($id){
        $this->method = 'update';
        $this->categoryService = CategoryService::find($id);
    }

    public function update(){
        $this->validate();
        $this->categoryService->update();
        $this->emit('renderCategoryServices');
        $this->emit('closeFormCategoryService');
        $this->alert('success', 'Categoría modificada con exito');
        $this->categoryService = new CategoryService();
    }


}
