<?php

namespace App\Http\Livewire\Setting\CategoryExpense;

use App\Models\CategoryExpense;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    //Tools
    public $perPage = 10;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    //Listeners
    protected $listeners = ['render'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = CategoryExpense::count();
        $categoryExpenses = CategoryExpense::orderBy('id', 'desc');

        if($this->search){
            $categoryExpenses = $categoryExpenses->where('name', 'LIKE', "%{$this->search}%");
        }

        $categoryExpenses = $categoryExpenses->paginate($this->perPage);

        return view('livewire.setting.category-expense.index', compact('count', 'categoryExpenses'));
    }

    public function destroy($id)
    {
        try{
            CategoryExpense::where('id', $id)->delete();
            $this->alert('success', 'Eliminación con exito');
        }catch(Exception $e){
            $this->alert('error', 
                'Ocurrio un error en la eliminación: '.$e->getMessage(), 
                [
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entiendo',
                    'timer' => null,
                ]);
        }
    }
}
