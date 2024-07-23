<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReservationRoom>
 */
class ReservationRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hotel = Hotel::inRandomOrder()->first();
        $reservation = Reservation::inRandomOrder()->where('hotel_id', $hotel->id)->first();
        $room = Room::inRandomOrder()->where('hotel_id', $hotel->id)->first();
        if(!$room){
            $room = Room::inRandomOrder()->first();
        }
        return [
            'reservation_id' => $reservation->id,
            'room_id' => $room->id,
            'room_number_place' => $room->number_place,
            'hotel_id' => $hotel->id
        ];
    }
}
