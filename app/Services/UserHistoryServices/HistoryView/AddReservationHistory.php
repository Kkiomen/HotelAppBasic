<?php

namespace App\Services\UserHistoryServices\HistoryView;

use App\Models\UserHistory;
use App\Services\UserHistoryServices\Abstract\HistoryAction;
use App\Services\UserHistoryServices\Interfaces\HistoryActionInterface;
use Illuminate\Support\Facades\Lang;

final class AddReservationHistory extends HistoryAction implements HistoryActionInterface
{
    public function getInformation(UserHistory $history): string
    {
        return $this->getTitle($history) . '<br/>' . Lang::get('history.add_reservation', [
                'start_date' => $history->data['check_in'],
                'end_date' => $history->data['check_out']
            ]);
    }

    public function getDetails(UserHistory $history): string
    {
        $URL = '<strong class="text-primary-500">URL:</strong> ' . $this->URL('filament.resources.reservations.edit', $history->data['id']);
//        dump($history->data);
        return $URL . '<br/>' . Lang::get('history.add_reservation_details', [
                'name' => $history->data['name'],
                'start_date' => $history->data['check_in'],
                'end_date' => $history->data['check_out'],
                'name_reservation_person' => $history->data['name_reservation_person'],
                'phone' => $history->data['phone'],
                'email' => $history->data['email'],
                'address' => $history->data['address'],
                'city' => $history->data['city'],
                'postal_code' => $history->data['postal_code'],
                'country' => $history->data['country'],
                'description' => $history->data['description'],
                'number_adult' => $history->data['number_adult'],
                'number_child' => $history->data['number_child'],

            ]);
    }

    public function getTitle(UserHistory $history): string
    {
        return Lang::get('history.add_reservation_title', [
            'name' => $history->data['name']
        ]);
    }

    public function getIcon(UserHistory $history): string
    {
        return 'x-heroicon-s-user-plus';
    }
}
