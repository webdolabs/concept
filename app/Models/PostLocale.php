<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLocale extends Model
{
    protected $fillable = ['locale_name', 'version_name', 'post_slug', 'post_title', 'post_teaser', 'post_custom_teaser', 'post_value', 'post_seo_title', 'post_seo_description', 'post_seo_keywords'];
    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\PostAttribute');
    }
}
