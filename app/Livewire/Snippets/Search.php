<?php

namespace App\Livewire\Snippets;

use Livewire\Component;

class Search extends Component
{
    public $search = '';

    public function updatedSearch($value){
        $this->dispatch('searchSnippet',value: $value);
    }

    public function newsnippet(){
        $this->dispatch('showSnippet',id: -1);
    }

    public function render()
    {
        return view('livewire.snippets.search');
    }
}
