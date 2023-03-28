<?php

namespace App\Actions\Requests;

use PhpParser\Node\Stmt\Switch_;

class FileActions {


    public function LoadStockFromFile($path){
        $path = public_path('/data/sp500.csv');
        $file = fopen($path, "r");
        $all_data = array();
        while ( ($data = fgetcsv($file, 200, ",")) !==FALSE ) {
            try {

                $stock = new SP500();
                $stock->date = Carbon::parse($data[0])->format('Y-m-d');
                $stock->open = is_float(floatval($data[1])) ? floatval($data[1]) : 0 ;
                $stock->high = is_float(floatval($data[2])) ? floatval($data[2]) : 0 ;
                $stock->low = is_float(floatval($data[3])) ? floatval($data[3]) : 0 ;
                $stock->close = is_float(floatval($data[4])) ? floatval($data[4]) : 0 ;

                $stock->save();


            }catch (\Exception $e){
                dd($data,$e);
            }

        }
    }


}
