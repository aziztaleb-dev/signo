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
                                src="{{ asset('storage-files/' . $project->image) }}"
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
    <div aria-label="Clients de SIGNO" class="proj-client-grid">

        @foreach ($clientLogos as $clientLogo)
            <img
                src="{{ str_starts_with($clientLogo->image, 'assets/')
                ? asset($clientLogo->image)
                : asset('storage-files/' . $clientLogo->image) }}"
                alt="{{ $clientLogo->name }}"
                loading="lazy"
            >
        @endforeach

    </div>

@endsection
