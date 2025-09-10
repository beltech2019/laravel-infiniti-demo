<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(GameArtSeeder::class);
        $this->call(SlotGamesSeeder::class);
        $this->call(ArticlesSeeder::class);
        $this->call(BannersSeeder::class);
        $this->call(FAQSeeder::class);
        $this->call(GamesSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(LinksContentSeeder::class);
    }
}
