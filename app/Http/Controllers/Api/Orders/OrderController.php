<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;


class OrderController extends Controller
{
    public function generateToken(Request $request)
    {
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return response()->json(['clientToken' => $clientToken]);
    }

    public function makePayment(Request $request)
    {
        $nonce = $request->input('nonce');
        $braintreeToken = env('BRAINTREE_PUBLIC_KEY'); // Utilizzare la chiave pubblica per sicurezza

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => $braintreeToken, // Utilizzare la chiave pubblica qui
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $request->input('amount'), // Importo del pagamento
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForVerification' => true // Invia per verifica (potrebbe richiedere ulteriori azioni)
            ],
        ]);

        // Gestisci la risposta di Braintree
        if ($result->success) {
            $transaction = $result->transaction;
            // Elaborare l'ordine e registrare il pagamento riuscito
            return response()->json(['success' => true, 'transaction' => $transaction]);
        } else {
            $message = "";
            foreach ($result->errors->all() as $error) {
                $message .= $error->message . "\n";
            }
            return response()->json(['success' => false, 'message' => $message]);
        }
    }
}
