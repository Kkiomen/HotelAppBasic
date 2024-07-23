<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hotel = Hotel::inRandomOrder()->first();
        $startingDate = fake()->dateTimeThisYear('+1 month');
        $endingDate   = strtotime('+'. rand(1,7) .' days', $startingDate->getTimestamp());

        return [
            'name' => 'Reservation ' . fake()->name(),
            'hotel_id' => $hotel->id,
            'check_in' => $startingDate,
            'check_out' => date('Y-m-d H:i:s', $endingDate),
            'description' => fake()->realText(),
            'total_basic_price' => fake()->randomFloat(2,0,9000),
            'number_adult' => rand(1,5),
            'number_child' => rand(1,5),
            'room_preference' => fake()->realText(),
            'paid_reservation' => rand(0,1),
            'can_use_wallet' => rand(0,1),
            'can_pay_by_wallet' => rand(0,1),
            'wallet_balance' => fake()->randomFloat(2,0,9000),
            'cost_breakdown' => rand(0,1),
            'purchase_by_other_guests' => rand(0,1),
            'wallet_limit' => fake()->randomFloat(2,0,9000),
            'wallet_hard_limit' => fake()->randomFloat(2,0,9000),
            'is_active' => rand(0,1),
            'status' => rand(0,7),
            'name_reservation_person' => fake()->name(),
            'nip' => fake()->numberBetween(10000000000,9999999999),
            'regon' => fake()->numberBetween(1000000000,999999999),
            'krs' => fake()->numberBetween(10000000000,9999999999),
            'address' => fake()->address(),
            'postal_code' => fake()->postcode(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email
        ];
    }
}
