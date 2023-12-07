<?php

namespace App\Http\Livewire\Snippets;

use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public function updatedSearch($value){
        $this->emit('searchSnippet',$value);
    }

    public function newsnippet(){
        $this->emit('showSnippet',-1);
    }

    public function render()
    {
        return view('livewire.snippets.search');
    }
}
