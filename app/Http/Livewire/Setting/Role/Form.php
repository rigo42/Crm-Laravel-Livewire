<?php

namespace App\Http\Livewire\Setting\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Form extends Component
{
    public $method;
    public $role;

    //Tools
    public $permissionsArray = [];

    protected $listeners = [
        'createFormRole' => 'create',
        'showRole' => 'show',
        'editFormRole' => 'edit',
    ];

    protected function rules()
    {
        return [
            'role.name' => 'required|unique:roles,name,'.$this->role->id,
            'permissionsArray.name' => 'nullable'
        ];
    }

    public function mount(Role $role, $method = 'store'){
        $this->role = $role;
        $this->method = $method;
        foreach($this->role->permissions as $permission){
            array_push($this->permissionsArray, "".$permission->name."");
        }
    }

    public function render()
    {
        $permissions = Permission::orderBy('name')->cursor();
        return view('livewire.setting.role.form', compact('permissions'));
    }

    public function create(){
        $this->reset('permissionsArray');
        $this->role = new Role();
        $this->method = 'store';
    }

    public function store(){
        $this->validate();
        $this->role->save();
        $this->savePermission();
        $this->emit('renderRoles');
        $this->emit('closeFormRole');
        $this->alert('success', 'Rol agregado con exito');
        $this->role = new Role();
    }

    public function show($id){
        $this->reset('permissionsArray');
        $this->role = Role::find($id);
        foreach($this->role->permissions as $permission){
            array_push($this->permissionsArray, "".$permission->name."");
        }
    }

    public function edit($id){
        $this->reset('permissionsArray');
        $this->method = 'update';
        $this->role = Role::find($id);
        foreach($this->role->permissions as $permission){
            array_push($this->permissionsArray, "".$permission->name."");
        }
    }

    public function update(){
        $this->validate();
        $this->role->update();
        $this->savePermission();
        $this->emit('renderRoles');
        $this->emit('closeFormRole');
        $this->alert('success', 'Rol modificado con exito');
        $this->role = new Role();
    }

    public function savePermission(){
        $this->role->syncPermissions($this->permissionsArray);
    }
}
