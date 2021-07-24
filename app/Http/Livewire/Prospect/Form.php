<?php

namespace App\Http\Livewire\Prospect;

use App\Models\Prospect;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class Form extends Component
{

    use WithFileUploads;

    //User actual
    public $userPresent;
    
    public $method;
    public $prospect;

    //Tools
    public $imageTmp;
    public $quotationTmp;
    public $userId;

    public function mount(Prospect $prospect, $method){
        $this->userPresent = User::find(Auth::user()->id);
        $this->prospect = $prospect;
        $this->method = $method;
        $this->userId = $prospect->user_id ? $prospect->user_id : $this->userPresent->id;    
    }

    protected function rules()
    {
        return [
            'prospect.name' => 'required',
            'prospect.email' => 'nullable|email|unique:prospects,email,'.$this->prospect->id,
            'prospect.interest' => 'required',
            'prospect.phone' => 'nullable',
            'prospect.origin' => 'nullable',
            'prospect.company' => 'nullable',
            'prospect.status' => 'nullable',
            'prospect.has_quotation' => 'nullable',
            'prospect.quotation_total' => 'nullable',
            'prospect.quotation_concept' => 'nullable',
            'prospect.quotation_start_date' => 'nullable',
            'prospect.quotation_due_date' => 'nullable',
        ];

    }

    public function render()
    {
        $users = User::orderBy('name')->cursor();
        return view('livewire.prospect.form', compact('users'));
    }

    public function store(){
        $this->validate();
        $this->saveUser();
        $this->saveUserByAdmin();
        $this->hasQuotation();
        $this->prospect->save();
        $this->saveImage();
        session()->flash('alert','Prospecto agregado');
        session()->flash('alert-type', 'success');
        
        return redirect()->route('prospect.show', $this->prospect);
    }

    public function update(){
        $this->validate();
        $this->saveUserByAdmin();
        $this->hasQuotation();
        $this->prospect->update();
        $this->saveImage();
        session()->flash('alert','Prospecto actualizado con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('prospect.show', $this->prospect);
    }

    public function saveUserByAdmin(){
        if($this->userPresent->hasRole('Administrador')){
            $this->validate([
                'userId' => 'required',
            ]);
            $this->prospect->user_id = $this->userId;
        }
    }

    public function saveUser(){
        if(!$this->userPresent->hasRole('Administrador')){
            $this->prospect->user_id = Auth::user()->id;
        }
    }

    public function saveImage(){
        if($this->imageTmp){

            $url = $this->imageTmp->store('public/prospect');

            if($this->prospect->image){
                if(Storage::exists($this->prospect->image->url)){
                    Storage::delete($this->prospect->image->url);
                }
                $this->prospect->image()->update([
                    'url' => $url,
                ]);
            }else{
                $this->prospect->image()->create([
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

    public function hasQuotation(){
        if($this->prospect->has_quotation){

            $this->validate([
                'prospect.quotation_total' => 'required',
                'prospect.quotation_start_date' => 'required',
                'prospect.quotation_due_date' => 'required',
                'prospect.quotation_concept' => 'required'
            ]);

            if($this->prospect->quotation_url){
                $this->validate([
                    'quotationTmp' => 'nullable'
                ]);

            }else{
                $this->validate([
                    'quotationTmp' => 'required'
                ]);
                if(Storage::exists($this->prospect->quotation_url)){
                    Storage::delete($this->prospect->quotation_url);
                }
                if($this->quotationTmp){
                    $path = $this->quotationTmp->store('public/prospect/quotation');
                    $this->prospect->quotation_url = $path;
                }
            }
            
        }
    }

    public function removeImage(){
        if($this->prospect->image){
            if(Storage::exists($this->prospect->image->url)){
                Storage::delete($this->prospect->image->url);
            }
            
            $this->prospect->image()->delete();
            $this->prospect->image = null;
        }
        $this->reset('imageTmp');
        $this->alert('success', 'Imagen eliminada con exito');
    }

    public function removeQuotation(){
        if($this->prospect->quotation_url){
            if(Storage::exists($this->prospect->quotation_url)){
                Storage::delete($this->prospect->quotation_url);
            }
            
            $this->prospect->quotation_url = null;
            $this->prospect->update();
        }
        $this->reset('quotationTmp');
        $this->alert('success', 'Cotización eliminada con exito');
    }
   
}
