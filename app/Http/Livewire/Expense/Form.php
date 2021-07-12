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

    //Tools    
    public $method;
    public $imageTmp;
    public $userId;
    public $serviceArray = [];

    protected $listeners = ['render'];

    protected function rules()
    {
        return [
            'expense.client_id' => 'nullable|exists:clients,id',
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
            array_push($this->serviceArray, "".request()->service."");
        }

        foreach($this->expense->services as $service){
            array_push($this->serviceArray, "".$service->id."");
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
        $this->saveServices();
        return redirect()->route('expense.show', $this->expense);
    }

    public function update(){
        $this->validate();
        $this->saveUserByAdmin();
        $this->validateForeignKey();
        $this->expense->update();
        $this->saveImage();
        $this->saveServices();
        session()->flash('alert','Gasto actualizado con exito');
        session()->flash('alert-type', 'success');
        return redirect()->route('expense.show', $this->expense);
    }

    public function clientChange($id){
        $this->serviceArray = [];
        if($id){
            $this->client = Client::findOrFail($id);
            foreach($this->expense->services as $service){
                array_push($this->serviceArray, "".$service->id."");
            }
        }else{
            $this->client = new Client();
        }
    }

    public function saveServices(){
        $this->expense->services()->sync($this->serviceArray);
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
