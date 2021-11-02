<?php

namespace App\Actions\Post;

use App\Models\Post;

trait FillValues
{
    public function createArrayItem($itemName, $itemValue, $array, $parentId) {
        $state = Post::find($this->uid);

        $return = [];
        
        $return[0] = $state->locales()
            ->where('name', app()->getLocale())
            ->first()
            ->attributes()
            ->create([
                'name' => $itemName,
                'value' => $itemValue,
                'version_name' => 'main',
                'fieldtype' => 'text',
                'parent_id' => $parentId
            ])->toArray();

        foreach($array as $name => $value) {
            $state->locales()
                ->where('name', app()->getLocale())
                ->first()
                ->attributes()
                ->create([
                    'name' => $name,
                    'value' => $value,
                    'version_name' => 'main',
                    'fieldtype' => 'text',
                    'parent_id' => $return[0]['id']
                ])->id;
        }

    }

    public function editArrayValue() {
        
    }

    public function editValue($name, $value) {
        $locale = $this->state->locale();
        if(str_starts_with($name, 'post')) {
            //$this->state->locale()->{$name} = $value;
            $locale->update([
                $name => $value
            ]);
        }else {
            $this->state->locales()
                ->where('name', app()->getLocale())
                ->first()
                ->attributes()
                ->where('name', $name)
                ->update([
                    'value' => $value
                ]);
            // $locale->attributes()->where('name', $name)->update([
            //     $name => $value
            // ]);
            dd('edit attribute');
        }
        //dd($name, $value);
    }
}