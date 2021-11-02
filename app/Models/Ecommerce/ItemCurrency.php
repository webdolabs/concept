<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class ItemCurrency extends Model
{
    protected $table = 'e_item_currencies';

    protected $fillable = ['locale_name', 'price', 'price_VAT', 'VAT', 'active'];

    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo('App\Models\Ecommerce\Item');
    }
}