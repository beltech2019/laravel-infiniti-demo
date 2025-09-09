<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Articles;

class ArticlesSeeder extends Seeder
{
    public function run(): void
    {
        Articles::insert([
            ['name' => 'Results', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'How To Play', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Permotions', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'News', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Our Retailer', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'FAQ', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Contact Us', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Responsible Gaming', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Privacy Policy', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cookie Policy', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tearms & Conditions', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
