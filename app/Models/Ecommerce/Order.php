<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Order extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'e_orders';

    protected $fillable = [
        'email', 
        'locale', 
        'currency_symbol', 
        'status', 
        'delivery_number', 
        'shipping_address_id', 
        'billing_address_id', 
        'shipping_type', 
        'payment_type', 
        'customer_note', 
        'admin_note', 
        'weight', 
        'weight_unit', 
        'admin_updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Str::orderedUuid()->toString());
        });
    }

    public function items()
    {
        return $this->hasMany('App\Models\Ecommerce\OrderItem');
    }

    public function shipping()
    {
        return $this->belongsTo('App\Models\Ecommerce\Shipping', 'shipping_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Ecommerce\Payment', 'payment_id', 'id');
    }

    public function billingAddress()
    {
        return $this->belongsTo('App\Models\Ecommerce\OrderAddress', 'billing_address_id', 'id');
    }

    public function shippingAddress()
    {
        return $this->belongsTo('App\Models\Ecommerce\OrderAddress', 'shipping_address_id', 'id');
    }

    public function invoice()
    {
        return $this->hasOne('App\Models\Ecommerce\OrderInvoice');
    }

    public function getTotalVatAttribute()
    {
        return $this->items_total_VAT + $this->shipping_price_VAT + $this->payment_price_VAT;
    }
}