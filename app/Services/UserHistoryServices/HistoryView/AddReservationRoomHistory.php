<?php

namespace App\Services\UserHistoryServices\HistoryView;

use App\Models\UserHistory;
use App\Services\UserHistoryServices\Abstract\HistoryAction;
use App\Services\UserHistoryServices\Interfaces\HistoryActionInterface;
use Illuminate\Support\Facades\Lang;

final class AddReservationRoomHistory extends HistoryAction implements HistoryActionInterface
{

    public function getTitle(UserHistory $history): string
    {
        return Lang::get('history.add_reservation_room_title');
    }

    public function getInformation(UserHistory $history): string
    {
        return Lang::get('history.add_reservation_room', [
            'number' => $history->data['room_number_place'],
            'name' => $history->data['reservation_name'],
        ]);
    }

    public function getDetails(UserHistory $history): string
    {
        $URL = '<strong class="text-primary-500">URL:</strong> ' . $this->URL('filament.resources.reservations.edit', $history->data['reservation_id']);

        return $URL . '<br/>' . Lang::get('history.add_reservation_room', [
            'number' => $history->data['room_number_place'],
            'name' => $history->data['reservation_name'],
        ]);
    }

    public function getIcon(UserHistory $history): string
    {
        return 'x-heroicon-s-book-open';
    }
}
