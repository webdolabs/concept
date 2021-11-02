<?php

namespace App\Http\Livewire\Collection;

use App\Models\Collection;
use App\Models\CollectionField;
use App\Models\Post;
use App\Models\Term;

use App\Actions\Post\FillValues;

use Livewire\WithFileUploads;
use Livewire\Component;

class Edit extends Component
{
    use FillValues;
    use WithFileUploads;

    public $uid;

    public $collection, $form;
    public $terms;
    public $post;
    public $media = [
        'prev' => [],
        'upload' => [],
        'delete' => []
    ];
    public $images;
    public $state = [];

    public function submit() {
        foreach($this->media['delete'] as $group => $images) {
            if(is_array($images)) {
                foreach($images as $key => $delete) {
                    if($delete) $this->post->getMedia($group)->find($key)->delete();
                }
            }
        }

        foreach($this->media['upload'] as $group => $images) {
            if(is_array($images)) {
                foreach($images as $image) {
                    if($image) $this->post->addMedia($image->getRealPath())->toMediaCollection($group);
                }
            }elseif($images) {
                if($this->post->getMedia($group)->first()) $this->post->getMedia($group)->first()->delete();
                $this->post->addMedia($images->getRealPath())->toMediaCollection($group);
            }
        }
        
        return dd($this->post);
    }

    public function mount($collectionName, $lang, $uid)
    {
        $this->uid = $uid;
        // CollectionField::fixTree();

        $this->collection = Collection::where('name', $collectionName)->first();
        // $this->form = $this->collection->fields->toTree()->groupBy('position')->toArray();
        $this->collection = $this->collection->toArray();
        
        // $this->form['terms'] = Term::where('collection_name', $collectionName)->get()->toArray();
        $this->post = Post::findOrFail($uid);
        //dd($post->getMedia('images'));

        // $this->setState('status', $post->status, 'posts');
        // $this->setState('aditional_date', $post->aditional_date, 'posts');
        // $this->setState('published_at', $post->published_at, 'posts');

        // $this->setState('post_slug', $post->locale->post_slug, 'post_locales');
        // $this->setState('post_title', $post->locale->post_title, 'post_locales');
        // $this->setState('post_teaser', $post->locale->post_teaser, 'post_locales');
        // $this->setState('post_custom_teaser', $post->locale->post_custom_teaser ? true : false, 'post_locales');
        // $this->setState('post_value', $post->locale->post_value, 'post_locales');
        // $this->setState('post_seo_title', $post->locale->post_seo_title, 'post_locales');
        // $this->setState('post_seo_description', $post->locale->post_seo_description, 'post_locales');
        // $this->setState('post_seo_keywords', $post->locale->post_seo_keywords, 'post_locales');
        // $this->state['post_attributes'] = $post->locale->attributes->where('parent_id', null)->keyBy('name')->toArray();

        // $this->state['post_attributes_id'] = $post->locale->attributes->where('parent_id', '!=', null)->keyBy('id')->toArray();
        //$this->media['prev'] = $post->getMedia('images');
        $this->state['upload'] = [];
        $this->state['terms'] = [];

        //dd($this->state);
    }

    public function getUploadImage($name) {
        return $this->state['upload'][$name]->temporaryUrl();
    }

    private function setState($name, $value, $table) {
        $this->state[$table][$name] = [
            'name' => $name,
            'value' => $value,
            'table' => $table,
        ];
    }

    public function render()
    {
        return view('livewire.collection.edit')->layout('layouts.app', ['fullscreen' => true,]);
    }
}