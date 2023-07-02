<?php

namespace App\Services\UserHistoryServices\HistoryView;

use App\Models\UserHistory;
use App\Services\UserHistoryServices\Abstract\HistoryAction;
use App\Services\UserHistoryServices\Interfaces\HistoryActionInterface;
use Illuminate\Support\Facades\Lang;

final class DeleteReservationRoomHistory extends HistoryAction implements HistoryActionInterface
{

    public function getTitle(UserHistory $history): string
    {
        return Lang::get('history.delete_reservation_room_title');
    }

    public function getInformation(UserHistory $history): string
    {
        return Lang::get('history.delete_reservation_room', [
                'number' => $history->data['room']['number_place'],
                'name' => $history->data['reservation']['name'],
            ]);
    }

    public function getDetails(UserHistory $history): string
    {
        $URL = '<strong class="text-primary-500">URL:</strong> ' . $this->URL('filament.resources.reservations.edit', $history->data['reservation']['id']);
        return $URL . '<br/>' . Lang::get('history.delete_reservation_room', [
                'number' => $history->data['room']['number_place'],
                'name' => $history->data['reservation']['name'],
            ]);
    }

    public function getIcon(UserHistory $history): string
    {
        return 'x-gmdi-room-preferences-tt';
    }
}
