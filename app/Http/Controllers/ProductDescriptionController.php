<?php

namespace App\Http\Controllers;

use App\Api\OpenAiApi;
use App\Enums\DataSource;
use App\Helpers\RequestHelper;
use App\Jobs\GenerateProductDescriptionJob;
use App\Products\ProductDescription;
use App\Services\ProductDescriptionService;
use Illuminate\Http\Request;

class ProductDescriptionController extends Controller
{

    private OpenAiApi $openAiClient;
    private ProductDescriptionService $productDescriptionService;

    /**
     * @param OpenAiApi $openAiClient
     */
    public function __construct(OpenAiApi $openAiClient, ProductDescriptionService $productDescriptionService)
    {
        $this->openAiClient = $openAiClient;
        $this->productDescriptionService = $productDescriptionService;
    }

    public function generateDescription(Request $request){
        $preparedData = $this->productDescriptionService->prepareDataBySource(DataSource::API, $request->all());
        $productDescription = $this->productDescriptionService->saveProductDescription(DataSource::API, $preparedData);
        $preparedPrompt = $this->productDescriptionService->preparePrompt($preparedData);
        $productDescription->generated_prompt = $preparedPrompt;
        $productDescription->save();
        GenerateProductDescriptionJob::dispatch('add description');
        return response()->json(['result' => $request->all()]);
    }
}
