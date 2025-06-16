<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\transaction;
use App\Jobs\EnviarMailPagoAprobadoJob;
use App\Jobs\EnviarMailPagoPendienteJob;
use App\Jobs\EnviarMailPagoRechazadoJob;
use App\Models\Instancia;
use Illuminate\Support\Facades\Http;

class VerificarPagosMercadoPago extends Command
{
    protected $signature = 'pagos:verificar-mercadopago';

    protected $description = 'Verifica el estado de las transactions en MercadoPago y envía mails según el resultado';

    public function handle()
    {
        $this->info('Iniciando verificación de pagos...');

        // Supongamos que tienes un campo status y payment_id
        $transactions = transaction::all();

        foreach ($transactions as $transaction) {
            try {
                $this->info("Verificando transacción ID: {$transaction->id}");

                $response = Http::withToken(config('services.mercadopago.access_token'))
                    ->withOptions([
                        'verify' => false,  // Desactiva la verificación de SSL
                    ])
                    ->get('https://api.mercadopago.com/v1/payments/search', [
                        'id' => $transaction->payment_id,
                    ]);

                $payment = $response->json();

                if (!$payment) {
                    $this->error("No se encontró el payment en MercadoPago para ID: {$transaction->payment_id}");
                    continue;
                }

                // Actualiza el estado en tu base de datos
                $nuevoEstado = $payment['results'][0]['status'];

                $transaction->status = $nuevoEstado;
                $transaction->save();
                
                $instancia = Instancia::find($transaction->instancia_id);

                // Enviar mails según el estado
                if ($nuevoEstado === 'approved') {
                    EnviarMailPagoAprobadoJob::dispatch($instancia, $payment);
                } elseif (in_array($nuevoEstado, ['rejected', 'cancelled', 'refunded'])) {
                    EnviarMailPagoRechazadoJob::dispatch($instancia, $payment);
                } elseif (in_array($nuevoEstado, ['pending', 'in_process'])) {
                    EnviarMailPagoPendienteJob::dispatch($instancia, $payment);
                } else {
                    $this->info("Estado {$nuevoEstado} sin acción para transacción ID: {$transaction->id}");
                }
            } catch (\Exception $e) {
                $this->error("Error verificando transacción ID: {$transaction->id} - {$e->getMessage()}");
            }
        }

        $this->info('Verificación completada.');
    }
}
