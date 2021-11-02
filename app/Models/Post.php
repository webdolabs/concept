<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['collection_name', 'status', 'tmp'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Str::orderedUuid()->toString());
        });

        self::deleting(function (Model $model) {
            $model->locales()->each(function($locale) {
                $locale->attributes()->each(function($attribute) {
                    $attribute->delete();
                });
                $locale->delete();
            });
            $model->versions()->each(function($version) {
               $version->delete();
            });
       });
    }

    /**
     * Register the media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('xs')->width(64);
        $this->addMediaConversion('sm')->width(280);
        $this->addMediaConversion('md')->width(420);
        $this->addMediaConversion('lg')->width(640);
        $this->addMediaConversion('xl')->width(1280);
        $this->addMediaCollection('image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);
    }

    public function locale()
    {
        return $this->hasOne('App\Models\PostLocale')->where('locale_name', app()->getLocale());
    }

    public function locales()
    {
        return $this->hasMany('App\Models\PostLocale');
    }

    public function versions()
    {
        return $this->hasMany('App\Models\PostVersion');
    }

    public function terms()
    {
        return $this->belongsToMany('App\Models\Term');
    }
}
