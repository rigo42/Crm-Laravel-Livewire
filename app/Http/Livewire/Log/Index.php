<?php

namespace App\Http\Livewire\Log;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Monolog\Logger;
use Spatie\Activitylog\Models\Activity;

class Index extends Component
{
    use WithPagination;

    //User passed by parameter
    public $user;

    //Tools
    public $perPage = 100;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    //Theme
    protected $paginationTheme = 'bootstrap';

    public function mount($user = null){
        if($user){
            $this->user = User::findOrFail($user->id);
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $count = Activity::query();
        $logs = Activity::orderBy('id', 'desc');

        if($this->user){
            $count = $count->where('causer_id', $this->user->id);
            $logs = $logs->where('causer_id', $this->user->id);

        }

        if($this->search){
            $logs = $logs->where('name', 'LIKE', "%{$this->search}%");
        }

        $count = $count->count();
        $logs = $logs->paginate($this->perPage);
        return view('livewire.log.index', compact('count', 'logs'));
    }

    public function destroy(Activity $activity)
    {
        try{
            $activity->delete();
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
