<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use App\Models\Comment as ModelsComment;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comment extends Component
{
    public $client;
    public $body;

    protected function rules()
    {
        return [
            'client.body' => 'required',
        ];

    }

    public function mount(Client $client){
        $this->client = $client;
    }

    public function render(){
        $comments = $this->client->comments()->with('user')->orderBy('id', 'desc')->cursor();
        return view('livewire.client.comment', compact('comments'));
    }

    public function store(){
        $this->client->comments()->create([
            'user_id' => Auth::id(),
            'body' => $this->body,
        ]);
        $this->reset('body');
        $this->alert('success', 'Comentario agregado con exito');
    }


    public function destroy(ModelsComment $comment)
    {
        try{
            $comment->delete();
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
