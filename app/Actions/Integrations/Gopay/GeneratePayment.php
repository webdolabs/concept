<?php

namespace App\Actions\Integrations\Gopay;

use App\Actions\Integrations\Gopay\Base;
use Illuminate\Support\Facades\Http;

trait GeneratePayment
{
    use Base;
    
    public function generateGoPayCreditCardPayment($params)
    {
        $accessToken = $this->getToken();

        // CREATE PAYMENT
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken
        ])->post( $this->gpApiUrl() . 'payments/payment' ,[
            'payer' => [
                'default_payment_instrument' => 'PAYMENT_CARD',
                'allowed_payment_instruments' => ['PAYMENT_CARD'],
                'contact' => $params['contact']
            ],
            'target' => [
                'type' => 'ACCOUNT',
                'goid' => $this->gpGoId()
            ],
            'amount' => $params['total'] . '00',
            'currency' => 'CZK',
            'order_number' => $params['payment_code'],
            'callback' => [
                'return_url' => config('option.gp_return_url'),
                'notification_url' => config('option.gp_return_url')
            ],
            'lang' => 'CS',
        ]);

        // Nastavit payment status v DB

        return [
            'id' => json_decode($response->body(), true)['id'],
            'url' => json_decode($response->body(), true)['gw_url']
        ];
    }
}