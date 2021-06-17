<?php

namespace App\Http\Livewire\Setting\PaymentType;

use App\Models\CategoryService;
use App\Models\PaymentType;
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
        $count = PaymentType::count();
        $paymentTypes = PaymentType::orderBy('id', 'desc');

        if($this->search){
            $paymentTypes = $paymentTypes->where('name', 'LIKE', "%{$this->search}%");
        }

        $paymentTypes = $paymentTypes->paginate($this->perPage);

        return view('livewire.setting.payment-type.index', compact('count', 'paymentTypes'));
    }

    public function destroy($id)
    {
        try{
            PaymentType::where('id', $id)->delete();
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
