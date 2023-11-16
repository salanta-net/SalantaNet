<?php

namespace App\Http\Livewire\Snippets;

use App\Http\Livewire\Trix;
use Livewire\Component;

class CreateEdit extends Component
{
    public $tags = [
        'Code' => 'rose-500',
        'Text' => 'blue-600',
        'Quotes' => 'yellow-500'
    ];
    public $tagsSelected = [];

    public $title;
    public $body;

    public $listeners = [
        Trix::EVENT_VALUE_UPDATED // trix_value_updated()
    ];

    public function trix_value_updated($value){
        $this->body = $value;
    }

    public function updatetags($value){
        if (key_exists($value,$this->tagsSelected)){
            unset($this->tagsSelected[$value]);
        }else{
            $this->tagsSelected[$value] = $this->tags[$value];
//            dd($this->tagsSelected);

        }

//        dd($this->tagsSelected);
    }

    public function save(){
        dd([
            'title' => $this->title,
            'body' => $this->body
        ]);
    }

    public function render()
    {
        return view('livewire.snippets.create-edit');
    }
}
