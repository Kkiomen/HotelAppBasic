<?php

namespace App\Services\UserHistoryServices\Enums;

use App\Models\UserHistory;
use App\Services\UserHistoryServices\HistoryView\AddReservationHistory;
use App\Services\UserHistoryServices\HistoryView\AddReservationRoomHistory;
use App\Services\UserHistoryServices\HistoryView\DeleteReservationRoomHistory;
use App\Services\UserHistoryServices\HistoryView\EditReservationHistory;
use App\Services\UserHistoryServices\Interfaces\HistoryActionInterface;

enum HistoryActionEnum: string
{
    case ADD_RESERVATION = 'add_reservation';
    case EDIT_RESERVATION = 'edit_reservation';
    case ADD_RESERVATION_ROOM = 'add_reservation_room';
    case EDIT_RESERVATION_ROOM = 'edit_reservation_room';
    case DELETE_RESERVATION_ROOM = 'delete_reservation_room';

    public function getInformation(UserHistory $history): string
    {
        $class = $this->getClass();
        if(is_null($class)) return '';
        return $class->getInformation($history);
    }

    public function getTitle(UserHistory $history): string
    {
        $class = $this->getClass();
        if(is_null($class)) return '';
        return $class->getTitle($history);
    }

    public function getDetails(UserHistory $history): string
    {
        $class = $this->getClass();
        if(is_null($class)) return '';

        return $class->getDetails($history);
    }

    public function getIcon(UserHistory $history): string
    {
        $class = $this->getClass();
        if(is_null($class)) return '';
        return $class->getIcon($history);
    }

    private function getClass(): ?HistoryActionInterface
    {
        return match($this->value) {
            self::ADD_RESERVATION->value => new AddReservationHistory(),
            self::EDIT_RESERVATION->value => new EditReservationHistory(),
            self::ADD_RESERVATION_ROOM->value => new AddReservationRoomHistory(),
            self::DELETE_RESERVATION_ROOM->value => new DeleteReservationRoomHistory(),
            default => null,
        };
    }
}
