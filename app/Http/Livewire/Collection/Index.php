<?php

namespace App\Http\Livewire\Collection;

use App\Models\Post;
use App\Models\Collection;

use Livewire\WithPagination;

use Redirect;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;

    public $collectionName;

    public function mount($collection)
    {
        $this->collectionName = $collection;
        app()->setLocale('cs');
    }

    public function render()
    {
        $records = Post::where('collection_name', $this->collectionName)->orderBy('created_at', 'desc')->paginate(50);
        $collection = Collection::where('name', $this->collectionName)->first()->toArray();
        return view('livewire.collection.index')
                    ->with('records', $records)
                    ->with('collection', $collection);
    }
}