<?php

namespace App\Http\Livewire\Snippets;

use App\Http\Livewire\Trix;
use App\Models\Snippet;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{

    public $editSnippet = false;
    public $editid = 0;
    public $tags = [
        'Code',
        'Text',
        'Quotes'
    ];
    public $snippetid = 0;

    public $tagsSelected = [];

    public $title;
    public $content;

    public $listeners = [
        Trix::EVENT_VALUE_UPDATED
    ];

    public function trix_value_updated($value){
        $this->content = $value;
    }

    public function updatetags($value){
        if (key_exists($value,$this->tagsSelected)){
            unset($this->tagsSelected[$value]);
        }else{
            $this->tagsSelected[$value] = $this->tags[$value];
        }
    }

    protected $rules = [
        'title' => 'required|unique:snippets|max:255',
        'content' => 'required',
    ];

    public function save(){
        $validated = $this->validate();
        if ($this->editid > 0){
            Snippet::update(array_merge($validated, ['slug' => Str::slug($this->title),'tags' => json_encode($this->tagsSelected)]));
        }else{
            Snippet::create(array_merge($validated, ['slug' => Str::slug($this->title),'tags' => json_encode($this->tagsSelected)]));
        }


        return redirect()->route('snippets');

    }
    public function render()
    {
        if ($this->editSnippet){
            $snipet = Snippet::find($this->editid);
            $this->title = $snipet->title;
            $this->content = $snipet->content;
        }
        return view('livewire.snippets.create');
    }
}
