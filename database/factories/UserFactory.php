<?php

namespace Database\Factories;

use App\Enums\RolesType;
use App\Models\Client;
use App\Models\Hotel;
use App\Models\HotelUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        do{
            $roles = RolesType::toArray()[rand(0, count(RolesType::toArray()) -1)];
        }while(in_array($roles, [RolesType::ADMINISTRATOR->value, RolesType::CLIENT->value, RolesType::USER->value]));

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'roles' => $roles,
            'address' => fake()->address(),
            'postal_code' => fake()->postcode(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'phone' => fake()->phoneNumber()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user){

            if(in_array($user->roles, [RolesType::EMPLOYEE->value, RolesType::GUEST->value])){
                $hotel = Hotel::inRandomOrder()->first();
                if($hotel){
                    HotelUser::create([
                        'hotel_id' => $hotel->id,
                        'user_id' => $user->id
                    ]);
                }
            }
        });
    }
}
