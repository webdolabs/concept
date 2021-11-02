<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Term;

use App\Actions\Api\BuildPageQuery;
use App\Actions\Api\GetPost;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    use BuildPageQuery, GetPost;
    public $locale;

    public function show(Request $request) {
        $request = $request->all();

        /*
        *   Validate query request data
        */
        $queryValidateResult = $this->validateQuery($request);
        if(isset($queryValidateResult['error'])) return $queryValidateResult;

        $return = [];

        /*
        *   Get posts
        */
        foreach($queryValidateResult as $name => $query) {
            if(isset($query['term'])) {
                $return[$query['collection'] . '_term'] = Term::where('collection_name', $query['collection'])->where('name', $query['term'])->first(['name', 'label']);
            }
            if($query) {
                $post = $this->getPost($query);
                if(isset($query['with-seo'])) {
                    $return['meta'] = [
                        'page_title' => config('option.meta_prefix') . $post['title'],
                        'seo_title' => $post['seo_title'],
                        'seo_description' => $post['seo_description'],
                        'seo_keywords' => $post['seo_keywords'],
                    ];
                }
                $return[$name] = $post;
            }else {
                $return[$name] = null;
            }
            
        }

        return $return;

        return $queryValidateResult;
        dd($request);
    }
}