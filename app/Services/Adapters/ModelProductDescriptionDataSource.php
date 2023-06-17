<?php

namespace App\Services\Adapters;

use App\Abstract\ProductDescriptionDataSource;

class ModelProductDescriptionDataSource extends ProductDescriptionDataSource
{
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * The method returns universal data ready to be used by the prompt generator based on a request, i.e. data from the Api
     * @return array
     */
    public function getData(): array
    {
        $resultData = $this->data;
        $resultData['use_html'] = ($resultData['use_html'] == 1);
        return $resultData;
    }
}
