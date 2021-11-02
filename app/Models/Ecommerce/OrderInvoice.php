<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class OrderInvoice extends Model
{
    protected $keyType = 'string';

    protected $table = 'e_order_invoices';

    const UPDATED_AT = null;

    protected $fillable = [
        'prefix', 
        'number', 
        'synced', 
        'created_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Str::orderedUuid()->toString());
        });
    }
}