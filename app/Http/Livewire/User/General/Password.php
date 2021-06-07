<?php

namespace App\Http\Livewire\User\General;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Password extends Component
{

    public $method;
    public $user;

    //Password
    public $password;
    public $password_confirmation;


    public function mount(User $user, $method){
        $this->user = $user;
        $this->method = $method;
    }

    protected function rules()
    {
        return [
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function render()
    {
        return view('livewire.user.general.password');
    }    

    public function update(){
        $this->validate();
        $this->user->password = Hash::make($this->password);
        $this->user->save();
        
        session()->flash('alert','Contraseña modificada con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('user.general.show', $this->user);
    }

}
