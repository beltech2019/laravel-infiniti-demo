<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Games;

class GamesSeeder extends Seeder
{
    public function run(): void
    {
        Games::insert([
            ['name' => 'LOTTERY', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SPORTSPOOL', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'BINGO', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SPORTS BETTING', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'INSTANT GAMES', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SLOT', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CRAZY BILLIONS', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'GAME ART', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
