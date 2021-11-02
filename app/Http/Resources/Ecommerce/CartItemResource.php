<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'item_id' => $this->item_id,
            'name' => $this->name,
            'sub_name' => $this->sub_name,
            'price' => $this->price,
            'price_VAT' => $this->price_VAT,
            'VAT' => $this->VAT,
            'quantity' => $this->quantity,
            'total' => $this->total
        ];
    }
}