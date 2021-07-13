<?php

namespace App\Http\Livewire\Expense;

use App\Models\Account;
use App\Models\CategoryExpense;
use App\Models\Client;
use App\Models\Expense;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Form extends Component
{
    use WithFileUploads;

    //User actual
    public $userPresent;
    
    //Object
    public $expense;
    public $client;
    public $serviceAgreement;

    //Tools    
    public $method;
    public $imageTmp;
    public $userId;

    protected $listeners = ['render'];

    protected function rules()
    {
        return [
            'expense.client_id' => 'nullable|exists:clients,id',
            'expense.service_id' => 'nullable|exists:services,id',
            'expense.category_expense_id' => 'required|exists:category_expenses,id',
            'expense.account_id' => 'required|exists:accounts,id',
            'expense.date' => 'required',
            'expense.monto' => 'required|numeric',
            'expense.concept' => 'required',
            'expense.note' => 'nullable',
        ];

    }

    public function mount(Expense $expense, $method){
        $this->userPresent = User::find(Auth::user()->id);
        $this->expense = $expense;
        $this->method = $method;
        $this->userId = $expense->user_id; 
        $this->client = $expense->client ? Client::findOrFail($expense->client_id) : new Client();
        $this->serviceAgreement = $expense->service;

        if(request()->client){
            $this->client = Client::findOrFail(request()->client);
            $this->expense->client_id = request()->client;
        }

        if(request()->date){
            $this->expense->date = request()->date;
        }

        if(request()->service){
            $service = Service::findOrFail(request()->service);
            $this->expense->concept = $service->categoryService->name;
            $this->expense->service_id = $service->id;
            $this->serviceAgreement = $service;
        }
    }

    public function render()
    {
        $users = User::orderBy('name')->cursor();
        $clients = Client::orderBy('id', 'desc')->cursor();
        $accounts = Account::orderBy('id', 'desc')->cursor();
        $categoryExpenses = CategoryExpense::orderBy('id', 'desc')->cursor();
        $this->emit('renderJs');
        return view('livewire.expense.form', compact('users', 'clients', 'accounts', 'categoryExpenses'));
    }

    public function store(){
        $this->validate();
        $this->saveUser();
        $this->saveUserByAdmin();
        $this->expense->save();
        $this->saveImage();
        return redirect()->route('expense.show', $this->expense);
    }

    public function update(){
        $this->validate();
        $this->saveUserByAdmin();
        $this->validateForeignKey();
        $this->expense->update();
        $this->saveImage();
        session()->flash('alert','Gasto actualizado con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('expense.show', $this->expense);
    }

    public function clientChange($id){
        if($id){
            $this->client = Client::findOrFail($id);
        }else{
            $this->client = new Client();
            $this->expense->service_id = NULL;
            $this->expense->client_id = NULL;
        }
    }

    public function serviceChange($id){
        $service = Service::findOrFail($id);
        $this->serviceAgreement = $service;
    }

    public function saveUserByAdmin(){
        if($this->userPresent->hasRole('Administrador')){
            $this->validate([
                'userId' => 'required',
            ]);
            $this->expense->user_id = $this->userId;
        }
    }

    public function saveUser(){
        if(!$this->userPresent->hasRole('Administrador')){
            $this->expense->user_id = Auth::user()->id;
        }
    }

    public function saveImage(){
        if($this->imageTmp){

            $url = $this->imageTmp->store('public/expense');

            if($this->expense->image){
                if(Storage::exists($this->expense->image->url)){
                    Storage::delete($this->expense->image->url);
                }
                $this->expense->image()->update([
                    'url' => $url,
                ]);
            }else{
                $this->expense->image()->create([
                    'url' => $url,
                ]);
            }

            $imageOptimized = Image::make(Storage::get($url))
                    ->widen(800)
                    ->encode('webp', 80)
                    ->limitColors(255);
            Storage::put($url, (string) $imageOptimized);

        }
    }

    public function removeImage(){
        if($this->expense->image){
            if(Storage::exists($this->expense->image->url)){
                Storage::delete($this->expense->image->url);
            }
            
            $this->expense->image()->delete();
            $this->expense->image = null;
        }
        $this->reset('imageTmp');
        $this->alert('success', 'Commprobante eliminado con exito');
    }

    public function validateForeignKey(){
        if($this->expense->client_id == ''){
            $this->expense->client_id = NULL;
        }
    }
}
