<?php

namespace Database\Seeders;

use App\Models\ReservationUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReservationUser::factory()->count(60)->create();
    }
}
