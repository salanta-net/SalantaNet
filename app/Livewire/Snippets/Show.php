<?php

namespace App\Livewire\Snippets;

use App\Models\Snippet;
use App\Models\Taglink;
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
        $this->tagsSelected = Taglink::with('tag')
            ->where('model_type','Snippet')
            ->where('model_id',$this->snippetid)
            ->get()->pluck('tag.label','tag.id')->toArray();
        return view('livewire.snippets.show',['snippet'=> $this->snippetid > 0 ? Snippet::find($this->snippetid) : []]);
    }
}
