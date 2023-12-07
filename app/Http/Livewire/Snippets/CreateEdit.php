<?php

namespace App\Http\Livewire\Snippets;

use App\Http\Livewire\Trix;
use App\Models\Snippet;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateEdit extends Component
{


    public function render()
    {
        return view('livewire.snippets.create-edit');
    }
}
