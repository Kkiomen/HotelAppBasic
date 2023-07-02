<?php

namespace App\Services\UserHistoryServices\Abstract;

use App\Services\UserHistoryServices\Interfaces\HistoryActionInterface;

abstract class HistoryAction implements HistoryActionInterface
{
    protected function URL(string $route, string|array $params = [] ): string
    {
        $route = route($route, $params);

        return '<a href="' . $route . '" target="_blank">' . $route . '</a>';
    }
}
