<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'code' => $this->id,
            'currency_symbol' => $this->currency_symbol,
            'email' => $this->email,
            'delivery_number' => $this->delivery_number,
            'billing_number' => $this->billing_number,
            'shipping_type' => $this->shipping_type,
            'payment_type' => $this->payment_type,
            'customer_note' => $this->customer_note,
            'billing-address' => $this->billingAddress,
            'shipping-address' => $this->shippingAddress
        ];
    }
}