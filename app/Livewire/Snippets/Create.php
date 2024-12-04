<?php

namespace App\Livewire\Snippets;

use App\Livewire\Trix;
use App\Models\Snippet;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\On;


class Create extends Component
{

    public $trixId;
    public $editSnippet = false;
    public $editid = 0;
    public $tags = [
        'Code',
        'Text',
        'Quotes',
        'Aucbot',
        'Knowledge'
    ];
    public $snippetid = 0;

    public $tagsSelected = [];

    public $title;
    public $content;
    public $bodytext;

    #[On('trix_value_updated')]
    public function trix_value_updated($value){
        $this->content = $value;
        $this->bodytext = $value;
    }


    public function updatetags($value){
        if (key_exists($value,$this->tagsSelected)){
            unset($this->tagsSelected[$value]);
        }else{
            $this->tagsSelected[$value] = $this->tags[$value];
        }
    }

    public function save(){

        if ($this->editid > 0){
            $this->validate([
                'title' => 'required|max:255',
                'content' => 'required',
            ]);

            $snipet = Snippet::withRichText()->find($this->editid);
            $snipet->title = $this->title;
            $snipet->content = $this->content;
            $snipet->slug = Str::slug($this->title);
            $snipet->tags = json_encode($this->tagsSelected);

            $snipet->save();

        }else{

            $validated = $this->validate([
                'title' => 'required|unique:snippets|max:255',
                'content' => 'required',
            ]);


            Snippet::create(array_merge($validated, ['slug' => Str::slug($this->title),'tags' => json_encode($this->tagsSelected)]));
        }


        return redirect()->route('snippets');

    }

    public function mount(){
        if ($this->editSnippet){
            $snipet = Snippet::withRichText()->find($this->editid);
            //dd($snipet->content,$snipet->content->body->toTrixHtml());
            $this->title = $snipet->title;
            $this->content = $snipet->content->body->toTrixHtml();
            $this->tagsSelected = json_decode($snipet->tags,true);
        }
        $this->trixId = 'trix-' . uniqid();
    }
    public function render()
    {

        return view('livewire.snippets.create');
    }
}
