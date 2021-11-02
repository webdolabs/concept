<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function fields()
    {
        return $this->hasMany('App\Models\CollectionField')->orderBy('order', 'desc');
    }
}