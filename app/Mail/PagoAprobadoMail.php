<?php

namespace App\Mail;

use App\Models\Instancia;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PagoAprobadoMail extends Mailable
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
        return $this->subject('¡Pago Aprobado!')
            ->view('emails.pago_aprobado')
            ->with(['transaction' => $this->instancia, 'payment' => $this->payment]);
    }
}
