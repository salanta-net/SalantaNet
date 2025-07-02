<?php

namespace App\Livewire\Xworkbook;

use App\Actions\ShopifyAction;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Spatie\WebhookClient\Models\WebhookCall;

class Index extends Component
{
    public $webhooks = [];
    public $brands = [];
    public $brandselected = "";

    public function sync (){
        $shopify = new ShopifyAction();
        Storage::disk('shopify')->put('import.json',json_encode($shopify->getCollections(), JSON_PRETTY_PRINT));
    }
    public function render()
    {
$imports = json_decode(Storage::disk('shopify')->get('import.json'),true);

        foreach ($imports as $import){
            array_push($this->brands,$import['title']);
        }
        asort($this->brands);
        //$this->brands = json_decode(Storage::disk('shopify')->get('import.json'),true);
       //dd($import);



        return view('livewire.xworkbook.index');
    }
}
