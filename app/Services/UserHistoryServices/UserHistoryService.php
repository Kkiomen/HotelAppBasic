<?php

namespace App\Services\UserHistoryServices;

use App\Models\UserHistory;
use App\Services\UserHistoryServices\Enums\HistoryActionEnum;

class UserHistoryService
{

    public static function addReservationHistory(HistoryActionEnum $action, array $data = null, ?int $reservationId = null, int $user_id = null, int $hotel_id = null): void
    {
        if($user_id == null) {
            $user_id = auth()->user()->id;
        }

        if($hotel_id == null) {
            $hotel_id = auth()->user()->active_hotel;
        }

        $history = new UserHistory();
        $history->user_id = $user_id;
        $history->hotel_id = $hotel_id;
        $history->action = $action->value ?? null;
        $history->data = $data ?? null;
        $history->save();
    }

    public static function addHistory(HistoryActionEnum $action, array $data = null, int $user_id = null, int $hotel_id = null): void
    {
        if($user_id == null) {
            $user_id = auth()->user()->id;
        }

        if($hotel_id == null) {
            $hotel_id = auth()->user()->active_hotel;
        }

        $history = new UserHistory();
        $history->user_id = $user_id;
        $history->hotel_id = $hotel_id;
        $history->action = $action->value ?? null;
        $history->data = $data ?? null;
        $history->save();
    }

    public static function getInformation(UserHistory $userHistory): string
    {
        $action  = HistoryActionEnum::from($userHistory->action);
        return $action->getInformation($userHistory);
    }

    public static function getDetails(UserHistory $userHistory): string
    {
        $action  = HistoryActionEnum::from($userHistory->action);
        return $action->getDetails($userHistory);
    }
    public static function getTitle(UserHistory $userHistory): string
    {
        $action  = HistoryActionEnum::from($userHistory->action);
        return $action->getTitle($userHistory);
    }
    public static function getIcon(UserHistory $userHistory): string
    {
        $action  = HistoryActionEnum::from($userHistory->action);
        return $action->getIcon($userHistory);
    }



}
