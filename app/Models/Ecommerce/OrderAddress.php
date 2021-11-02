<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class OrderAddress extends Model
{
    protected $table = 'e_order_addresses';

    public $timestamps = false;

    protected $fillable = [
        'first_name', 
        'last_name', 
        'telephone_number', 
        'street',  
        'street_plus', 
        'city', 
        'post_code', 
        'country', 
        'type'
    ];
}