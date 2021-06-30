<?php

namespace App\Http\Livewire\Setting\Backup;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{

    //Tools
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $count = collect( Storage::files('/BrandBean'))->count();
        $backups = collect(Storage::files('/BrandBean'))->sortDesc();

        if($this->search){
            $backups = $backups->filter(function ($value, $key) {
                return preg_match("/$this->search/", $value);
            });
        }

        return view('livewire.setting.backup.index', compact('count', 'backups'));
    }

    public function generate(){
        Artisan::call("backup:run --only-db");
        $this->alert('success', 
                'Copia de seguridad creada con exito, se recomienda que descargue la ultima copia de seguridad y sea subida a Google Drive ', 
                [
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entiendo',
                    'timer' => null,
                ]);
    }

    public function download($name){
        return Storage::download($name);
    }

    public function destroy($name)
    {
        try{
            Storage::delete($name);
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
