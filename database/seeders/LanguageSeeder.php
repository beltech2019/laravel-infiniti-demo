<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        Language::insert([
            ['name' => 'English', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'French', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'German', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Thai', 'publish' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
