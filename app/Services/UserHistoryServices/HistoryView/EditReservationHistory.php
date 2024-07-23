<?php

namespace App\Services\UserHistoryServices\HistoryView;

use App\Models\UserHistory;
use App\Services\UserHistoryServices\Abstract\HistoryAction;
use App\Services\UserHistoryServices\Interfaces\HistoryActionInterface;
use Illuminate\Support\Facades\Lang;

final class EditReservationHistory extends HistoryAction implements HistoryActionInterface
{

    public function getInformation(UserHistory $history): string
    {
        return Lang::get('history.edit_reservation_title', [
            'name' => $history->data['new']['name']
        ]);
    }

    public function getDetails(UserHistory $history): string
    {
        $data = $history->data;
        $output = '<strong class="text-primary-500">URL:</strong> ' . $this->URL('filament.resources.reservations.edit', $history->data['new']['id']);
        $output .= '<table class="filament-tables-table w-full text-start divide-y table-auto">';
        unset($data['changed']['updated_at']);

        $output .= '<tr>';
        $output .= '<th class="text-left">' . Lang::get('history.what_was_changed') . '</th>';
        $output .= '<th class="text-right">' . Lang::get('history.last') . '</th>';
        $output .= '<th class="text-right">' . Lang::get('history.actual') . '</th>';
        $output .= '</tr>';
        foreach ($data['changed'] as $key => $value) {

            if ($key == 'check_in' || $key == 'check_out') {
                $value = date('d-m-Y', strtotime($value));
                $data['old'][$key] = date('d-m-Y', strtotime($data['old'][$key]));
            } else if ($key == 'can_use_wallet'
                || $key == 'cost_breakdown'
                || $key == 'paid_reservation'
                || $key == 'purchase_by_other_guests') {
                $value = $value == 1 ? Lang::get('reservation.yes') : Lang::get('reservation.no');
                $data['old'][$key] = $data['old'][$key] == 1 ? Lang::get('reservation.yes') : Lang::get('reservation.no');
            }

            $output .= '<tr>';
            $output .= '<td>' . Lang::get('reservation.' . $key) . '</td>';
            $output .= '<td class="text-right bg-gray-500/5">' . $data['old'][$key] . '</td>';
            $output .= '<td class="text-right bg-gray-500/5">' . $value . '</td>';
            $output .= '</tr>';
        }
        $output .= '</table>';
        return $output;
//        return Lang::get('history.edit_reservation');
    }

    public function getTitle(UserHistory $history): string
    {
        return Lang::get('history.edit_reservation_title', [
            'name' => $history->data['new']['name']
        ]);
    }

    public function getIcon(UserHistory $history): string
    {
        return 'x-heroicon-s-pencil-square';
    }
}
