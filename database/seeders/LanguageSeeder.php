<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        Language::insert([
            ['name' => 'English', 'code' => 'en', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'French', 'code' => 'fr', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Spanish', 'code' => 'es', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Thai', 'code' => 'th', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
