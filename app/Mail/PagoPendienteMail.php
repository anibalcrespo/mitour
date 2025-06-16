<?php

namespace App\Mail;

use App\Models\Instancia;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PagoPendienteMail extends Mailable
{
    use Queueable, SerializesModels;
    public $instancia;
    public $payment;

    public function __construct(Instancia $instancia, $payment)
    {
        $this->instancia = $instancia;
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->subject('¡Pago Pendiente de Confirmacion!')
            ->view('emails.pago_pendiente')
            ->with(['transaction' => $this->instancia, 'payment' => $this->payment]);
    }
}
