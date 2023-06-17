<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jakub Owsianka',
            'email' => 'kurytplagain@gmail.com',
            'password' => Hash::make('kurytplagain@gmail.com')
        ]);

        PersonalAccessToken::create([
            'tokenable_type' => 'App\Models\User',
            'tokenable_id' => '5',
            'name' => '16825334205',
            'token' => 'c0c688e8f0b0cfe760948f86f34f25e58bfadc01734c75e41e7126d829930b83',
            'abilities' => '[*]'
        ]);

        $this->call(HotelSeeder::class);
        $this->call(RoomSeeder::class);

        User::factory()->count(100)->create();
    }
}
