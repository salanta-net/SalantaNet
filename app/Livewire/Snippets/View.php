<?php

namespace App\Livewire\Snippets;

use App\Models\Snippet;
use Livewire\Component;
use Livewire\Attributes\On;

class View extends Component
{
    public $tab = -1;
    public $editid = 0;

    protected $listeners = ['showSnippet','editSnippet'];

    #[On('showSnippet')]
    public function showSnippet($id){
        $this->tab = $id;
    }

    #[On('editSnippet')]
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
