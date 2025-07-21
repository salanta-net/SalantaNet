<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\WebhookClient\Models\WebhookCall;
use PHPShopify\ShopifySDK;

class ShopifyAction {


    public function getCollections(){
        $api_key = env('SHOPIFY_API_KEY');
        $shared_secret = env('SHOPIFY_SHARED_SECRET');
        $shop = env('SHOPIFY_SHOP');
        $token = env('SHOPIFY_TOKEN');


        $url = 'https://' . $shop . '.myshopify.com/admin/api/2025-04/graphql.json';

        // Configure cURL
        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);

        // Setup headers
        $request_headers = array();
        $request_headers[] = 'Content-Type: application/json';
        $request_headers[] = "X-Shopify-Access-Token: " . $token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);

//        $query = http_build_query(array(['collections'=> ]));
//        curl_setopt ($curl, CURLOPT_POSTFIELDS, $query);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "{\n\"query\": \"query { collections(first: 50) { edges { node { id title image {url} } } } }\"\n}");
//        curl_setopt($curl, CURLOPT_POSTFIELDS, "{\n\"query\": \"query { productTypes(first: 10) { edges { node { title  } } } }\"\n}");

//        $arrayVar = '{
//          "query": "query { collections(first: 10, query: \"title:All*\") { edges { node { id title handle updatedAt } } } }"
//        }';
//        curl_setopt($curl, CURLOPT_POSTFIELDS,  $arrayVar);


        // Send request to Shopify and capture any errors
        $response = curl_exec($curl);
        $error_number = curl_errno($curl);
        $error_message = curl_error($curl);


        // Close cURL to be nice
        curl_close($curl);
        $array = json_decode($response,true);

        try {
            $collections = [];
            foreach ($array['data']['collections']['edges'] as $node){
                array_push($collections,$node['node']);
            }
            return($collections);
            //return $array['fulfillment_orders'][0]['line_items'][0]['fulfillment_order_id'];
        }catch (\Exception $e){
//            dd($e,'error');
            return false;
        }

    }

    public function getProducttypes(){
        $api_key = env('SHOPIFY_API_KEY');
        $shared_secret = env('SHOPIFY_SHARED_SECRET');
        $shop = env('SHOPIFY_SHOP');
        $token = env('SHOPIFY_TOKEN');


        $url = 'https://' . $shop . '.myshopify.com/admin/api/2025-04/graphql.json';

        // Configure cURL
        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);

        // Setup headers
        $request_headers = array();
        $request_headers[] = 'Content-Type: application/json';
        $request_headers[] = "X-Shopify-Access-Token: " . $token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);

//        $query = http_build_query(array(['collections'=> ]));
//        curl_setopt ($curl, CURLOPT_POSTFIELDS, $query);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "{\n\"query\": \"query { productTypes(first: 250) { edges { node } } }\"\n}");


//        $arrayVar = '{
//          "query": "query { collections(first: 10, query: \"title:All*\") { edges { node { id title handle updatedAt } } } }"
//        }';
//        curl_setopt($curl, CURLOPT_POSTFIELDS,  $arrayVar);


        // Send request to Shopify and capture any errors
        $response = curl_exec($curl);
        $error_number = curl_errno($curl);
        $error_message = curl_error($curl);


        // Close cURL to be nice
        curl_close($curl);
        $array = json_decode($response,true);


        try {
            $productTypes = [];

            foreach ($array['data']['productTypes']['edges'] as $node){
                array_push($productTypes,$node['node']);
            }

            return($productTypes);

            //return $array['fulfillment_orders'][0]['line_items'][0]['fulfillment_order_id'];
        }catch (\Exception $e){
//            dd($e,'error');
            return false;
        }

    }

    private function init(){
        $config = array(
            'ShopUrl' => env('SHOPIFY_SHOP') . '.myshopify.com',
            'ApiKey' => env('SHOPIFY_API_KEY'),
            'SharedSecret' => env('SHOPIFY_SHARED_SECRET'),
            'AccessToken' => env('SHOPIFY_TOKEN'),
            'ApiVersion' => '2025-04',
        );

        ShopifySDK::config($config);
        return new ShopifySDK;
    }

    public function getProducts(){
        $shopify = $this->init();

        return $shopify->Product->get();
    }

    public function getProduct($productID){
        $shopify = $this->init();

        return $shopify->Product($productID)->get();
    }

    public function updateVariants($productID,$price,$SKU){
        
        $shopify = $this->init();

        $product = [
            "variants" => [
                [
                    "title" => "Default Title",
                    "price" => $price,
                    "position" => 1,
                    "inventory_policy" => "deny",
                    "compare_at_price" => null,
                    "option1" => "Default Title",
                    "option2" => null,
                    "option3" => null,
                    "taxable" => true,
                    "fulfillment_service" => "manual",
                    "grams" => 0,
                    "inventory_management" => null,
                    "requires_shipping" => false,
                    "sku" => $SKU,
                    "weight" => 0.0,
                    "weight_unit" => "kg"
                ]

            ]
        ];



        try {
            return  $shopify->Product($productID)->put($product);
        }catch (\Exception $e){

        }

    }

    public function createProduct($product){

        $api_key = env('SHOPIFY_API_KEY');
        $shared_secret = env('SHOPIFY_SHARED_SECRET');
        $shop = env('SHOPIFY_SHOP');
        $token = env('SHOPIFY_TOKEN');


        $url = 'https://' . $shop . '.myshopify.com/admin/api/2025-04/graphql.json';

        // Configure cURL
        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);

        // Setup headers
        $request_headers = array();
        $request_headers[] = 'Content-Type: application/json';
        $request_headers[] = "X-Shopify-Access-Token: " . $token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);

       $data = [
            'query' => 'mutation CreateProductWithNewMedia($product: ProductCreateInput!, $media: [CreateMediaInput!]) { productCreate(product: $product, media: $media ) { product { id title  handle descriptionHtml status vendor productType tags media(first: 10) { nodes { alt mediaContentType preview { status } } } } userErrors { field message } } }',
            'variables' => [
                'product' => [
                    "title" => $product['title'],
                    "handle" => Str::slug($product['title']),
                    "descriptionHtml" => $product['descriptionHtml'],
                    "status" => "DRAFT",
                    "vendor" => "xWorkbooks",
                    "productType" => $product['productType'],
                    "collectionsToJoin" => ["gid://shopify/Collection/".$product['collectionsToJoin']],
                    "tags" => $product['tags'],
                ],
                'media' => [
                    [
                        "originalSource" => $product['image'],
                        "mediaContentType" => "IMAGE"
                    ]
                ]
            ]
        ];

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($curl);

        curl_close($curl);
        $array = json_decode($response,true);


        try {
            return str_replace('gid://shopify/Product/','',$array['data']['productCreate']['product']['id']);
        }catch (\Exception $e){
            return false;
        }

    }

    public function updateProduct(){
        $api_key = env('SHOPIFY_API_KEY');
        $shared_secret = env('SHOPIFY_SHARED_SECRET');
        $shop = env('SHOPIFY_SHOP');
        $token = env('SHOPIFY_TOKEN');


        $url = 'https://' . $shop . '.myshopify.com/admin/api/2025-04/graphql.json';

        // Configure cURL
        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);

        // Setup headers
        $request_headers = array();
        $request_headers[] = 'Content-Type: application/json';
        $request_headers[] = "X-Shopify-Access-Token: " . $token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);

//        $query = http_build_query(array(['collections'=> ]));
//        curl_setopt ($curl, CURLOPT_POSTFIELDS, $query);


        $data = [
            'query' => 'mutation ProductVariantsCreate($productId: ID!, $variants: [ProductVariantsBulkInput!]!) { productVariantsBulkCreate(productId: $productId, variants: $variants) { productVariants { id title } userErrors { field message } } }',
            "variables" => [
                "productId" => "gid://shopify/Product/9918908694841",
                "variants" => [
                    [
                        "price" => 35.99,
                        "compareAtPrice" => 19.99,
                        "option1" => "Default Title"
                    ]
                ]
            ]

        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($curl);

        curl_close($curl);
        dd($response);
    }

    public function Publishing($productId,$publicationId){
        $api_key = env('SHOPIFY_API_KEY');
        $shared_secret = env('SHOPIFY_SHARED_SECRET');
        $shop = env('SHOPIFY_SHOP');
        $token = env('SHOPIFY_TOKEN');


        $url = 'https://' . $shop . '.myshopify.com/admin/api/2025-04/graphql.json';

        // Configure cURL
        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);

        // Setup headers
        $request_headers = array();
        $request_headers[] = 'Content-Type: application/json';
        $request_headers[] = "X-Shopify-Access-Token: " . $token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);

//        $query = http_build_query(array(['collections'=> ]));
//        curl_setopt ($curl, CURLOPT_POSTFIELDS, $query);

        $data = [
            'query' => 'mutation PublishablePublish($productId: ID!, $publicationId: ID!) { publishablePublish(id: $productId, input: {publicationId: $publicationId}) { publishable { publishedOnPublication(publicationId: $publicationId) } userErrors { field message } } }',
            'variables' => [
                'productId' => "gid://shopify/Product/" . $productId,
                'publicationId' => "gid://shopify/Publication/" . $publicationId
            ]
        ];

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($curl);

        curl_close($curl);
        $array = json_decode($response,true);

        try {
            return true;
        }catch (\Exception $e){
//            dd($e,'error');
            return false;
        }
    }
}