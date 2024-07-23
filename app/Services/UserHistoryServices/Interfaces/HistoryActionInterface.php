<?php

namespace App\Services\UserHistoryServices\Interfaces;

use App\Models\UserHistory;

interface HistoryActionInterface
{
    public function getTitle(UserHistory $history): string;
    public function getInformation(UserHistory $history): string;
    public function getDetails(UserHistory $history): string;
    public function getIcon(UserHistory $history): string;
}
