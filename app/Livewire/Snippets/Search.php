<?php

namespace App\Livewire\Snippets;

use App\Models\Tag;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public $tags = [];
    public $filterselected = [];

    public function updatedSearch($value){
        $this->dispatch('searchSnippet',value: $value, tags: array_keys($this->filterselected));
    }


    public function newsnippet(){
        $this->dispatch('showSnippet',id: -1);
    }

    public function addfilter($id, $label){
        if(key_exists($id,$this->filterselected)){
            unset($this->filterselected[$id]);
        }else{
            $this->filterselected[$id] = $label;
        }
    }

    public function applyfilter(){
        $this->dispatch('searchSnippet',value: $this->search, tags: array_keys($this->filterselected));
    }

    public function mount(){
        $this->tags = Tag::all();
    }

    public function render()
    {
        return view('livewire.snippets.search');
    }
}
