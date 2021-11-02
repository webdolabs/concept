<?php

namespace App\Actions\Post;

use App\Models\Collection;
use App\Models\Post;

trait CreateTmpStructure
{
    public function createTmpStructure($collectionName, $lang) {
        $collection = Collection::where('name', $collectionName)->first();
        $collection = $collection->fields->groupBy('parent_id')->toArray();

        // BASE Structure
        $post = Post::create([
            'collection_name' => $collectionName,
            'status' => 'tmp'
        ]);
        $post->versions()->create([
            'name' => 'main',
        ]);
        $locale = $post->locale()->create([
            'name' => $lang,
            'version_name' => 'main'
        ]);

        foreach($collection as $key => $collectionGroup) {
            foreach($collectionGroup as $groupKey => $item) {
                if($item['table'] == 'post-attributes') {
                    $attribute = $locale->attributes()->create([
                        'name' => $item['name'],
                        'version_name' => 'main',
                        'fieldtype' => $item['fieldtype'],
                        'parent_id' => $collection[$key][$groupKey]['db_parent_id'] ?? null
                    ]);
                    if(isset($collection[$item['id']])) {
                        foreach($collection[$item['id']] as $subKey => $subItem) {
                            $collection[$item['id']][$subKey]['db_parent_id'] = $attribute->id;
                        }
                    } 
                }
            }
            
        }

        return [
            'id' => $post->id,
            'lang' => $lang
        ];
    }
}