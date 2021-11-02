<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemOption extends Model
{
    const CREATED_AT = null;

    protected $hidden = ['id', 'group', 'type', 'updated_at'];

    protected $fillable = ['name', 'value']; 
}
