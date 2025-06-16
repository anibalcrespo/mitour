<?php

namespace App\Http\Controllers;

use App\Mail\PagoExitoso as MailPagoExitoso;
use App\Models\Actividad;
use App\Models\Instancia;
use App\Models\Transaction;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use Illuminate\Support\Str;
use MercadoPago\Exceptions\MPApiException;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function process_payment()
    {
        try {
            DB::beginTransaction();
            MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
            MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

            $client = new PaymentClient();
            $request_options = new RequestOptions();
            $request_options->setCustomHeaders(["X-Idempotency-Key: " . Str::uuid()]);

            $payment = $client->create([
                "token" => request()->input('token'),
                "issuer_id" => request()->input('issuer_id'),
                "payment_method_id" => request()->input('payment_method_id'),
                "transaction_amount" => (float) request()->input('transaction_amount'),
                "currency_id" => "USD",
                "installments" => request()->input('installments'),
                "payer" => [
                    "email" => request()->input('payer')['email'],
                    "identification" => [
                        "type" => request()->input('payer')['identification']['type'],
                        "number" => request()->input('payer')['identification']['number'],
                    ]
                ]
            ], $request_options);

            if ($payment) {
                $instancia_id = request()->input('instancia_id');

                $payment_id = $payment->id;
                $payment_status = $payment->status;
               
                //Guardar transaction
                Transaction::create([
                    'instancia_id' => $instancia_id,
                    'payment_id' => $payment_id,
                    'status' => $payment_status,
                ]);

                DB::commit();
            }
        } catch (MPApiException $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json($payment);
    }

    public static function get_payments($instancia_id)
    {
        $transactions = Transaction::where('instancia_id', $instancia_id)->get();
        $instancia = Instancia::find($instancia_id);
        $payments = [];

        foreach ($transactions as $transaction) {
            $response = Http::withToken(config('services.mercadopago.access_token'))
                ->withOptions([
                    'verify' => false,  // Desactiva la verificación de SSL
                ])
                ->get('https://api.mercadopago.com/v1/payments/search', [
                    'id' => $transaction->payment_id,
                ]);

            $payments[] = $response->json();
        }

        // Número de elementos por página
        $perPage = 50;

        // Paginar el array
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($payments, ($currentPage - 1) * $perPage, $perPage);

        // Crear el objeto de paginación
        $paginatedItems = new LengthAwarePaginator(
            $currentItems,
            count($payments),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('instancias.payments', compact('instancia', 'paginatedItems'));
    }
}
