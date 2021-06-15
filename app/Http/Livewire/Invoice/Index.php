<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Invoice;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = Invoice::query();
        $invoices = Invoice::orderBy('id', 'desc');

        if($this->search){
            $invoices = $invoices->where('concept', 'LIKE', "%{$this->search}%")
                                    ->orWhereHas('client', function($query){
                                        $query->where('name', 'LIKE', "%{$this->search}%");
                                    });
        }

        $count = $count->count();
        $invoices = $invoices->paginate($this->perPage);
        return view('livewire.invoice.index', compact('count', 'invoices'));
    }

    public function destroy($id)
    {
        try{
            $invoice = Invoice::findOrFail($id);
            if(Storage::exists($invoice->url)){
                Storage::delete($invoice->url);
            }
            $invoice->delete();
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
