@extends('front.layouts.app')

@section('title', 'Nos projets - Signo')

@section('description')
    Réalisations de SIGNO pour les banques, entreprises, hôtels, commerces, santé et résidences.
@endsection

@section('content')

    {{-- Bannière --}}
    <section
        class="news-banner"
        style="
        background-image:
            linear-gradient(var(--banner-shade), var(--banner-shade)),
            url('{{ asset('assets/images/footer.png') }}');
    "
    >
        <h1>NOS PROJETS</h1>
    </section>


    {{-- Projets --}}
    <section
        aria-labelledby="proj-heading"
        class="proj-content"
    >

        <div class="content-width">

            <h2
                class="section-title"
                id="proj-heading"
            >
                PARMI NOS CONCRÉTISATIONS
            </h2>


            <div class="proj-grid">

                @forelse ($projects as $project)

                    <article class="proj-category">

                        <button
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                            class="proj-category-toggle"
                            type="button"
                        >
                            <span class="proj-square"></span>

                            <span>
                {{ mb_strtoupper($project->title) }}
            </span>

                            <svg
                                aria-hidden="true"
                                class="proj-chevron {{ $loop->first ? 'is-open' : '' }}"
                                fill="none"
                                height="20"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                width="20"
                            >
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>


                        <div class="proj-category-list" @if (!$loop->first) hidden @endif>

                            @if (!empty($project->clients))

                                <ul>
                                    @foreach ($project->clients as $client)
                                        <li>{{ $client }}</li>
                                    @endforeach
                                </ul>

                            @endif

                        </div>


                        @if ($project->image)
                            <img
                                src="{{ asset('storage/' . $project->image) }}"
                                alt="Réalisation SIGNO — {{ $project->title }}"
                                class="proj-photo"
                                loading="lazy"
                            >
                        @endif

                    </article>

                @empty

                    <p>Aucun projet pour le moment.</p>

                @endforelse

            </div>


            <h2 class="section-title proj-client-heading">
                NOUS ONT FAIT CONFIANCE
            </h2>

        </div>

    </section>


    {{-- Clients --}}
    <div
        aria-label="Clients de SIGNO"
        class="proj-client-grid"
    >

        <img
            src="{{ asset('assets/images/client-01.png') }}"
            alt="ADP"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-02.png') }}"
            alt="Four Seasons"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-03.png') }}"
            alt="Agence Italienne pour la Coopération au Développement"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-04.png') }}"
            alt="Hilton"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-05.png') }}"
            alt="Carrefour"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-06.png') }}"
            alt="Peugeot"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-07.png') }}"
            alt="Tunisair"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-08.png') }}"
            alt="EY"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-09.png') }}"
            alt="European Investment Bank"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-10.png') }}"
            alt="Sheraton"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-11.png') }}"
            alt="Azur City"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-12.png') }}"
            alt="Anantara"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-13.png') }}"
            alt="BIAT"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-14.png') }}"
            alt="Radisson Blu"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-15.png') }}"
            alt="Roche"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-16.png') }}"
            alt="Rotary"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-17.png') }}"
            alt="ONU"
            loading="lazy"
        >

        <img
            src="{{ asset('assets/images/client-18.png') }}"
            alt="Pharmaghreb"
            loading="lazy"
        >

    </div>

@endsection
