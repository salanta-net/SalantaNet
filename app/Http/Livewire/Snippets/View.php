<?php

namespace App\Http\Livewire\Snippets;

use App\Models\Snippet;
use Livewire\Component;

class View extends Component
{
    public $tab = -1;
    public $editid = 0;

    protected $listeners = ['showSnippet','editSnippet'];

    public function showSnippet($id){
        $this->tab = $id;
    }

    public function editSnippet($id){
        if ($id > 0){
            $this->tab = 0;
            $this->editid = $id;
        }
    }
    public function render()
    {
        return view('livewire.snippets.view');
    }
}
