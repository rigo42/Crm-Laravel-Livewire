<?php

namespace App\Http\Livewire\Setting\CategoryExpense;

use App\Models\CategoryExpense;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $categoryExpense;

    protected function rules()
    {
        return [
            'categoryExpense.name' => 'required|unique:category_expenses,name,'.$this->categoryExpense->id,
        ];
    }

    public function mount(CategoryExpense $categoryExpense, $method){
        $this->categoryExpense = $categoryExpense;
        $this->method = $method;
    }

    public function render()
    {
        return view('livewire.setting.category-expense.form');
    }

    public function store(){
        $this->validate();
        $this->categoryExpense->save();
        $this->categoryExpense = new CategoryExpense();
        $this->alert('success', 'Categoría de gasto agregada con exito');
        $this->emit('render');
        $this->emit('closeModal');
    }

    public function storeCustom(){
        $this->validate();
        $this->categoryExpense->save();
        $this->categoryExpense = new CategoryExpense();
        $this->emit('render');
        $this->alert('success', 'Categoría de gasto agregada con exito');
        
    }

    public function update(){
        $this->validate();
        $this->categoryExpense->update();
        $this->emit('render');
        $this->alert('success', 'Categoría modificada con exito');
        $this->emit('closeModal');
    }
}
