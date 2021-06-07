<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission as PermissionSpatie;

class Permission extends Component
{
    public $method;
    public $user;

    //foreign
    public $permissionsArray = [];

    public function mount(User $user, $method){
        $this->user = $user;
        $this->method = $method;

        foreach($this->user->permissions as $permission){
            array_push($this->permissionsArray, "".$permission->name."");
        }
    }

    public function render()
    {
        $permissions = PermissionSpatie::orderBy('id', 'desc')->cursor();
        return view('livewire.user.permission', compact('permissions'));
    }

    public function update()
    {
        $this->user->syncPermissions($this->permissionsArray);
        session()->flash('alert','Permisos actualizados con éxito.');
        session()->flash('alert-type','success');
        return redirect()->route('user.show', $this->user);
    }
}
