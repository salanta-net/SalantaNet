<?php

namespace App\Http\Livewire\Snippets;

use App\Models\Snippet;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Lists extends Component
{
    public $readyToLoad = false;
    public $search = '';

    public function loadSnippets()
    {
        $this->readyToLoad = true;
    }
    protected $listeners = ['searchSnippet'];

    public function searchSnippet($value){
        $this->search = $value;
    }

    public function show($id){
        $this->emit('showSnippet',$id);
    }
    public function render()
    {
        $data = Snippet::select('id','title','updated_at')->where('title','like','%'.$this->search.'%')->OrderBy('title','asc')->take(30)->get();

        $snippets = $data->groupBy(function($item,$key) {
            return $item->title[0];     //treats the name string as an array
        })
            ->sortBy(function($item,$key){      //sorts A-Z at the top level
                return $key;
            });

        return view('livewire.snippets.lists', [
            'snippets' => $this->readyToLoad
                ? $snippets
                : [],
        ]);
    }
}
