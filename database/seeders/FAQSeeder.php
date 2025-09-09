<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    public function run(): void
    {
        FAQ::insert([
            [
                'question' => 'How can I deposit cash in my wallet?',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'How can I withdraw my wallet balance?',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'What is the minimum and maximum deposit amount limit?',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'What is the minimum and maximum withdrawal amount limit?',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'What is an Instant Game?',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Is mobile or email verification is necessary?',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
