<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    public function run(): void
    {
        FAQ::insert([
            // english
            [
                'question' => 'How can I deposit cash in my wallet?',
                'lang' => 'en',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'How can I withdraw my wallet balance?',
                'lang' => 'en',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'What is the minimum and maximum deposit amount limit?',
                'lang' => 'en',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'What is the minimum and maximum withdrawal amount limit?',
                'lang' => 'en',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'What is an Instant Game?',
                'lang' => 'en',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Is mobile or email verification is necessary?',
                'lang' => 'en',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],


            // french
            [
                'question' => 'Comment puis-je déposer de l’argent dans mon portefeuille ?',
                'lang' => 'fr',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Comment puis-je retirer le solde de mon portefeuille ?',
                'lang' => 'fr',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Quel est le montant minimum et maximum de dépôt autorisé ?',
                'lang' => 'fr',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Quel est le montant minimum et maximum de retrait autorisé ?',
                'lang' => 'fr',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Qu’est-ce qu’un jeu instantané ?',
                'lang' => 'fr',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'La vérification par mobile ou par e-mail est-elle nécessaire ?',
                'lang' => 'fr',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // spanish
            [
                'question' => '¿Cómo puedo depositar dinero en mi billetera?',
                'lang' => 'es',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '¿Cómo puedo retirar el saldo de mi billetera?',
                'lang' => 'es',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '¿Cuál es el monto mínimo y máximo permitido para depositar?',
                'lang' => 'es',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '¿Cuál es el monto mínimo y máximo permitido para retirar?',
                'lang' => 'es',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '¿Qué es un juego instantáneo?',
                'lang' => 'es',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '¿Es necesaria la verificación por móvil o correo electrónico?',
                'lang' => 'es',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],


            // thai
            [
                'question' => 'ฉันจะฝากเงินเข้ากระเป๋าเงินของฉันได้อย่างไร?',
                'lang' => 'th',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'ฉันจะถอนยอดเงินจากกระเป๋าเงินของฉันได้อย่างไร?',
                'lang' => 'th',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'จำนวนเงินฝากขั้นต่ำและสูงสุดคือเท่าไร?',
                'lang' => 'th',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'จำนวนเงินถอนขั้นต่ำและสูงสุดคือเท่าไร?',
                'lang' => 'th',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'เกมทันใจคืออะไร?',
                'lang' => 'th',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'จำเป็นต้องยืนยันทางมือถือหรืออีเมลหรือไม่?',
                'lang' => 'th',
                'answer' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}
