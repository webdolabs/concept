<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostVersion extends Model
{
    protected $fillable = ['name', 'label'];
    public $timestamps = false;

}
