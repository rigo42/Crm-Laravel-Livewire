<?php

namespace App\Http\Livewire\Prospect;

use App\Mail\ClientNew;
use App\Models\Client;
use App\Models\Prospect;
use Exception;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class BecomeToClient extends Component
{
    public $prospect; 

    public function mount($prospect){
        $this->prospect = $prospect;
    }

    public function render()
    {
        return view('livewire.prospect.become-to-client');
    }

    public function becomeToClient($id){
        try{
            $prospect = Prospect::findOrFail($id);
            
            $client = new Client();
            $client->user_id = $prospect->user_id;
            $client->name = $prospect->name;
            $client->email = $prospect->email;
            $client->phone = $prospect->phone;
            $client->origin = $prospect->origin;
            $client->company = $prospect->company;
            $client->save();

            
            if($prospect->image){
                $url = $this->moveFile($prospect->image->url, 'public/client/');
                $prospect->image()->delete();
                $client->image()->create([
                    'url' => $url,
                ]);
            }

            if($prospect->has_quotation){
                $url = '';
                if (Storage::exists($prospect->quotation_url)) {
                    $url = $this->moveFile($prospect->quotation_url, 'public/client/quotation/');
                }
                
                $client->quotations()->create([
                    'url' => $url,
                    'concept' => $prospect->quotation_concept,
                    'total' => $prospect->quotation_total,
                    'start_date' => $prospect->quotation_start_date,
                    'due_date' => $prospect->quotation_due_date,
                ]);
            }

            $prospect->delete();

            session()->flash('alert', 'Conversión con exito');
            session()->flash('alert-type', 'success');

            if($client->email){
                try{
                    session()->flash('alert', 'Conversión y correo de bienvenida enviado con exito');
                    session()->flash('alert-type', 'success');
                    Mail::to($client->email)->send(new ClientNew($client));
                }catch(Exception $e){
                    session()->flash('alert', 'Ocurrio un problema al enviar el correo de bienvenida: '.$e->getMessage());
                    session()->flash('alert-type', 'warning');
                }
            }

            return redirect()->route('client.show', $client);
        }catch(Exception $e){
            $this->alert('error', 
                'Ocurrio un error al convertirlo en cliente: '.$e->getMessage(), 
                [
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entiendo',
                    'timer' => null,
                ]);
        }

        $this->emit('unblockPage');
    }

    public function moveFile($file, $path){
        $arrayPath = explode('/', $file);
        $arrayLength = count($arrayPath);
        $fileName = time().$arrayPath[$arrayLength - 1];
        $pathFull = $path.$fileName;
        Storage::move($file, $pathFull);
        return $pathFull;
    }
}
