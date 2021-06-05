<?php

namespace App\Http\Livewire\Setting\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Form extends Component
{

    public $method;
    public $permission;

    protected $listeners = [
        'createFormPermission' => 'create',
        'editFormPermission' => 'edit',
    ];

    protected function rules()
    {
        return [
            'permission.name' => 'required|unique:permissions,name,'.$this->permission->id,
        ];
    }

    public function mount(Permission $permission, $method = 'store'){
        $this->permission = $permission;
        $this->method = $method;
    }

    public function render()
    {
        return view('livewire.setting.permission.form');
    }

    public function create(){
        $this->permission = new Permission();
        $this->method = 'store';
    }

    public function store(){
        $this->validate();
        $this->permission->save();
        $this->emit('renderPermissions');
        $this->emit('closeFormPermission');
        $this->alert('success', 'Permiso agregado con exito');
        $this->permission = new Permission();
    }

    public function edit($id){
        $this->method = 'update';
        $this->permission = Permission::find($id);
    }

    public function update(){
        $this->validate();
        $this->permission->update();
        $this->emit('renderPermissions');
        $this->emit('closeFormPermission');
        $this->alert('success', 'Permiso modificado con exito');
        $this->permission = new Permission();
    }


}
