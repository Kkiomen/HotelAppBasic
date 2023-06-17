<?php

namespace App\Services;

use App\Enums\DataSource;
use App\Generators\PromptProductDescriptionGenerator;
use App\Services\Adapters\ProductDescriptionDataAdapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductDescriptionService
{
    private PromptProductDescriptionGenerator $productDescriptionGenerator;

    /**
     * @param PromptProductDescriptionGenerator $productDescriptionGenerator
     */
    public function __construct(PromptProductDescriptionGenerator $productDescriptionGenerator)
    {
        $this->productDescriptionGenerator = $productDescriptionGenerator;
    }

    /**
     * Method prepares universal data to generate a prompt based on the source where the data came from
     * @param DataSource $dataSource
     * @param array $data
     * @return array|null
     */
    public function prepareDataBySource(DataSource $dataSource, array $data)
    {
        $productDescriptionDataAdapter = new ProductDescriptionDataAdapter($dataSource, $data);
        return $productDescriptionDataAdapter->getData();
    }

    /**
     * The method prepares a prompt for the product description based on the received data
     * @param array $data
     * @return string
     */
    public function preparePrompt(array $data): string
    {
        return $this->productDescriptionGenerator->generate($data);
    }


    public function saveProductDescription(DataSource $dataSource, array $data)
    {
        if ($dataSource->value == DataSource::MODEL->value) {
            return \App\Models\ProductDescription::where('id', $data['id'])->first();
        }

        $productDescription = \App\Models\ProductDescription::where('user_id', Auth::user()->id)
            ->where('product_id', $data['product_id'])
            ->where('product_name', $data['productName'])->first();
        if (!$productDescription) {
            $productDescription = new \App\Models\ProductDescription();
        }

        $productDescription->user_id = Auth::user()->id;
        $productDescription->product_id = $data['product_id'] ?? null;
        $productDescription->subject = $data['subject'] ?? null;
        $productDescription->product_name = $data['productName'] ?? null;
        $productDescription->category = $data['category'] ?? null;
        $productDescription->attributes = $data['attributes'] ?? null;
        $productDescription->target_audience = $data['targetAudience'] ?? null;
        $productDescription->keywords = $data['keywords'] ?? null;
        $productDescription->keywords_seo = $data['keywordsSEO'] ?? null;
        $productDescription->use_html = $data['useHtml'] ?? false;
        $productDescription->style_and_tone = $data['styleAndTone'] ?? null;
        $productDescription->limitations = $data['limitations'] ?? null;
        $productDescription->material = $data['material'] ?? null;
        $productDescription->warranty = $data['warranty'] ?? null;
        $productDescription->unique_features = $data['uniqueFeatures'] ?? null;
        $productDescription->description = $data['description'] ?? null;
        $productDescription->accepted = false;
        $productDescription->save();

        return $productDescription;
    }

}
