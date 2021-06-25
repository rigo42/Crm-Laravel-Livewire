<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentNew extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * Create a new message instance.
     *
     * @return void
     */
    public $payment;
    
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('BrandBean - Confirmación de pago')->view('email.payment-new');
    }
}
