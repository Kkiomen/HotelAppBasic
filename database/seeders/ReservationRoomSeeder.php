<?php

namespace Database\Seeders;

use App\Models\ReservationRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReservationRoom::factory()->count(500)->create();
    }
}
