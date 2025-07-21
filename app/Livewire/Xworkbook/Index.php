<?php

namespace App\Livewire\Xworkbook;

use App\Actions\ShopifyAction;
use App\Models\Snippet;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\WebhookClient\Models\WebhookCall;
use Livewire\WithFileUploads;
use function PHPUnit\Framework\isEmpty;

class Index extends Component
{
    use WithFileUploads;

    public $webhooks = [];

    public $collections = [];

    public $brands = [];
    public $producttypes = [];
    public $producttype = "Electrical";

    public $brandselected = "";
    public $products = [];
    public $productmodel = "";

    public $yearfrom = "";
    public $yearto = "";

    public $versions = [];
    public $version = "";

    public $activetab = 1;
    public $status = [
        1 => ["Brand & Models","pending"],
        2 => ["Document","open"],
        3 => ["Examples Images","open"],
        4 => ["Preview","open"],
    ];

    public $trixId;
    public $content;
    public $bodytext;

    public $document;
    public $photos = [];

    #[On('trix_value_updated')]
    public function trix_value_updated($value){
        $this->content = $value;
        $this->bodytext = $value;
    }

    public function updatedActivetab(){
        foreach ($this->status as $index => $tab){
            $this->status[$index][1] = "open";
        }

        $this->status[$this->activetab][1] = "pending";
    }

    public function updatedProducttype(){

        if (Storage::disk('shopify')->exists('producttypes.json')){
            $data = json_decode(Storage::disk('shopify')->get('producttypes.json'), true);

            foreach ($data as $index => $type){
                if ($this->producttype == $index){
//                    dd($data,$type,$index, $this->producttype,$type['templates']['default']);
                    $this->content = $type['templates']['default'];
                }

            }

        }

    }

    public function addbrand(){
        $validated = $this->validate([
            'brandselected' => 'required|gte:0',
            'productmodel' => 'required|min:3'
        ],[
            'brandselected' => 'Brand needs to be selected',
            'productmodel' => 'Model needs to have more than 2 charactes'
        ]);

        $data = [$this->brands[$this->brandselected],$this->productmodel,$this->yearfrom,$this->yearto, $this->version];

//        dd($data,$this->products,empty($this->products) );
        if (empty($this->products)){
            array_push($this->products,$data);
        }else{
            $exists = false;
            foreach ($this->products as $product){
                if ($product == $data){
                    $exists = true;
                }
            }
            if (!$exists){
                array_push($this->products,$data);
            }
        }




    }

    public function sync(){
        $shopify = new ShopifyAction();

        Storage::disk('shopify')->put('collections.json',json_encode($shopify->getCollections(), JSON_PRETTY_PRINT));

        Storage::disk('shopify')->put('products.json',json_encode($shopify->getProducts(), JSON_PRETTY_PRINT));
        Redirect::to('xworkbooks')->with('success', 'Your data are now synchronized!');


    }

    public function generate(){
        // 1.Generate folder name and save to files bucket

        //        $testingfolder  = 'https://xworkbooks.syd1.cdn.digitaloceanspaces.com/';
        $testingfolder  = 'test/';
        $prefixLibrary  = 'library';
        $prefixPreview  = 'preview';
        $brands = [];
        $models = [];
        $Previewimages = [];

        foreach ($this->products as $product){
            $brands[$product[1]] = true;
            $models[$product[2]] = true;
        }

        $foldername = Str::slug(implode(' ',array_keys($brands))) . '/' . Str::slug(implode(' ',array_keys($models)));


        foreach ($this->photos as $photo) {
            $fn = Str::random(16).Str::random(16) .'.'.$photo->getClientOriginalExtension();
            $filename = $photo->storePubliclyAs($testingfolder . $prefixPreview . '/' . $foldername, $fn, 's3');

            array_push($Previewimages, $filename);
        }

        $filenameSKU = Str::random(16).Str::random(16) .'.'.$this->document->getClientOriginalExtension();
        $SKU = $this->document->storePubliclyAs($testingfolder . $prefixLibrary . '/' . $foldername, $filenameSKU, 's3');

        //2. Loop all products
        foreach ($this->products as $product){

            $collectionsToJoin = "";
            $image = "";
            $brand = $product[0];
            $model = $product[1];
            $yearfrom = $product[2];
            $yearto = $product[3];
            $version = $product[4];
            $price = "49.00";
            $descriptionHtml = "";

            //Generate year range
            $yearrange = [];
            for ($i = $product[2]; $i < $product[3]; $i++){
                array_push($yearrange, $i);
            }
            $yearrangestring = implode(', ',$yearrange) . ' and ' . $product[3];

            // Generate image src
            foreach ($Previewimages as $index => $Previewimage){
                $images[$index] = '<p><img src="https://xworkbooks.syd1.digitaloceanspaces.com/' . $Previewimage . '" alt="wirediagram"></p>';
            }

            //Generate Template
            $replacment = [
                "[[BRAND]]" => $brand,
                "[[MODEL]]" => $model,
                "[[VERSION]]" => "<p><strong>Version/Variant:</strong></p></br>" . $version,
                "[[YEARFROM]]" => $yearfrom,
                "[[YEARTO]]" => $yearto,
                "[[YEARRANGE]]" => $yearrangestring,
                "[[IMAGES]]" => implode('',$images),
            ];

            $descriptionHtml = Storage::disk('shopify')->get('templates/vehicle_electrical.html');

            foreach ($replacment as $variable => $value){
                $descriptionHtml = str_replace($variable,$value,$descriptionHtml);
            }


            foreach ($this->collections as $collection){
                if ($collection['title'] == $brand){
                    $collectionsToJoin = str_replace('gid://shopify/Collection/','',$collection['id']);
//                    $array = explode('?',$collection['image']['url']);
                }
            }

            $title = $brand . ' ' . $model . ' ' .$yearfrom. '-' . $yearto .  ' Electrical Wiring System Diagram Manual – PDF Download';

            $shopify = new ShopifyAction();
            $product = [
                "title" => $title,
                "descriptionHtml" => $descriptionHtml,
                "productType" => $this->producttype,
                "collectionsToJoin" => $collectionsToJoin,
                "tags" => [$model],
                "image" => "https://xworkbooks.com/cdn/shop/files/product_". strtolower($brand) ."_electrical.png"

            ];


            $id = $shopify->createProduct($product);

            //
            if ($id != false){
                $shopify->updateVariants($id,$price,"https://xworkbooks.syd1.digitaloceanspaces.com/".$SKU);
            }


            //Publishing to online shop
            $shopify->Publishing($id,264359313721); //Online Shop
            //$shopify->Publishing($id,264359379257); //Shop
//        dd($shopify->Publishing(9930193207609,264359379257));


        }

        Redirect::to('xworkbooks')->with('success', 'Your data are now uploaded to Shopify!');
    }

    public function uploadedDocument(){

    }

    public function mount(){
        // Importing Collections
        if (Storage::disk('shopify')->exists('collections.json')){

            $this->collections =  json_decode(Storage::disk('shopify')->get('collections.json'),true);

            //Get title
            foreach ($this->collections as $collection){
                array_push($this->brands,$collection['title']);
            }
            asort($this->brands);
        }

        // Importing Product Types
//        if (Storage::disk('shopify')->exists('producttypes.json')){
//            foreach (json_decode(Storage::disk('shopify')->get('producttypes.json'),true) as $import){
//                array_push($this->producttypes,$import['title']);
//            }
//
//            asort($this->producttypes);
//        }

        $this->producttypes = Snippet::where('tags','Shopify_ProductTypes')->pluck('title')->toArray();
        $this->categories = Snippet::where('tags','Shopify_Category')->pluck('title')->toArray();

        asort($this->producttypes);
        asort($this->categories);


        $this->trixId = 'trix-' . uniqid();

    }

    public function testdata(){

    }

    public function render()
    {
        $this->testdata();

        //Marke Status in tab
        if (!empty($this->products)){
            $this->status[1][1] = "done";
        }

        if ($this->producttype >= 0 && !empty($this->document)){
            $this->status[2][1] = "done";
        }

        return view('livewire.xworkbook.index');
    }
}
