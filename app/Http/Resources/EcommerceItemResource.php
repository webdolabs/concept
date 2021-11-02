<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EcommerceItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_merge(
            [
                'id' => $this->id,
                'name' => $this->sub_name
            ], [
                'price' => $this->currency->price . ' ' . config('request.locale')['currency_symbol'],
                'price_VAT' => $this->currency->price_VAT . ' ' . config('request.locale')['currency_symbol'],
                'VAT' => $this->currency->VAT . '%',
                'quantity' => $this->quantity - $this->sold_count,
                'availability' => $this->quantity - $this->sold_count > 0 ? "Skladem" : "Vyprodáno",
            ]
        );
    }
}
