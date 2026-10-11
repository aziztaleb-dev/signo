@extends('front.layouts.app')

@section('title', 'Nos services — Signo')

@section('description')
    Conseil, études, design, fabrication et pose de signalétique SIGNO.
@endsection

@section('content')

    {{-- Bannière Nos services --}}
    <section
        class="news-banner services-banner"
        style="background-image: linear-gradient(var(--banner-shade), var(--banner-shade)), url('{{ asset('assets/images/footer.png') }}')"
    >
        <h1>NOS SERVICES</h1>
    </section>


    {{-- Conseil et préparation du projet --}}
    <div
        class="services-photos services-photos-bordered"
        aria-label="Conseil et préparation du projet"
    >

        <img
            src="{{ asset('assets/images/service-01.jpg') }}"
            alt="Conseil et préparation du projet — 1"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/service-02.png') }}"
            alt="Conseil et préparation du projet — 2"
            loading="lazy"
        >

    </div>


    {{-- Notre conseil --}}
    <section class="services-detail services-advice">

        <div class="content-width services-detail-grid">

            <h2>
                NOTRE CONSEIL :
            </h2>


            <div>

                <p>
                    Nous offrons un service d’assistance à nos clients à un stade
                    précoce de leur projet pour les aider à définir leurs besoins,
                    établir le recueil des exigences, distinguer les différents
                    lots signalétiques à considérer, autant le réglementaire que
                    le spécifique et à établir un budget prévisionnel. Cette
                    approche préalable permet de poser les bases de l’étude
                    approfondie qui suivra.
                </p>


                <p>
                    Notre service de conseil en signalétique vous aidera à réaliser
                    votre projet dans les meilleures conditions et à obtenir les
                    résultats escomptés dans les délais prévus.
                </p>

            </div>

        </div>

    </section>


    {{-- Études et design : première série de photos --}}
    <div
        class="services-photos services-photos-top"
        aria-label="Études et design signalétique"
    >

        <img
            src="{{ asset('assets/images/service-03.jpg') }}"
            alt="Études et design signalétique — 1"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/service-04.jpg') }}"
            alt="Études et design signalétique — 2"
            loading="lazy"
        >

    </div>


    {{-- Études et design : deuxième série de photos --}}
    <div
        class="services-photos services-photos-bottom"
        aria-label="Machines de découpe et gravure"
    >

        <img
            src="{{ asset('assets/images/service-05.jpg') }}"
            alt="Machines de découpe et gravure — 1"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/service-06.jpg') }}"
            alt="Machines de découpe et gravure — 2"
            loading="lazy"
        >

    </div>


    {{-- Nos études --}}
    <section class="services-detail services-studies">

        <div class="content-width services-detail-grid">

            <h2>
                NOS ÉTUDES :
            </h2>


            <div>

                <blockquote>
                    « Un expert est une personne qui a fait toutes les erreurs
                    qui peuvent être faites dans un champ étroit »
                    <br>

                    <strong>
                        <em>
                            Niels Bohr, Physicien danois, prix Nobel
                        </em>
                    </strong>
                </blockquote>


                <p>
                    Le développement d’une étude signalétique impose une approche
                    holistique couvrant plusieurs domaines de compétence. Il se
                    doit de considérer toutes les fonctionnalités potentielles
                    comme l’identification, l’orientation, l’information, la
                    communication, l’esthétique et l’accessibilité, avec une
                    maintenance aisée et un cadre budgétaire maîtrisé.
                </p>


                <p>
                    La vision de SIGNO se distingue des approches fonctionnalistes
                    traditionnelles de la conception de la signalétique, qui
                    tendent à limiter le potentiel des objets design à des
                    principes d’efficacité. Nous sommes convaincus que le design
                    signalétique peut contribuer à l’intelligibilité des lieux,
                    et donc à la mise en relation des différentes parties d’un
                    environnement.
                </p>


                <p>
                    Dans ce contexte, SIGNO intègre dans ses études, selon les
                    spécifications du projet, les composantes suivantes :
                </p>


                <ul>

                    <li>
                        <strong>Analyse du site et inventaire des besoins :</strong>
                        prise en compte des contraintes architecturales,
                        évaluation des modalités d’éclairage, des angles et
                        distances de vision, de l’accessibilité et de la gestion
                        des flux circulatoires, mise en évidence des points clés
                        du site et identification des exigences de sécurité et
                        de réglementation.
                    </li>


                    <li>
                        <strong>
                            Harmonisation et établissement du cadre graphique :
                        </strong>
                        choix linguistique, typographie, iconographie,
                        colorimétrie et dimensionnement.
                    </li>


                    <li>
                        <strong>
                            Plans d’implantation et typage signalétique :
                        </strong>
                        localisation et catégorisation : signalétique
                        autoportante, murale, pendulaire, étendard, scellée au
                        sol, etc.
                    </li>


                    <li>
                        <strong>Spécification des matériaux :</strong>
                        prise en compte des données environnementales
                        (extérieur, intérieur, balnéaire, industriel, désertique),
                        du vandalisme potentiel, de la facilité d’entretien et
                        des matériaux recyclables à faible impact environnemental
                        lors de leur transformation.
                    </li>


                    <li>
                        <strong>Concept design :</strong>
                        rendus graphiques 2D et 3D avec mise en contexte
                        permettant à nos clients une visualisation réaliste du
                        concept. Nos travaux s’appuient sur une logithèque
                        fournie et, dans le processus créatif, nous pouvons
                        faire appel à des IA et au conseil d’experts en interface
                        utilisateur. Remise d’un prototype à échelle réelle si
                        nécessaire.
                    </li>


                    <li>
                        <strong>Maintenance et suivi :</strong>
                        stratégie de maintenance et de suivi garantissant la
                        durabilité de la signalétique, la conformité aux normes
                        et aux réglementations, ainsi que les possibilités de
                        mise à jour en cas de changement.
                    </li>

                </ul>

            </div>

        </div>

    </section>


    {{-- Fabrication, installation et éclairage --}}
    <div
        class="services-photos services-photos-bordered"
        aria-label="Fabrication, installation et éclairage"
    >

        <img
            src="{{ asset('assets/images/service-07.jpg') }}"
            alt="Fabrication, installation et éclairage — 1"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/service-08.jpg') }}"
            alt="Fabrication, installation et éclairage — 2"
            loading="lazy"
        >

    </div>


    {{-- Notre production --}}
    <section class="services-production">

        <img
            src="{{ asset('assets/images/production3.png') }}"
            alt="Technicien SIGNO équipé pour la pose"
            loading="lazy"
        >


        <div class="services-production-copy">

            <h2>
                NOTRE PRODUCTION :
            </h2>


            <p>
                Produire une enseigne devant être visible à 20 mètres de hauteur
                ou une signalétique de proximité visible à moins d’un mètre
                présente des problématiques radicalement différentes. Dans le
                cas d’une signalétique « proximale », le souci du détail et de
                la finition devient prépondérant, les modalités de fixation
                doivent être les moins apparentes possible et la qualité de
                grande précision. On est plus dans une approche « haute
                horlogerie » du produit.
            </p>


            <p>
                Dans le cas d’une enseigne qui serait plutôt une signalétique
                « distale », il y a moins de largeur créative, car c’est souvent
                une reproduction rigoureuse d’un logotype. La prépondérance est
                donnée aux contraintes techniques, comme la prise au vent,
                l’atténuation du phénomène de résonance, la résistance, la
                durabilité et l’accessibilité. On est dans une logique hautement
                technique.
            </p>


            <p>
                Pour mener à bien cette tâche, SIGNO s’est dotée d’un parc
                machines de pointe et d’une équipe de techniciens qualifiés
                dont certains ont plus de vingt années d’ancienneté au sein de
                l’entreprise.
            </p>


            <p>
                Nous avons investi dans des équipements de dernière génération
                pour assurer une qualité de production supérieure, rapide et
                efficace.
            </p>

        </div>

    </section>
@endsection
