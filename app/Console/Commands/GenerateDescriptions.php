<?php

namespace App\Console\Commands;

use App\Enums\DataSource;
use App\Enums\GeneratorStatus;
use App\Helpers\GeneratorHelper;
use App\Models\ProductDescription;
use Illuminate\Console\Command;

class GenerateDescriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-descriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $productDescription = ProductDescription::where('generated', 0)->first();

        GeneratorHelper::changeStatus($productDescription, GeneratorStatus::GENERATE);
        $productDescriptionGenerator = new \App\Products\ProductDescription(DataSource::MODEL, $productDescription->toArray());

        try {
            $result = $productDescriptionGenerator->getResult();
            $productDescription->result = $result['result'];
            $productDescription->save();
            GeneratorHelper::changeStatus($productDescription, GeneratorStatus::GENERATED);
        } catch (\Exception $exception) {
            GeneratorHelper::changeStatus($productDescription, GeneratorStatus::FAIL);
        }
    }
}
