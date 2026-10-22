@extends('front.layouts.app')

@section('title', 'Page d’accueil - Signo')

@section('description')
    SIGNO, spécialiste de la signalétique, du conseil, des études et de la production en Tunisie depuis 1998.
@endsection

@section('content')

    @php
        $hero = $sections->get('hero');
        $history = $sections->get('history');
        $advice = $sections->get('advice');
        $studies = $sections->get('studies');
        $production = $sections->get('production');

        /*
        |--------------------------------------------------------------------------
        | Helpers
        |--------------------------------------------------------------------------
        */

        $getParagraphs = function ($section) {
            $paragraphs = $section?->paragraphs ?? [];

            if (is_string($paragraphs)) {
                $paragraphs = json_decode($paragraphs, true) ?? [];
            }

            return is_array($paragraphs) ? $paragraphs : [];
        };

        $getGallery = function ($section, array $defaults) {
            $gallery = $section?->gallery ?? [];

            if (is_string($gallery)) {
                $gallery = json_decode($gallery, true) ?? [];
            }

            if (!is_array($gallery)) {
                $gallery = [];
            }

            $gallery = array_values(array_filter($gallery));

            return count($gallery) ? $gallery : $defaults;
        };

        $getImageUrl = function ($path, $default) {
            if (empty($path)) {
                return asset($default);
            }

            if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
                return $path;
            }

            return   asset('storage-files/' . $path) ;
        };

        $getButtonUrl = function ($section) {
            $url = $section?->button_url;

            if (empty($url)) {
                return route('services');
            }

            if (\Illuminate\Support\Str::startsWith($url, [
                'http://',
                'https://',
                '/',
                '#',
                'mailto:',
                'tel:',
            ])) {
                return $url;
            }

            return url($url);
        };
    @endphp

    {{-- =========================================================
         HERO
    ========================================================= --}}

    <section
        aria-label="Signo, signalétique et communication visuelle"
        class="hero"
        style="background-image:url('{{ $getImageUrl($hero?->image, 'assets/images/hero.png') }}')"
    >
        <div class="hero-inner">

            <div class="hero-panel">

                <h1>
                    @if($hero?->title)
                        {!! nl2br(e($hero->title)) !!}
                    @else
                        Montrez-vous Sous<br>
                        Votre Meilleur Profil
                    @endif
                </h1>

                @if($hero?->subtitle)
                    <p>{{ $hero->subtitle }}</p>
                @else
                    @foreach($getParagraphs($hero) as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach

                    @if(empty($getParagraphs($hero)))
                        <p>
                            Avec plus de 25 ans de métier au service de l’image de marque
                            et la communication visuelle de nos clients, nous sommes
                            persuadés de pouvoir vous fournir des solutions à vos convenances
                        </p>
                    @endif
                @endif

                <a
                    class="hero-button"
                    href="{{ $getButtonUrl($hero) }}"
                >
                    {{ $hero?->button_text ?: 'NOS SERVICES' }}
                </a>

            </div>

        </div>

    </section>


    {{-- =========================================================
         HISTOIRE
    ========================================================= --}}

    <section class="intro">

        <div class="content-width">

            <div class="history-grid">

                <img
                    alt="{{ $history?->title ?: 'Enseigne SIGNO en relief' }}"
                    class="history-image"
                    loading="lazy"
                    src="{{ $getImageUrl($history?->image, 'assets/images/history.png') }}"
                >

                <div class="history-copy">

                    <h2 class="section-title">
                        {{ $history?->title ?: 'NOTRE HISTOIRE' }}
                    </h2>

                    @if($history?->subtitle)
                        <p>{{ $history->subtitle }}</p>
                    @endif

                    @forelse($getParagraphs($history) as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @empty
                        <p>
                            Bienvenue chez SIGNO, une entreprise familiale engagée de
                            longue date dans le domaine de la signalétique. Fondée en
                            1998 par la deuxième génération de la maison mère
                            Gravexpress, créée en 1968 par Slaheddine Brahem, pionnier
                            de la signalétique et de la fabrication de cachet tampon
                            après l’indépendance en Tunisie.
                        </p>

                        <p>
                            Forte de cette longue expérience et expertise dans le secteur,
                            SIGNO appuie son développement sur son savoir-faire interne
                            et les connaissances pointues de ses collaborateurs en
                            matière de conseil, d’étude, d’ingénierie, de design et de
                            fabrication pour répondre de façon optimale aux besoins de
                            ses clients, tant en Tunisie qu’à l’étranger.
                        </p>
                    @endforelse

                </div>

            </div>

            <h2 class="section-title services-title">
                {{ $advice?->title ? 'NOS SERVICES' : 'NOS SERVICES' }}
            </h2>

        </div>

    </section>


    {{-- =========================================================
         CONSEIL — GALERIE
    ========================================================= --}}

    <div
        aria-label="Conseil en signalétique"
        class="photo-strip two"
    >
        @foreach($getGallery($advice, [
            'assets/images/advice1.jpg',
            'assets/images/advice2.png',
        ]) as $image)
            <img
                alt="Conseil en signalétique"
                loading="lazy"
                src="{{ $getImageUrl($image, 'assets/images/advice1.jpg') }}"
            >
        @endforeach
    </div>


    {{-- =========================================================
         CONSEIL — CONTENU
    ========================================================= --}}

    <div class="service-copy">

        <div class="content-width service-grid">

            <h3>
                {{ $advice?->title ?: 'NOTRE CONSEIL :' }}
            </h3>

            <div class="service-body">

                @if($advice?->subtitle)
                    <p>{{ $advice->subtitle }}</p>
                @endif

                @forelse($getParagraphs($advice) as $paragraph)
                    <p>{{ $paragraph }}</p>
                @empty
                    <p>
                        Nous offrons un service d’assistance à nos clients à un stade
                        précoce de leur projet pour les aider à définir leurs besoins,
                        établir le recueil des exigences, distinguer les différents
                        lots signalétiques à considérer, autant le réglementaire que le
                        spécifique et à établir un budget prévisionnel. Cette approche
                        préalable permet de poser les bases de l’étude approfondie qui
                        suivra
                    </p>
                @endforelse

                <a
                    class="read-more"
                    href="{{ $getButtonUrl($advice) }}"
                >
                    {{ $advice?->button_text ?: 'LIRE PLUS ...' }}
                </a>

            </div>

        </div>

    </div>


    {{-- =========================================================
         ÉTUDES — GALERIE
    ========================================================= --}}

    <div
        aria-label="Études et conception"
        class="photo-strip four"
    >
        @foreach($getGallery($studies, [
            'assets/images/study1.jpg',
            'assets/images/study2.jpg',
            'assets/images/study3.jpg',
            'assets/images/study4.jpg',
        ]) as $image)
            <img
                alt="Études et conception"
                loading="lazy"
                src="{{ $getImageUrl($image, 'assets/images/study1.jpg') }}"
            >
        @endforeach
    </div>


    {{-- =========================================================
         ÉTUDES — CONTENU
    ========================================================= --}}

    <div class="service-copy">

        <div class="content-width service-grid">

            <h3>
                {{ $studies?->title ?: 'NOS ETUDES :' }}
            </h3>

            <div class="service-body">

                @if($studies?->quote)
                    <blockquote>
                        « {{ $studies->quote }} »

                        @if($studies->quote_author)
                            <br>
                            {{ $studies->quote_author }}
                        @endif
                    </blockquote>
                @else
                    <blockquote>
                        « Un expert est une personne qui a fait toutes les erreurs
                        qui peuvent être faites dans un champ étroit »
                        <br>
                        Niels Bohr, Physicien danois, prix Nobel
                    </blockquote>
                @endif

                @forelse($getParagraphs($studies) as $paragraph)
                    <p>{{ $paragraph }}</p>
                @empty
                    <p>
                        Le développement d’une étude signalétique, impose une approche
                        holistique couvrant plusieurs domaines de compétence, et se doit
                        de considérer toutes les fonctionnalités potentielles comme
                        l’identification, l’orientation, l’information, la communication,
                        l’esthétique et l’accessibilité, avec une maintenance aisée et
                        un cadre budgétaire maitrisé.
                    </p>
                @endforelse

                <a
                    class="read-more"
                    href="{{ $getButtonUrl($studies) }}"
                >
                    {{ $studies?->button_text ?: 'LIRE PLUS ...' }}
                </a>

            </div>

        </div>

    </div>


    {{-- =========================================================
         PRODUCTION — GALERIE
    ========================================================= --}}

    <div
        aria-label="Fabrication et production"
        class="photo-strip two"
    >
        @foreach($getGallery($production, [
            'assets/images/production1.jpg',
            'assets/images/production2.jpg',
        ]) as $image)
            <img
                alt="Fabrication et production"
                loading="lazy"
                src="{{ $getImageUrl($image, 'assets/images/production1.jpg') }}"
            >
        @endforeach
    </div>


    {{-- =========================================================
         PRODUCTION — CONTENU
    ========================================================= --}}

    <section class="production">

        <img
            alt="Technicien SIGNO chargé de la pose"
            loading="lazy"
            src="{{ $getImageUrl($production?->image, 'assets/images/production3.png') }}"
        >

        <div class="service-copy">

            <div class="service-grid">

                <h3>
                    {{ $production?->title ?: 'NOTRE PRODUCTION :' }}
                </h3>

                <div class="service-body">

                    @forelse($getParagraphs($production) as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @empty
                        <p>
                            Produire une enseigne devant être visible à 20 mètres de
                            hauteur ou une signalétique de proximité visible à moins
                            d’un mètre, présente des problématiques radicalement
                            différentes.
                        </p>

                        <p>
                            Dans le cas d’une signalétique « proximale », le souci du
                            détail et de la finition devient prépondérant, les modalités
                            de fixation doivent être les moins apparentes possible et
                            la qualité de fabrication optimale. On est plus dans une
                            approche « haute horlogerie » du produit.
                        </p>

                        <p>
                            Dans le cas d’une enseigne qui serait plutôt une signalétique
                            « distale », il y a moins de largeur créative, car c’est
                            souvent une reproduction rigoureuse d’un logotype. La
                            prépondérance est donnée aux contraintes techniques, comme
                            la prise au vent, l’atténuation du phénomène de résonance,
                            la résistance, la durabilité, l’accessibilité. On est dans
                            une logique hautement technique.
                        </p>
                    @endforelse

                    <a
                        class="read-more"
                        href="{{ $getButtonUrl($production) }}"
                    >
                        {{ $production?->button_text ?: 'LIRE PLUS ...' }}
                    </a>

                </div>

            </div>

        </div>

    </section>

@endsection
