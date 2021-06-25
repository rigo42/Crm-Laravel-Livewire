<?php

namespace App\Http\Livewire\Payment;

use App\Mail\PaymentNew;
use App\Models\Payment;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class SendEmail extends Component
{

    public $payment;

    public function mount(Payment $payment){
        $this->payment = $payment;
    }
    
    public function render()
    {
        return view('livewire.payment.send-email');
    }

    public function sendEmail($id){
        $payment = Payment::findOrFail($id);
        try{
            Mail::to($this->payment->client->email)->send(new PaymentNew($this->payment));
            $payment->update([
                'send_email' => true,
            ]);
            $this->alert('success', 'Correo enviado con exito');
        }catch(Exception $e){
            $e->getMessage();
            $this->alert('error', 
                'Ocurrio un error al enviar el correo: '.$e->getMessage(), 
                [
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entiendo',
                    'timer' => null,
                ]);
        }
        $this->emit('unblockPage');
    }
}
