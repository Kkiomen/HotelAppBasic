<?php

namespace App\Products;

use App\Abstract\AbstractProductStrategy;
use App\Api\OpenAiApi;
use App\Enums\DataSource;
use App\Enums\OpenAiModel;
use App\Helpers\GeneratorHelper;
use App\Helpers\TokenHelper;
use App\Models\User;
use App\Services\ProductDescriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ProductDescription extends AbstractProductStrategy
{
    private array $data;
    private ProductDescriptionService $productDescriptionService;

    /**
     * @param DataSource $dataSource
     * @param array $data
     */
    public function __construct(DataSource $dataSource, array $data)
    {
        $this->dataSource = $dataSource;
        $this->data = $data;
        $this->productDescriptionService = app(ProductDescriptionService::class);
    }

    public function preparePrompt(){
        $preparedData = $this->productDescriptionService->prepareDataBySource($this->dataSource, $this->data);
        return $this->productDescriptionService->preparePrompt($preparedData);
    }


    /**
     * Method returns the finished generated product description
     * @return array
     */
    public function getResult(): array
    {
        $preparedData = $this->productDescriptionService->prepareDataBySource($this->dataSource, $this->data);
        $productDescription = $this->productDescriptionService->saveProductDescription($this->dataSource, $preparedData);
        $preparedPrompt = $this->productDescriptionService->preparePrompt($preparedData);

        $openAiClient = new OpenAiApi();
        if($this->dataSource == DataSource::API){
            $generatedDescription = null;
        }else{
            $system = $this->prepareSystemPrompt($productDescription);
            $generatedDescription = $openAiClient->generateResult($preparedPrompt,OpenAiModel::CHAT_GPT_3, $system);
            TokenHelper::saveInformationAboutDescription($productDescription, $generatedDescription['tokenUsage']);
//            if($productDescription->use_html){
//                $preparedPrompt = GeneratorHelper::HTML_PROMPT . ' '. $generatedDescription['response'];
//                $generatedDescription = $openAiClient->generateResult($preparedPrompt,OpenAiModel::CHAT_GPT_3);
//                TokenHelper::saveInformationAboutDescription($productDescription, $generatedDescription['tokenUsage']);
//            }
        }


        if ($productDescription) {
            $productDescription->generated_prompt = $preparedPrompt;
            $productDescription->save();
        }

        return [
            'data' => $preparedData,
            'result' => $generatedDescription['response'],
            'prompt' => $preparedPrompt
        ];
    }

    private function prepareSystemPrompt($productDescription): string
    {
        if(!empty($productDescription->style_and_tone)){
            return Lang::get('product_description.basic_prompt'). ' '. Lang::get('product_description.style_prompt') . $this->styleToString($productDescription->style_and_tone);
        }

        return Lang::get('product_description.basic_prompt');
    }


    private function styleToString(array $attributes, bool $isAssociationArray = false): string
    {
        try{
            if($isAssociationArray === true){
                $attributes = array_map(function($attribute) {
                    if(is_string($attribute)){
                        return $attribute;
                    }else{
                        $key = key($attribute);
                        $value = $attribute[$key];
                        return "$key: $value";
                    }
                }, $attributes);
            }
        }catch (\Exception $e){}

        return implode(", ", $attributes);
    }
}
