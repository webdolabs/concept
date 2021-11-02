<?php

namespace App\Actions\Integrations\Gopay;

use App\Actions\Integrations\Gopay\Base;
use Illuminate\Support\Facades\Http;

trait PaymentStatus
{
    use Base;

    public function getGoPayPaymentStatus($id)
    {
        $accessToken = $this->getToken();

        $response = Http::asForm()->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken
        ])->get( $this->gpApiUrl() . 'payments/payment/' . $id );

        return json_decode($response->body(), true) ?? 'FAIL';
    }
}