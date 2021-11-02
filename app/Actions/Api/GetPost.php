<?php

namespace App\Actions\Api;

use App\Models\PostLocale;

use App\Actions\Api\GetEcommerceItem;
use App\Http\Resources\PostResource;
use App\Http\Resources\MediaFullUrlResource;

trait GetPost
{
    use GetEcommerceItem;
    public function getPost($query)
    {
        // Start of query
        $locale = PostLocale::whereHas('post', function ($q) use ($query) {
            // Where Collection name in posts table
            $q->where('collection_name', $query['collection']);
            // Where BelongsTo Term from same collection
            if(isset($query['term'])) {
                $q->whereHas('terms', function ($q) use ($query) {
                    $q->where('name', $query['term'])->where('collection_name', $query['collection']);
                });
            }
        });

        // Foreach where conditions in post_locales table
        foreach($query['where'] as $name => $where) {
            $locale = $locale->where($name, $where);
        }

        // TODO:paginate

        $return = [];

        // Return by limit
        if(($query['limit'] ?? null) == 1) {
            $return = $locale->first();
            $returnOriginal = $return;
            $return = new PostResource($return);
        }else {
            if(isset($query['limit'])) {
                $return = $locale->limit($query['limit']);
            }
            $return = $locale->get();
            $returnOriginal = $return->keyBy('post_id');
            $return = PostResource::collection($return);
        }

        //fix wired bug with resource
        $return = collect($return)->merge([]);

        // Add media
        if($query['media'] ?? false) {
            // if one or more records
            if(isset($return['title'])) {
                $returnMedia = [];
                foreach($query['media'] as $media) { 
                    $returnMedia[$media] = MediaFullUrlResource::collection($returnOriginal->post->getMedia($media));
                    if($media == 'thumbnail' && count($returnMedia[$media]) == 1) {
                        $returnMedia[$media] = $returnMedia[$media][0];
                    }
                }
                $return = collect($return)->merge($returnMedia);
            }else {
                foreach($return as $returnKey => $returnItem) {
                    $returnMedia = [];
                    foreach($query['media'] as $media) {
                        $returnMedia[$media] = MediaFullUrlResource::collection($returnOriginal[$returnItem['id']]->post->getMedia($media));
                        if($media == 'thumbnail' && count($returnMedia[$media]) == 1) {
                            $returnMedia[$media] = $returnMedia[$media][0];
                        }
                    }
                    $return[$returnKey] = collect($return[$returnKey])->merge($returnMedia);
                }
            }
        }

        // Add SEO meta
        if($query['with-seo'] ?? false) {
            // if one or more records
            if(isset($return['title'])) {
                $seo = [
                    'seo_title' => $returnOriginal->post_seo_title,
                    'seo_description' => $returnOriginal->post_seo_description,
                    'seo_keywords' => $returnOriginal->post_seo_keywords
                ];
                $return = collect($return)->merge($seo);
            }
        }

        // Add ecommerce
        if($query['with-ecommerce'] ?? false) {
            // if one or more records
            if(isset($return['title'])) {
                $return = collect($return)->merge($this->getEcommerce($return['id']));
            }else {
                foreach($return as $returnKey => $returnItem) {
                    $return[$returnKey] = collect($return[$returnKey])->merge($this->getEcommerce($returnItem['id']));
                    //$return[$returnKey] = (array) array_merge((array) $return[$returnKey], $this->getEcommerce($returnItem['post_id']));
                }
            }
        }

        return $return;
    }  
}