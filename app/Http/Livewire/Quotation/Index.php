<?php

namespace App\Http\Livewire\Quotation;

use App\Models\Quotation;
use Exception;
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
        $count = Quotation::count();
        $quotations = Quotation::orderBy('id', 'desc');

        if($this->search){
            $quotations = $quotations->where('concept', 'LIKE', "%{$this->search}%")
                                        ->orWhereHas('client', function($query){
                                            $query->where('name', 'LIKE', "%{$this->search}%");
                                        })->orWhereHas('user', function($query){
                                            $query->where('name', 'LIKE', "%{$this->search}%");
                                        });
        }

        $quotations = $quotations->paginate($this->perPage);

        return view('livewire.quotation.index', compact('count', 'quotations'));
    }

    public function destroy($id)
    {
        try{
            $quotation = Quotation::findOrFail($id);
            if(Storage::exists($quotation->url)){
                Storage::delete($quotation->url);
            }
            $quotation->delete();
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
