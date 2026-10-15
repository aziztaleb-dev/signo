<?php

namespace Database\Seeders;

use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class ServicePageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'key' => 'banner',
                'name' => 'Bannière Nos services',
                'title' => 'NOS SERVICES',
                'image' => 'assets/images/footer.png',
                'sort_order' => 1,
            ],

            [
                'key' => 'advice_gallery',
                'name' => 'Galerie — Notre conseil',
                'gallery' => [
                    'assets/images/service-01.jpg',
                    'assets/images/service-02.png',
                ],
                'sort_order' => 2,
            ],

            [
                'key' => 'advice',
                'name' => 'Notre conseil',
                'title' => 'NOTRE CONSEIL :',
                'paragraphs' => [
                    'Nous offrons un service d’assistance à nos clients à un stade précoce de leur projet pour les aider à définir leurs besoins, établir le recueil des exigences, distinguer les différents lots signalétiques à considérer, autant le réglementaire que le spécifique et à établir un budget prévisionnel. Cette approche préalable permet de poser les bases de l’étude approfondie qui suivra.',
                    'Notre service de conseil en signalétique vous aidera à réaliser votre projet dans les meilleures conditions et à obtenir les résultats escomptés dans les délais prévus.',
                ],
                'sort_order' => 3,
            ],

            [
                'key' => 'studies_gallery_top',
                'name' => 'Galerie — Études et design (haut)',
                'gallery' => [
                    'assets/images/service-03.jpg',
                    'assets/images/service-04.jpg',
                ],
                'sort_order' => 4,
            ],

            [
                'key' => 'studies_gallery_bottom',
                'name' => 'Galerie — Études et design (bas)',
                'gallery' => [
                    'assets/images/service-05.jpg',
                    'assets/images/service-06.jpg',
                ],
                'sort_order' => 5,
            ],

            [
                'key' => 'studies',
                'name' => 'Nos études',
                'title' => 'NOS ÉTUDES :',
                'quote' => '« Un expert est une personne qui a fait toutes les erreurs qui peuvent être faites dans un champ étroit »',
                'quote_author' => 'Niels Bohr, Physicien danois, prix Nobel',
                'paragraphs' => [
                    'Le développement d’une étude signalétique impose une approche holistique couvrant plusieurs domaines de compétence. Il se doit de considérer toutes les fonctionnalités potentielles comme l’identification, l’orientation, l’information, la communication, l’esthétique et l’accessibilité, avec une maintenance aisée et un cadre budgétaire maîtrisé.',
                    'La vision de SIGNO se distingue des approches fonctionnalistes traditionnelles de la conception de la signalétique, qui tendent à limiter le potentiel des objets design à des principes d’efficacité. Nous sommes convaincus que le design signalétique peut contribuer à l’intelligibilité des lieux, et donc à la mise en relation des différentes parties d’un environnement.',
                    'Dans ce contexte, SIGNO intègre dans ses études, selon les spécifications du projet, les composantes suivantes :',
                ],
                'items' => [
                    [
                        'title' => 'Analyse du site et inventaire des besoins :',
                        'text' => 'prise en compte des contraintes architecturales, évaluation des modalités d’éclairage, des angles et distances de vision, de l’accessibilité et de la gestion des flux circulatoires, mise en évidence des points clés du site et identification des exigences de sécurité et de réglementation.',
                    ],
                    [
                        'title' => 'Harmonisation et établissement du cadre graphique :',
                        'text' => 'choix linguistique, typographie, iconographie, colorimétrie et dimensionnement.',
                    ],
                    [
                        'title' => 'Plans d’implantation et typage signalétique :',
                        'text' => 'localisation et catégorisation : signalétique autoportante, murale, pendulaire, étendard, scellée au sol, etc.',
                    ],
                    [
                        'title' => 'Spécification des matériaux :',
                        'text' => 'prise en compte des données environnementales (extérieur, intérieur, balnéaire, industriel, désertique), du vandalisme potentiel, de la facilité d’entretien et des matériaux recyclables à faible impact environnemental lors de leur transformation.',
                    ],
                    [
                        'title' => 'Concept design :',
                        'text' => 'rendus graphiques 2D et 3D avec mise en contexte permettant à nos clients une visualisation réaliste du concept. Nos travaux s’appuient sur une logithèque fournie et, dans le processus créatif, nous pouvons faire appel à des IA et au conseil d’experts en interface utilisateur. Remise d’un prototype à échelle réelle si nécessaire.',
                    ],
                    [
                        'title' => 'Maintenance et suivi :',
                        'text' => 'stratégie de maintenance et de suivi garantissant la durabilité de la signalétique, la conformité aux normes et aux réglementations, ainsi que les possibilités de mise à jour en cas de changement.',
                    ],
                ],
                'sort_order' => 6,
            ],

            [
                'key' => 'production_gallery',
                'name' => 'Galerie — Fabrication et installation',
                'gallery' => [
                    'assets/images/service-07.jpg',
                    'assets/images/service-08.jpg',
                ],
                'sort_order' => 7,
            ],

            [
                'key' => 'production',
                'name' => 'Notre production',
                'title' => 'NOTRE PRODUCTION :',
                'image' => 'assets/images/production3.png',
                'paragraphs' => [
                    'Produire une enseigne devant être visible à 20 mètres de hauteur ou une signalétique de proximité visible à moins d’un mètre présente des problématiques radicalement différentes. Dans le cas d’une signalétique « proximale », le souci du détail et de la finition devient prépondérant, les modalités de fixation doivent être les moins apparentes possible et la qualité de grande précision. On est plus dans une approche « haute horlogerie » du produit.',
                    'Dans le cas d’une enseigne qui serait plutôt une signalétique « distale », il y a moins de largeur créative, car c’est souvent une reproduction rigoureuse d’un logotype. La prépondérance est donnée aux contraintes techniques, comme la prise au vent, l’atténuation du phénomène de résonance, la résistance, la durabilité et l’accessibilité. On est dans une logique hautement technique.',
                    'Pour mener à bien cette tâche, SIGNO s’est dotée d’un parc machines de pointe et d’une équipe de techniciens qualifiés dont certains ont plus de vingt années d’ancienneté au sein de l’entreprise.',
                    'Nous avons investi dans des équipements de dernière génération pour assurer une qualité de production supérieure, rapide et efficace.',
                ],
                'sort_order' => 8,
            ],
        ];

        foreach ($sections as $section) {
            ServicePageSection::updateOrCreate(
                ['key' => $section['key']],
                array_merge(
                    $section,
                    ['is_active' => true]
                )
            );
        }
    }
}
