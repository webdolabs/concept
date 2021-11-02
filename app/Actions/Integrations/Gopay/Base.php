<?php

namespace App\Actions\Integrations\Gopay;

use Illuminate\Support\Facades\Http;

trait Base
{
    public function getToken()
    {
        // GET ACCESS TOKEN
        $response = Http::asForm()->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->gpClientId() . ':' . $this->gpClientSecret())
        ])->post( $this->gpApiUrl() . 'oauth2/token',[
            'scope' => 'payment-create',
            'grant_type' => 'client_credentials'
        ]);

        
        return json_decode($response->body(), true)['access_token'];
    }

    public function gpApiUrl()
    {
        if(config('option.gp_test', true)) {
            return 'https://gw.sandbox.gopay.com/api/';
        }else {
            return 'https://gate.gopay.cz/api/';
        } 
    }

    public function gpGoId()
    {
        return config('option.gp_goid');
    }

    public function gpClientId()
    {
        return config('option.gp_ClientID');
    }

    public function gpClientSecret()
    {
        return config('option.gp_ClientSecret');
    }
}