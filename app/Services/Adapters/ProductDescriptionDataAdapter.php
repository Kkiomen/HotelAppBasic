<?php

namespace App\Services\Adapters;

use App\Abstract\ProductDescriptionDataSource;
use App\Enums\DataSource;
use Illuminate\Http\Request;

class ProductDescriptionDataAdapter
{

    private DataSource $dataSource;
    private array $data;

    /**
     * @param DataSource $dataSource
     * @param array $data
     */
    public function __construct(DataSource $dataSource, array $data)
    {
        $this->dataSource = $dataSource;
        $this->data = $data;
    }

    /**
     * Method returns universal data ready to support prompt preparation for open ai api
     * @return array|null
     * @throws \Exception
     */
    public function getData(): ?array{
        $dataManager = $this->getProductDescritionDataSourceManager();
        if(is_null($dataManager)){
            return throw new \Exception('An unsupported data source was used');
        }

        return $dataManager->getData();
    }

    /**
     * Method returns a class that will return universal data based on where the data to generate the prompt came from
     * @return ProductDescriptionDataSource|null
     */
    private function getProductDescritionDataSourceManager(): ?ProductDescriptionDataSource{
        return match ($this->dataSource) {
            DataSource::API => new ApiProductDescriptionDataSource($this->data),
            DataSource::FORM => new FormProductDescriptionDataSource($this->data),
            DataSource::MODEL => new ModelProductDescriptionDataSource($this->data),
            default => null,
        };
    }

}
