<?php

namespace Database\Factories;

use App\Enums\RolesType;
use App\Models\Reservation;
use App\Models\ReservationUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReservationUser>
 */
class ReservationUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->where('roles', RolesType::GUEST->value)->first();
        $reservation = Reservation::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'reservation_id' => $reservation->id,
            'main_guest' => ReservationUser::where('reservation_id', $reservation->id)->where('user_id', $user->id)->count() === 0,
        ];
    }
}
