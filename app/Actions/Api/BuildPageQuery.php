<?php

namespace App\Actions\Api;

use App\Models\Collection;
use App\Models\SystemLocale;

trait BuildPageQuery
{
    public function resolveLocale($localeName)
    {
        $locale = SystemLocale::where('name', $localeName ?? app()->getLocale())->first();
        if($locale) {
            config(['request.locale' => $locale->toArray()]);
        }else {
            return ['error' => "Locale not exists in database"];
        }
    }

    public function validateQuery($request)
    {
        /*
        *   Validate if locale exists
        */
        $resolveLocaleResult = $this->resolveLocale($request['locale']);
        if(isset($resolveLocaleResult['error'])) return $resolveLocaleResult;
        unset($request['locale']);

        /*
        *   Format return paramters
        */
        $collections = Collection::pluck('name')->toArray();

        $query = [];
        foreach($request as $name => $params) {
            if(in_array($name, $collections) || (isset($params['collection']) && in_array($params['collection'], $collections))) {
                $query[$name] = [
                    'collection' => isset($params['collection']) ? $params['collection'] : $name,
                    'where' => [
                        'locale_name' => config('request.locale')['name']
                    ]
                ];
                if(isset($params['where']['post_id'])) $query[$name]['where']['id'] = $params['where']['post_id'];
                if(isset($params['where']['post_slug'])) $query[$name]['where']['post_slug'] = $params['where']['post_slug'];

                if(isset($params['where']['term'])) $query[$name]['term'] = $params['where']['term'];

                if(isset($params['limit'])) $query[$name]['limit'] = $params['limit'];
                if(isset($params['paginate'])) $query[$name]['paginate'] = $params['paginate'];

                if(isset($params['media'])) $query[$name]['media'] = $params['media'];

                if(isset($params['with-seo'])) $query[$name]['with-seo'] = $params['with-seo'];

                if(isset($params['with-ecommerce'])) $query[$name]['with-ecommerce'] = $params['with-ecommerce'];
            }else {
                $query[$name] = null;
            }
        }

        return $query;
    }  
}