<?php

namespace App\Jobs;

use App\Mail\PagoPendienteMail;
use App\Models\Instancia;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EnviarMailPagoPendienteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $instancia;
    protected $payment;

    public function __construct(Instancia $instancia, $payment)
    {
        $this->instancia = $instancia;
        $this->payment = $payment;
    }

    public function handle()
    {
        Mail::to($this->payment['results'][0]['payer']['email'])
            ->send(new PagoPendienteMail($this->instancia, $this->payment));
    }
}