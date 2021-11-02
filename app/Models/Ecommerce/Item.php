<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Item extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'e_items';

    protected $fillable = [
        'post_id', 
        'sub_name', 
        'weight', 
        'weight_unit', 
        'width', 
        'width_unit', 
        'height', 
        'height_unit', 
        'depth', 
        'depth_unit', 
        'buy_price', 
        'buy_price_unit', 
        'quantity', 
        'active'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Str::orderedUuid()->toString());
        });
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function currencies()
    {
        return $this->hasMany('App\Models\Ecommerce\ItemCurrency')->where('locale_name', config('request.locale')['name'] ?? app()->getLocale());
    }

    public function currency()
    {
        return $this->hasOne('App\Models\Ecommerce\ItemCurrency')->where('locale_name', config('request.locale')['name'] ?? app()->getLocale());
    }

    public function orderItem() {
        return $this->hasMany('App\Models\Ecommerce\OrderItem')->whereHas('order', function ($q) {
            $q->where('submited', 1)->where('status', '!=', 'canceled');
        });
    }

    public function getSoldCountAttribute()
    {
        return collect($this->orderItem)->sum('quantity');
    }
}