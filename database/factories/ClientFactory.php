<?php

namespace Database\Factories;

use App\Enums\RolesType;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'nip' => fake()->numberBetween(10000000000,9999999999),
            'regon' => fake()->numberBetween(1000000000,999999999),
            'krs' => fake()->numberBetween(10000000000,9999999999),
            'address' => fake()->address(),
            'postal_code' => fake()->postcode(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'phone' => fake()->phoneNumber()
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Client $client){
            $user = $client->user;
            $user->update([
               'roles' => RolesType::CLIENT->value
            ]);
        });
    }
}
