@extends('front.layouts.app')


@section('title', 'Page d’accueil - Signo')


@section('description')
    SIGNO, spécialiste de la signalétique, du conseil, des études et de la production en Tunisie depuis 1998.
@endsection


@section('content')


    <section
        aria-label="Signo, signalétique et communication visuelle"
        class="hero"
        style="background-image:url('{{ asset('assets/images/hero.png') }}')"
    >

        <div class="hero-inner">

            <div class="hero-panel">

                <h1>
                    Montrez-vous Sous<br>
                    Votre Meilleur Profil
                </h1>

                <p>
                    Avec plus de 25 ans de métier au service de l’image de marque
                    et la communication visuelle de nos clients, nous sommes
                    persuadés de pouvoir vous fournir des solutions à vos convenances
                </p>

                <a
                    class="hero-button"
                    href="{{ route('services') }}"
                >
                    NOS SERVICES
                </a>

            </div>

        </div>

    </section>


    <section class="intro">

        <div class="content-width">

            <div class="history-grid">

                <img
                    alt="Enseigne SIGNO en relief"
                    class="history-image"
                    src="{{ asset('assets/images/history.png') }}"
                >


                <div class="history-copy">

                    <h2 class="section-title">
                        NOTRE HISTOIRE
                    </h2>

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

                </div>

            </div>


            <h2 class="section-title services-title">
                NOS SERVICES
            </h2>

        </div>

    </section>


    <div
        aria-label="Conseil en signalétique"
        class="photo-strip two"
    >

        <img
            alt="Conseil en signalétique — photo 1"
            loading="lazy"
            src="{{ asset('assets/images/advice1.jpg') }}"
        >

        <img
            alt="Conseil en signalétique — photo 2"
            loading="lazy"
            src="{{ asset('assets/images/advice2.png') }}"
        >

    </div>


    <div class="service-copy">

        <div class="content-width service-grid">

            <h3>
                NOTRE CONSEIL :
            </h3>


            <div class="service-body">

                <p>
                    Nous offrons un service d’assistance à nos clients à un stade
                    précoce de leur projet pour les aider à définir leurs besoins,
                    établir le recueil des exigences, distinguer les différents
                    lots signalétiques à considérer, autant le réglementaire que le
                    spécifique et à établir un budget prévisionnel. Cette approche
                    préalable permet de poser les bases de l’étude approfondie qui
                    suivra
                </p>


                <a
                    class="read-more"
                    href="{{ route('services') }}"
                >
                    LIRE PLUS ...
                </a>

            </div>

        </div>

    </div>


    <div
        aria-label="Études et conception"
        class="photo-strip four"
    >

        <img
            alt="Études et conception — photo 1"
            loading="lazy"
            src="{{ asset('assets/images/study1.jpg') }}"
        >

        <img
            alt="Études et conception — photo 2"
            loading="lazy"
            src="{{ asset('assets/images/study2.jpg') }}"
        >

        <img
            alt="Études et conception — photo 3"
            loading="lazy"
            src="{{ asset('assets/images/study3.jpg') }}"
        >

        <img
            alt="Études et conception — photo 4"
            loading="lazy"
            src="{{ asset('assets/images/study4.jpg') }}"
        >

    </div>


    <div class="service-copy">

        <div class="content-width service-grid">

            <h3>
                NOS ETUDES :
            </h3>


            <div class="service-body">

                <blockquote>
                    « Un expert est une personne qui a fait toutes les erreurs
                    qui peuvent être faites dans un champ étroit »
                    <br>
                    Niels Bohr, Physicien danois, prix Nobel
                </blockquote>


                <p>
                    Le développement d’une étude signalétique, impose une approche
                    holistique couvrant plusieurs domaines de compétence, et se doit
                    de considérer toutes les fonctionnalités potentielles comme
                    l’identification, l’orientation, l’information, la communication,
                    l’esthétique et l’accessibilité, avec une maintenance aisée et
                    un cadre budgétaire maitrisé.
                </p>


                <a
                    class="read-more"
                    href="{{ route('services') }}"
                >
                    LIRE PLUS ...
                </a>

            </div>

        </div>

    </div>


    <div
        aria-label="Fabrication et production"
        class="photo-strip two"
    >

        <img
            alt="Fabrication et production — photo 1"
            loading="lazy"
            src="{{ asset('assets/images/production1.jpg') }}"
        >

        <img
            alt="Fabrication et production — photo 2"
            loading="lazy"
            src="{{ asset('assets/images/production2.jpg') }}"
        >

    </div>


    <section class="production">

        <img
            alt="Technicien SIGNO chargé de la pose"
            loading="lazy"
            src="{{ asset('assets/images/production3.png') }}"
        >


        <div class="service-copy">

            <div class="service-grid">

                <h3>
                    NOTRE PRODUCTION :
                </h3>


                <div class="service-body">

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


                    <a
                        class="read-more"
                        href="{{ route('services') }}"
                    >
                        LIRE PLUS ...
                    </a>

                </div>

            </div>

        </div>

    </section>


@endsection
