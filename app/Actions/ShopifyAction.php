<?php

namespace App\Actions;



use Illuminate\Support\Facades\Storage;

use Spatie\WebhookClient\Models\WebhookCall;

class ShopifyAction {

    public function getCollections(){
        $api_key = env('SHOPIFY_API_KEY');
        $shared_secret = env('SHOPIFY_SHARED_SECRET');
        $shop = env('SHOPIFY_SHOP');
        $token = env('SHOPIFY_TOKEN');


        $url = 'https://' . $shop . '.myshopify.com/admin/api/2025-01/graphql.json';

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
        curl_setopt($curl, CURLOPT_POSTFIELDS, "{\n\"query\": \"query { collections(first: 10) { edges { node { id title handle updatedAt } } } }\"\n}");

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
}