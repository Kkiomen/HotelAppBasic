<?php

namespace App\Jobs;

use App\Enums\DataSource;
use App\Enums\GeneratorStatus;
use App\Helpers\GeneratorHelper;
use App\Models\ProductDescription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateProductDescriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $productDescription = ProductDescription::where('generated', 0)->first();
        if($productDescription){
            GeneratorHelper::changeStatus($productDescription, GeneratorStatus::GENERATE);
            $productDescriptionGenerator = new \App\Products\ProductDescription(DataSource::MODEL, $productDescription->toArray());

            try{
                $result = $productDescriptionGenerator->getResult();
                $productDescription->result = $result['result'];
                $productDescription->save();
                GeneratorHelper::changeStatus($productDescription, GeneratorStatus::GENERATED);
            }catch (\Exception $exception){
                GeneratorHelper::changeStatus($productDescription, GeneratorStatus::TO_GENERATE);
            }
        }


    }
}
