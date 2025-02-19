<?php

namespace App\Livewire\Xworkbook;

use Livewire\Component;
use Spatie\WebhookClient\Models\WebhookCall;

class Index extends Component
{
    public $webhooks = [];

    public function render()
    {
        $webhooks = WebhookCall::all();




        return view('livewire.xworkbook.index', compact('webhooks'));
    }
}
