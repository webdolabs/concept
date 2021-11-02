<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'e_order_items';

    protected $fillable = [
        'order_id', 
        'item_id', 
        'name', 
        'sub_name', 
        'price', 
        'price_VAT', 
        'VAT', 
        'quantity',
        'created_at', 
        'updated_at'
    ];

    protected $appends = ['total'];

    public function item()
    {
        return $this->belongsTo('App\Models\Ecommerce\Item');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Ecommerce\Order');
    }

    public function cart()
    {
        return $this->belongsTo('App\Models\Ecommerce\Item');
    }

    public function getTotalAttribute()
    {
        return $this->price_VAT * $this->quantity;
    }
}