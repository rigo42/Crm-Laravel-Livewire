<?php

namespace App\Http\Livewire\Layouts\Rightsidebar;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $user;

    public function mount(){
        $this->user = User::find(Auth::id());
    }

    public function render()
    {
        return view('livewire.layouts.rightsidebar.profile');
    }
}
