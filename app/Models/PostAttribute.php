<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;

use Illuminate\Database\Eloquent\Model;

class PostAttribute extends Model
{
    use NodeTrait;

    public $timestamps = false;

    protected $fillable = ['name', 'value', 'version_name', 'fieldtype', 'parent_id'];
}
