<?php

namespace App\Livewire\Snippets;

use App\Models\Snippet;
use App\Models\Taglink;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;

class Lists extends Component
{
    public $readyToLoad = false;
    public $search = '';
    public $tags = [];

    public function loadSnippets()
    {
        $this->readyToLoad = true;
    }

    #[On('searchSnippet')]
    public function searchSnippet($value,$tags){
        $this->search = $value;
        $this->tags = $tags;
    }

    public function show($id){
        $this->dispatch('showSnippet', id: $id);
    }

    public function render()
    {
        $tags = Taglink::whereIn('tag_id',$this->tags)->pluck('model_id')->toArray();

        //dd($tags,array_values($this->tags));
        $query = Snippet::select('id','title','updated_at')->where('title','like','%'.$this->search.'%');


        if (count($tags) > 0){
            $query->whereIn('id',$tags);
        }else{

        }

        $query = $query->OrderBy('title','asc')->take(30)->get();

        $snippets = $query->groupBy(function($item,$key) {
            return $item->title[0];     //treats the name string as an array
        })->sortBy(function($item,$key){      //sorts A-Z at the top level
                return $key;
            });

        return view('livewire.snippets.lists', compact('snippets'));

//        return view('livewire.snippets.lists', [
//            'snippets' => $this->readyToLoad
//                ? $snippets
//                : [],
//        ]);
    }
}
