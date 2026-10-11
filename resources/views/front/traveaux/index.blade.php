@extends('front.layouts.app')

@section('title', $subcategory->name . ' - Signo')

@section('description', 'Réalisations de signalétique Signo : ' . $subcategory->category->name . ' - ' . $subcategory->name . '.')

@section('content')

    <section
        class="news-banner"
        style="background-image: linear-gradient(var(--banner-shade), var(--banner-shade)), url('{{ asset('assets/images/footer.png') }}')"
    >
        <h1>{{ mb_strtoupper($subcategory->name) }}</h1>
    </section>


    <section
        aria-label="Projets {{ $subcategory->name }}"
        class="work-gallery-section"
    >

        <div class="work-gallery">

            @forelse ($works as $work)

                @php
                    $firstImage = ($work->images ?? [])[0] ?? null;
                @endphp

                <a
                    aria-label="{{ $work->title }}"
                    class="work-project"
                    href="{{ route('traveaux.show', [
                                'workSubcategory' => $subcategory,
                                'work'            => $work->slug,
                            ]) }}"
                >
                    @if ($firstImage)
                        <img
                            alt="{{ $work->title }}"
                            src="{{ asset('storage/' . $firstImage) }}"
                            loading="lazy"
                        >
                    @endif

                    <div class="work-project-caption">
                        <h2>{{ $work->title }}</h2>

                        @if ($work->title_en)
                            <p>{{  $work->title_en }}</p>
                        @endif
                    </div>
                </a>

            @empty

                <p>Aucun projet dans cette sous-catégorie pour le moment.</p>

            @endforelse

        </div>


        @if ($works->hasPages())

            @php
                $current = $works->currentPage();
                $last = $works->lastPage();
                $start = max(1, $current - 2);
                $end = min($last, $current + 2);
            @endphp

            <nav
                aria-label="Pages des projets"
                class="work-pagination"
            >

                @if ($works->onFirstPage())
                    <span aria-disabled="true">Précédent</span>
                @else
                    <a href="{{ $works->previousPageUrl() }}">Précédent</a>
                @endif

                @if ($start > 1)
                    <a aria-label="Page 1" href="{{ $works->url(1) }}">1</a>
                    @if ($start > 2)
                        <span aria-hidden="true">…</span>
                    @endif
                @endif

                @for ($page = $start; $page <= $end; $page++)
                    @if ($page === $current)
                        <a
                            aria-current="page"
                            aria-label="Page {{ $page }}"
                            class="active"
                        >
                            {{ $page }}
                        </a>
                    @else
                        <a
                            aria-label="Page {{ $page }}"
                            href="{{ $works->url($page) }}"
                        >
                            {{ $page }}
                        </a>
                    @endif
                @endfor

                @if ($end < $last)
                    @if ($end < $last - 1)
                        <span aria-hidden="true">…</span>
                    @endif
                    <a aria-label="Page {{ $last }}" href="{{ $works->url($last) }}">{{ $last }}</a>
                @endif

                @if ($works->hasMorePages())
                    <a href="{{ $works->nextPageUrl() }}">Suivant</a>
                @else
                    <span aria-disabled="true">Suivant</span>
                @endif

            </nav>

        @endif

    </section>

@endsection
