<?php

namespace Database\Seeders;

use App\Models\ContactPageSetting;
use Illuminate\Database\Seeder;

class ContactPageSettingSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'key' => 'banner',
                'name' => 'Bannière',
                'title' => 'CONTACT',
                'image' => 'assets/images/footer.png',
                'sort_order' => 1,
            ],
            [
                'key' => 'address',
                'name' => 'Adresse',
                'title' => 'Nous trouver',
                'content' => "15 rue El Ifada\n2080 Ariana\nTunisie",
                'data' => [],
                'sort_order' => 2,
            ],
            [
                'key' => 'phones',
                'name' => 'Téléphones',
                'title' => 'Nous appeler',
                'data' => [
                    'phones' => [
                        [
                            'label' => '+216 70 730 491',
                            'value' => '+21670730491',
                        ],
                        [
                            'label' => '+216 70 730 485',
                            'value' => '+21670730485',
                        ],
                    ],
                ],
                'sort_order' => 3,
            ],
            [
                'key' => 'email',
                'name' => 'Email',
                'title' => 'Nous écrire',
                'content' => 'signo@signo.com.tn',
                'sort_order' => 4,
            ],
            [
                'key' => 'hours',
                'name' => 'Horaires',
                'title' => 'Nos horaires',
                'content' => "De lundi à vendredi\nde 8:00 à 12:30 et de 13:30 à 17:00\n\nSamedi & dimanche fermés",
                'sort_order' => 5,
            ],
            [
                'key' => 'map',
                'name' => 'Google Maps',
                'content' => 'https://www.google.com/maps?q=15%20rue%20El%20Ifada%2C%202080%20Ariana%2C%20Tunisie&output=embed',
                'sort_order' => 6,
            ],
            [
                'key' => 'form',
                'name' => 'Formulaire de contact',
                'title' => 'Envoyez-nous un message',
                'content' => "Une question, un projet ou besoin d'un conseil ? Contactez-nous.",
                'data' => [
                    'button_text' => 'Envoyer le message',
                ],
                'sort_order' => 7,
            ],
            [
                'key' => 'social',
                'name' => 'Réseaux sociaux',
                'data' => [
                    'facebook' => 'https://www.facebook.com/',
                    'pinterest' => 'https://www.pinterest.com/',
                    'instagram' => 'https://www.instagram.com/',
                    'whatsapp' => 'https://www.whatsapp.com/',
                ],
                'sort_order' => 8,
            ],
        ];

        foreach ($sections as $section) {
            ContactPageSetting::updateOrCreate(
                ['key' => $section['key']],
                $section
            );
        }
    }
}
