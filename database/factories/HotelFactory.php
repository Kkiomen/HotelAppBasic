<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Hotel;
use App\Models\HotelUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client = Client::factory()->create();

        return [
            'client_id' => $client->id,
            'name' => fake()->unique()->company(),
            'nip' => fake()->numberBetween(10000000000,9999999999),
            'regon' => fake()->numberBetween(1000000000,999999999),
            'krs' => fake()->numberBetween(10000000000,9999999999),
            'address' => fake()->address(),
            'postal_code' => fake()->postcode(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Hotel $hotel){
            $userId = $hotel->client->user->id;
            $hotelId = $hotel->id;
            HotelUser::create([
               'hotel_id' => $hotelId,
               'user_id' => $userId
            ]);
        });
    }

}
