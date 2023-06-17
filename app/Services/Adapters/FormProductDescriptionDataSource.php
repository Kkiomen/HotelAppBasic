<?php

namespace App\Services\Adapters;
use App\Abstract\ProductDescriptionDataSource;
use App\Interfaces\ProductDescriptionDataSourceInterface;
use Illuminate\Http\Request;
class FormProductDescriptionDataSource extends ProductDescriptionDataSource
{
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * The method returns universal data ready to be used by the prompt generator based on a request, i.e. data from the Form website
     * @return array
     */
    public function getData(): array
    {
        $this->data['productName'] = $this->data['product_name'];
        $this->data['targetAudience'] = $this->data['target_audience'];
        $this->data['keywordsSEO'] = $this->data['keywords_seo'];
        $this->data['styleAndTone'] = $this->data['style_and_tone'];
        $this->data['uniqueFeatures'] = $this->data['unique_features'];
        $this->data['useHtml'] = $this->data['use_html'];
        return $this->data;
    }
}
