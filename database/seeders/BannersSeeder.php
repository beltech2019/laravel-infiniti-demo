<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banners;

class BannersSeeder extends Seeder
{
    public function run(): void
    {
        Banners::insert([
            [
                'name' => 'Logo',
                'type' => 'png',
                'path' => '/images/infinity.png',
                'location' => 'Common',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Main Banner',
                'type' => 'jpg',
                'path' => '/images/homepage-banners/banner01.jpg',
                'location' => 'Homepage',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Main Banner of Register Page',
                'type' => 'jpg',
                'path' => '/images/misc/dummyLeftBanner.jpg',
                'location' => 'Register',
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'Lottery Logo',
                'type' => 'png',
                'path' => '/images/game-icons/games-draw.png',
                'location' => 'Homepage',
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'SportsPool Logo',
                'type' => 'png',
                'path' => '/images/game-icons/games-sportsLottery.png',
                'location' => 'Homepage',
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'Instant Games Logo',
                'type' => 'png',
                'path' => '/images/game-icons/games-instant.png',
                'location' => 'Homepage',
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'Bingo Logo',
                'type' => 'png',
                'path' => '/images/game-icons/game-bingo.png',
                'location' => 'Homepage',
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'Slot Logo',
                'type' => 'png',
                'path' => '/images/game-icons/games-slot.png',
                'location' => 'Homepage',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
