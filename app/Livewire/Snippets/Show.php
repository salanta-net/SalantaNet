<?php

namespace App\Livewire\Snippets;

use App\Models\Snippet;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    private $snippetid = 0;
    public $tagsSelected = [];

    #[On('showSnippet')]
    public function showSnippet($id){
        $this->snippetid = $id;
    }

    public function editSnippet($id){
        $this->dispatch('editSnippet',id: $id);
    }
    public function deleteSnippet($id){
        Snippet::withRichText()->find($id)->delete();
        return redirect()->route('snippets');
    }

    public function render()
    {
        return view('livewire.snippets.show',['snippet'=> $this->snippetid > 0 ? Snippet::find($this->snippetid) : []]);
    }
}
