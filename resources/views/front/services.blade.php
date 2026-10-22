@extends('front.layouts.app')

@section('title', 'Nos services — Signo')

@section('description')
    Conseil, études, design, fabrication et pose de signalétique SIGNO.
@endsection

@section('content')

    @php
        use Illuminate\Support\Facades\Storage;

        $imageUrl = function ($path) {
            if (!$path) {
                return null;
            }

            if (
                str_starts_with($path, 'assets/') ||
                str_starts_with($path, 'http://') ||
                str_starts_with($path, 'https://') ||
                str_starts_with($path, '/')
            ) {
                return str_starts_with($path, 'assets/')
                    ? asset($path)
                    : $path;
            }

            return asset('storage-files/' . $path);
        };

        $banner = $sections->get('banner');
        $adviceGallery = $sections->get('advice_gallery');
        $advice = $sections->get('advice');
        $studiesGalleryTop = $sections->get('studies_gallery_top');
        $studiesGalleryBottom = $sections->get('studies_gallery_bottom');
        $studies = $sections->get('studies');
        $productionGallery = $sections->get('production_gallery');
        $production = $sections->get('production');
    @endphp

    {{-- Bannière Nos services --}}
    @if ($banner)
        <section
            class="news-banner services-banner"
            style="background-image: linear-gradient(var(--banner-shade), var(--banner-shade)), url('{{ $imageUrl($banner->image) }}')"
        >
            <h1>{{ $banner->title }}</h1>
        </section>
    @endif

    {{-- Conseil et préparation du projet --}}
    @if ($adviceGallery && count($adviceGallery->gallery ?? []) > 0)
        <div
            class="services-photos services-photos-bordered"
            aria-label="Conseil et préparation du projet"
        >
            @foreach ($adviceGallery->gallery as $index => $image)
                <img
                    src="{{ $imageUrl($image) }}"
                    alt="Conseil et préparation du projet — {{ $index + 1 }}"
                    loading="lazy"
                >
            @endforeach
        </div>
    @endif

    {{-- Notre conseil --}}
    @if ($advice)
        <section class="services-detail services-advice">
            <div class="content-width services-detail-grid">

                <h2>{{ $advice->title }}</h2>

                <div>
                    @foreach ($advice->paragraphs ?? [] as $paragraph)
                        @if (trim($paragraph ?? '') !== '')
                            <p>{{ $paragraph }}</p>
                        @endif
                    @endforeach
                </div>

            </div>
        </section>
    @endif

    {{-- Études et design : première série de photos --}}
    @if ($studiesGalleryTop && count($studiesGalleryTop->gallery ?? []) > 0)
        <div
            class="services-photos services-photos-top"
            aria-label="Études et design signalétique"
        >
            @foreach ($studiesGalleryTop->gallery as $index => $image)
                <img
                    src="{{ $imageUrl($image) }}"
                    alt="Études et design signalétique — {{ $index + 1 }}"
                    loading="lazy"
                >
            @endforeach
        </div>
    @endif

    {{-- Études et design : deuxième série de photos --}}
    @if ($studiesGalleryBottom && count($studiesGalleryBottom->gallery ?? []) > 0)
        <div
            class="services-photos services-photos-bottom"
            aria-label="Machines de découpe et gravure"
        >
            @foreach ($studiesGalleryBottom->gallery as $index => $image)
                <img
                    src="{{ $imageUrl($image) }}"
                    alt="Machines de découpe et gravure — {{ $index + 1 }}"
                    loading="lazy"
                >
            @endforeach
        </div>
    @endif

    {{-- Nos études --}}
    @if ($studies)
        <section class="services-detail services-studies">
            <div class="content-width services-detail-grid">

                <h2>{{ $studies->title }}</h2>

                <div>

                    @if ($studies->quote)
                        <blockquote>
                            {{ $studies->quote }}

                            @if ($studies->quote_author)
                                <br>
                                <strong>
                                    <em>{{ $studies->quote_author }}</em>
                                </strong>
                            @endif
                        </blockquote>
                    @endif

                    @foreach ($studies->paragraphs ?? [] as $paragraph)
                        @if (trim($paragraph ?? '') !== '')
                            <p>{{ $paragraph }}</p>
                        @endif
                    @endforeach

                    @if (count($studies->items ?? []) > 0)
                        <ul>
                            @foreach ($studies->items as $item)
                                <li>
                                    @if (!empty($item['title']))
                                        <strong>{{ $item['title'] }}</strong>
                                    @endif

                                    @if (!empty($item['text']))
                                        {{ $item['text'] }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>

            </div>
        </section>
    @endif

    {{-- Fabrication, installation et éclairage --}}
    @if ($productionGallery && count($productionGallery->gallery ?? []) > 0)
        <div
            class="services-photos services-photos-bordered"
            aria-label="Fabrication, installation et éclairage"
        >
            @foreach ($productionGallery->gallery as $index => $image)
                <img
                    src="{{ $imageUrl($image) }}"
                    alt="Fabrication, installation et éclairage — {{ $index + 1 }}"
                    loading="lazy"
                >
            @endforeach
        </div>
    @endif

    {{-- Notre production --}}
    @if ($production)
        <section class="services-production">

            @if ($production->image)
                <img
                    src="{{ $imageUrl($production->image) }}"
                    alt="Technicien SIGNO équipé pour la pose"
                    loading="lazy"
                >
            @endif

            <div class="services-production-copy">

                <h2>{{ $production->title }}</h2>

                @foreach ($production->paragraphs ?? [] as $paragraph)
                    @if (trim($paragraph ?? '') !== '')
                        <p>{{ $paragraph }}</p>
                    @endif
                @endforeach

            </div>

        </section>
    @endif
@endsection
