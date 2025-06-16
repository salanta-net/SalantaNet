<?php

namespace App\Livewire\Snippets;

use App\Livewire\Trix;
use App\Models\Snippet;
use App\Models\Tag;
use App\Models\Taglink;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\On;


class Create extends Component
{

    public $trixId;
    public $editSnippet = false;
    public $editid = 0;
    public $tags = [];

//        [
//        'Code',
//        'Text',
//        'Quotes',
//        'Aucbot',
//        'Knowledge'
//    ];
    public $snippetid = 0;

    public $tagsSelected = [];
    public $tagsearch = '';

    public $title;
    public $content;
    public $bodytext;

    #[On('trix_value_updated')]
    public function trix_value_updated($value){
        $this->content = $value;
        $this->bodytext = $value;
    }


    public function updatedTagsearch($searchTerm){
        if (strlen($searchTerm) > 1){
            $this->tags = Tag::query()
                ->where('label', 'like', '%'. $searchTerm . '%')
                ->get()->pluck('label','id')->toArray();
        }


    }


    public function updatetags($value){
        if (key_exists($value,$this->tagsSelected)){
            unset($this->tagsSelected[$value]);
        }else{
            $this->tagsSelected[$value] = $this->tags[$value];
        }
    }
    public function createtag($name){
        array_push($this->tagsSelected,$name);
        $this->reset('tags','tagsearch');

    }

    public function linktag($id){

        $tag = Tag::find($id);

        $this->tagsSelected[$id] = $tag->label;
        $this->reset('tags','tagsearch');

    }

    public function deletetag($id){
        unset($this->tagsSelected[$id]);
        $this->reset('tags','tagsearch');

    }




    public function save(){

        if ($this->editid > 0){
            $this->validate([
                'title' => 'required|max:255',
                'content' => 'required',
            ]);

            $snippet = Snippet::withRichText()->find($this->editid);
            $snippet->title = $this->title;
            $snippet->content = $this->content;
            $snippet->slug = Str::slug($this->title);
            $snippet->save();

        }else{

            $validated = $this->validate([
                'title' => 'required|unique:snippets|max:255',
                'content' => 'required',
            ]);

            $snippet = Snippet::create(array_merge($validated, ['slug' => Str::slug($this->title)]));
        }

        $taglinks = Taglink::with('tag')
            ->where('model_type','Snippet')
            ->where('model_id',$snippet->id)
            ->get()->pluck('tag.label','id')->toArray();


        foreach ($this->tagsSelected as $id => $tag){
            $newtag = Tag::updateOrCreate(
                ['label' => $tag]
            );
            Taglink::updateOrCreate(
                ['model_id' => $snippet->id, 'model_type' => 'Snippet', 'tag_id' => $newtag->id]
            );
        }


        //Delete all untaged links
        $deleteTagLink = [];
        foreach ($taglinks as $id => $label){
            //Delete TagLink
            if (!in_array($id,array_keys($this->tagsSelected))){
                array_push($deleteTagLink,$id);
            }
        }
        Taglink::whereIn('id',$deleteTagLink)->delete();


        //Delete all tags that are not in use
        Tag::whereNotIn('id',Taglink::select('tag_id')->groupBy('tag_id')->get()->pluck('tag_id')->toArray())->delete();

        return redirect()->route('snippets');

    }

    public function mount(){
        if ($this->editSnippet){
            $snippet = Snippet::withRichText()->find($this->editid);
            //dd($snipet->content,$snipet->content->body->toTrixHtml());
            $this->title = $snippet->title;
            $this->content = $snippet->content->body->toTrixHtml();
            $this->tagsSelected = Taglink::with('tag')
                ->where('model_type','Snippet')
                ->where('model_id',$snippet->id)
                ->get()->pluck('tag.label','tag.id')->toArray();
        }
        $this->trixId = 'trix-' . uniqid();
    }
    public function render()
    {

        return view('livewire.snippets.create');
    }
}
