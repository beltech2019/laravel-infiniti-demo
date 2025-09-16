<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LinksContent;
    
class LinksContentSeederSecond extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
                        // COOKIE POLICY
            ['key' => 'COOKIE_POLICY','value' => 'Cookie Policy','lang' => 'en','data' => '<p>English Cookie Policy content...</p>'],
            ['key' => 'COOKIE_POLICY','value' => 'Politique de Cookies','lang' => 'fr','data' => '<p>Contenu de la politique française en matière de cookies...</p>'],
            ['key' => 'COOKIE_POLICY','value' => 'Política de Cookies','lang' => 'es','data' => '<p>Contenido de la Política de Cookies en español...</p>'],
            ['key' => 'COOKIE_POLICY','value' => 'นโยบายคุกกี้','lang' => 'th','data' => '<p>เนื้อหานโยบายคุกกี้ของไทย...</p>'],

            // HOW TO PLAY
            ['key' => 'HOW_TO_PLAY','value' => 'How to Play','lang' => 'en','data' => '<p>English How to Play content...</p>'],
            ['key' => 'HOW_TO_PLAY','value' => 'Comment Jouer','lang' => 'fr','data' => '<p>Contenu de la section « Comment jouer »...</p>'],
            ['key' => 'HOW_TO_PLAY','value' => 'Cómo Jugar','lang' => 'es','data' => '<p>Española como jugar contenido...</p>'],
            ['key' => 'HOW_TO_PLAY','value' => 'วิธีการเล่น','lang' => 'th','data' => '<p>เนื้อหาวิธีการเล่นภาษาไทย...</p>'],

            // NEWS
            ['key' => 'NEWS','value' => 'News','lang' => 'en','data' => '<p>English News content...</p>'],
            ['key' => 'NEWS','value' => 'Actualités','lang' => 'fr','data' => '<p>Contenu dactualité en français...</p>'],
            ['key' => 'NEWS','value' => 'Noticias','lang' => 'es','data' => '<p>Contenido de noticias en español...</p>'],
            ['key' => 'NEWS','value' => 'ข่าวสาร','lang' => 'th','data' => '<p>เนื้อหาข่าวไทย...</p>'],

            // OUR RETAILERS
            ['key' => 'OUR_RETAILERS','value' => 'Our Retailers','lang' => 'en','data' => '<p>English Our Retailers content...</p>'],
            ['key' => 'OUR_RETAILERS','value' => 'Nos Revendeurs','lang' => 'fr','data' => '<p>Contenu de nos détaillants...</p>'],
            ['key' => 'OUR_RETAILERS','value' => 'Nuestros Minoristas','lang' => 'es','data' => '<p>Contenido de nuestros minoristas...</p>'],
            ['key' => 'OUR_RETAILERS','value' => 'ผู้ค้าปลีกของเรา','lang' => 'th','data' => '<p>เนื้อหาผู้ค้าปลีกของเรา...</p>'],

            // PROMOTIONS
            ['key' => 'PROMOTIONS','value' => 'Promotions','lang' => 'en','data' => '<p>English Promotions content...</p>'],
            ['key' => 'PROMOTIONS','value' => 'Promotions','lang' => 'fr','data' => '<p>Contenu des promotions en français...</p>'],
            ['key' => 'PROMOTIONS','value' => 'Promociones','lang' => 'es','data' => '<p>Contenido de promociones en español....</p>'],
            ['key' => 'PROMOTIONS','value' => 'โปรโมชั่น','lang' => 'th','data' => '<p>เนื้อหาโปรโมชั่นไทย...</p>'],

            // RESULTS
            ['key' => 'RESULTS','value' => 'Results','lang' => 'en','data' => '<p>English Results content...</p>'],
            ['key' => 'RESULTS','value' => 'Résultats','lang' => 'fr','data' => '<p>Contenu des résultats en français...</p>'],
            ['key' => 'RESULTS','value' => 'Resultados','lang' => 'es','data' => '<p>Contenido de resultados en español...</p>'],
            ['key' => 'RESULTS','value' => 'ผลลัพธ์','lang' => 'th','data' => '<p>เนื้อหาผลลัพธ์ภาษาไทย...</p>'],

        ];

        foreach ($links as $link) {
            LinksContent::Create([
                'key' => $link['key'],
                'value' => $link['value'],
                'lang' => $link['lang'],
                'data' => $link['data']
            ]);
        }
    }
}
