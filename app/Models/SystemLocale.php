<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLocale extends Model
{
    protected $hidden = ['id', 'active'];
    //protected $fillable = ['name', 'label'];
    public $timestamps = false;
}
