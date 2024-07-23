<?php

namespace Database\Factories;

use App\Enums\AccomodationType;
use App\Enums\RoomTypePrice;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hotel = Hotel::inRandomOrder()->first();
        return [
            'hotel_id' => $hotel->id,
            'name' => rand(100,800),
            'number_place' => fake()->numberBetween(100,300),
            'max_person' => rand(1,6),
            'number_bed' => rand(1,5),
            'is_active' => rand(0,1),
            'accomodation_type' => AccomodationType::toArray()[rand(0, count(AccomodationType::toArray()) -1)],
            'accomodation_type_price' => RoomTypePrice::toArray()[rand(0, count(RoomTypePrice::toArray()) -1)],
            'description' =>  fake()->text(),
            'available_date_from' => (rand(0,1) == 1) ? fake()->date() : null,
            'available_date_to' => (rand(0,1) == 1) ? fake()->date() : null,
        ];
    }
}
