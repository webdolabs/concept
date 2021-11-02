<?php

namespace App\Actions\Api;

use App\Models\Ecommerce\Item;

use App\Http\Resources\EcommerceItemResource;

trait GetEcommerceItem
{
    public function getEcommerce($postId)
    {
        $variants = Item::where('post_id', $postId)->with('currency')->get();

        // If no variant
        if(!$variants) {
            return [
                'variant' => null,
                'variants' => null
            ];
        }
        // If any variant do not have currency
        foreach($variants as $variant) {
            if(!$variant->currency) {
                return [
                    'variant' => null,
                    'variants' => null
                ];
            }
        }

        $variants = EcommerceItemResource::collection($variants);
        if(count($variants) == 1 && $variants[0]['sub_name'] == null) {
            return [
                'variant' => $variants[0]
            ];
        }else {
            return [
                'min_price_VAT' => collect($variants)->min('price_VAT'),
                'same_price' => collect($variants)->min('price_VAT') == collect($variants)->max('price_VAT') ? true : false,
                'variants' => $variants
            ];
        }
    }  
}