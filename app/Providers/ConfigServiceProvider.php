<?php

namespace App\Providers;

use App\Models\SystemOption;
use App\Models\SystemLocale;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(!app()->runningInConsole()) {
            $base = SystemOption::where('group', null)
                ->get()
                ->pluck('value', 'name')
                ->toArray();
            $groups = SystemOption::where('group', '!=' , null)
                ->get()
                ->groupBy('group')
                ->map(function ($pb) { return $pb->keyBy('name'); })
                ->map(function ($pb) { return $pb->pluck('value', 'name'); })
                ->toArray();
            $options = array_merge_recursive($base, $groups);
            config()->set(['option' => $options]);

            if(config('option.multilocale')) {
                $locales = SystemLocale::where('active', true)->get()->keyBy('name')->toArray();
                config()->set(['locales' => $locales]);
            }
        }
    }
}
