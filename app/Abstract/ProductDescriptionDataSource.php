<?php

namespace App\Abstract;

use App\Interfaces\ProductDescriptionDataSourceInterface;
use Illuminate\Http\Request;

abstract class ProductDescriptionDataSource implements ProductDescriptionDataSourceInterface
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
