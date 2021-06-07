<?php

namespace App\Http\Livewire\User\General;

use App\Mail\UserNew;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Role;

class Form extends Component
{
    use WithFileUploads;
    
    public $method;
    public $user;

    //foreign
    public $rolesArray = []; 

    //Tools
    public $imageTmp;

    public function mount(User $user, $method){
        $this->user = $user;
        $this->method = $method;

        foreach($this->user->roles as $role){
            array_push($this->rolesArray, "".$role->name."");
        }
    }

    protected function rules()
    {
        return [
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email,'.$this->user->id,
            'user.position' => 'required',
        ];
    }

    public function render()
    {
        $roles = Role::orderBy('name')->cursor();
        return view('livewire.user.general.form', compact('roles'));
    }    

    public function store(){
        $this->validate();
        $this->validate([
            'rolesArray' => 'required',
        ]);
        $password = 12345678;
        $this->user->password = Hash::make($password);
        $this->user->save();
        $this->saveImage();
        $this->saveRoles();
        try{
            Mail::to($this->user->email)->send(new UserNew($this->user, $password));
            session()->flash('alert','Usuario agregado y correo de bienvenida enviado con exito');
            session()->flash('alert-type', 'success');
            
        }catch(Exception $e){
            session()->flash('alert', 'Ocurrio un error al enviar el correo de bienvenida: '.$e->getMessage());
            session()->flash('alert-type', 'success');
        }

        return redirect()->route('user.general.show', $this->user);
        
        
    }

    public function update(){
        $this->validate();
        $this->user->update();
        $this->saveImage();
        $this->saveRoles();
        session()->flash('alert','Actualización con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('user.general.show', $this->user);
    }

    public function saveImage(){
        if($this->imageTmp){

            $url = $this->imageTmp->store('public/user');

            if($this->user->image){
                if(Storage::exists($this->user->image->url)){
                    Storage::delete($this->user->image->url);
                }
                $this->user->image()->update([
                    'url' => $url,
                ]);
            }else{
                $this->user->image()->create([
                    'url' => $url,
                ]);
            }

            $imageOptimized = Image::make(Storage::get($url))
                    ->widen(400)
                    ->encode('webp', 80)
                    ->limitColors(255);
            Storage::put($url, (string) $imageOptimized);

        }
    }

    public function saveRoles(){
        if($this->rolesArray){
            $this->user->syncRoles($this->rolesArray);
        }
    }

    public function removeImage(){
        if($this->user->image){
            if(Storage::exists($this->user->image->url)){
                Storage::delete($this->user->image->url);
            }
            
            $this->user->image()->delete();
            $this->user->image = null;
        }
        $this->reset('imageTmp');
        $this->alert('success', 'Imagen eliminada con exito');
    }
}
