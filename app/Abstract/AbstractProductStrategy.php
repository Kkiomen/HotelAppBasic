<?php

namespace App\Abstract;

use App\Api\OpenAiApi;
use App\Enums\DataSource;
use App\Interfaces\ProductStrategyInterface;

abstract class AbstractProductStrategy implements ProductStrategyInterface
{
    protected $openAiClient;
    protected ?DataSource $dataSource = null;

    public function __construct()
    {
        $this->openAiClient = new OpenAiApi();
    }

    /**
     * Get the information where the data came from
     * @return DataSource
     * @throws \Exception
     */
    public function getDataSource(): DataSource
    {
        if(is_null($this->dataSource)){
            throw new \Exception('For proper operation of the system, it is required to specify where the data (used in the adapter) comes from');
        }

        return $this->dataSource;
    }

}
