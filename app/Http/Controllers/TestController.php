<?php

namespace App\Http\Controllers;

use App\Enums\DataSource;
use App\Enums\GeneratorStatus;
use App\Helpers\GeneratorHelper;
use App\Jobs\GenerateProductDescriptionJob;
use App\Models\ProductDescription;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test2(){

        $productDescription = ProductDescription::where('generated', 0)->first();
//        foreach ($productDescription  as $product){
//            GenerateProductDescriptionJob::dispatch($product);
//        }
//        GeneratorHelper::changeStatus($productDescription, GeneratorStatus::GENERATE);
        $productDescriptionGenerator = new \App\Products\ProductDescription(DataSource::MODEL, $productDescription->toArray());
        $result = $productDescriptionGenerator->getResult();
//
//        try{
            $result = $productDescriptionGenerator->getResult();
//            GeneratorHelper::changeStatus($productDescription, GeneratorStatus::GENERATED);
//            dd($result,$productDescription);
//        }catch (\Exception $exception){
//            GeneratorHelper::changeStatus($productDescription, GeneratorStatus::FAIL);
//        }

        echo 'test';
    }

    public function test3(){
        GenerateProductDescriptionJob::dispatch('add description');


        echo 'hej2';
    }

}
