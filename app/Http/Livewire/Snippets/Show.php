<?php

namespace App\Http\Livewire\Snippets;

use App\Models\Snippet;
use Livewire\Component;

class Show extends Component
{
    private $snippetid = 0;
    public $tagsSelected = [];


    protected $listeners = ['showSnippet'];

    public function showSnippet($id){
        $this->snippetid = $id;
    }

    public function editSnippet($id){
        $this->emit('editSnippet',$id);
    }

    public function render()
    {
        return view('livewire.snippets.show',['snippet'=> $this->snippetid > 0 ? Snippet::find($this->snippetid) : []]);
    }
}
