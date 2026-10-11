@extends('front.layouts.app')

@section('title', $work->title . ' - Signo')

@section('description', \Illuminate\Support\Str::limit(strip_tags((string) $work->description), 150))

@section('content')

    @php
        $images = $work->images ?? [];
    @endphp

    <section
        class="news-banner"
        style="
            background-image:
                linear-gradient(var(--banner-shade), var(--banner-shade)),
                url('{{ asset('assets/images/footer.png') }}');
        "
    >
        <h1>{{ mb_strtoupper($work->title) }}</h1>
    </section>


    <section class="product-show-section">

        <div class="content-width product-show">

            {{-- GAUCHE : DIAPORAMA --}}
            <div class="product-gallery">

                <div class="product-main-image">

                    @if (count($images) > 0)
                        <img
                            id="product-main-image"
                            src="{{ asset('storage/' . $images[0]) }}"
                            alt="{{ $work->title }}"
                        >
                    @endif

                    @if (count($images) > 1)

                        <button
                            type="button"
                            class="product-slider-btn product-slider-prev"
                            aria-label="Image précédente"
                        >
                            ‹
                        </button>

                        <button
                            type="button"
                            class="product-slider-btn product-slider-next"
                            aria-label="Image suivante"
                        >
                            ›
                        </button>

                    @endif

                </div>


                @if (count($images) > 1)

                    <div class="product-thumbnails">

                        @foreach ($images as $index => $imagePath)

                            <button
                                type="button"
                                class="product-thumbnail {{ $loop->first ? 'active' : '' }}"
                                data-image="{{ asset('storage/' . $imagePath) }}"
                            >
                                <img
                                    src="{{ asset('storage/' . $imagePath) }}"
                                    alt="{{ $work->title }} - image {{ $index + 1 }}"
                                >
                            </button>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- DROITE : DESCRIPTION --}}
            <div class="product-info">

                <h2>
                    {{ $work->title }}
                </h2>

                <div class="product-description">
                    <p>{!! nl2br(e($work->description)) !!}</p>
                </div>

                <div class="product-category">

                    <span>
                        Catégorie
                    </span>

                    <strong>
                        {{ $subcategory->category->name }}
                    </strong>

                    <span>
                        Sous-catégorie
                    </span>

                    <strong>
                        <a
                            href="{{ route('traveaux.index', $subcategory) }}"
                            style="color:inherit; text-decoration:none;"
                        >
                            {{ $subcategory->name }}
                        </a>
                    </strong>

                </div>

            </div>

        </div>

    </section>


    @if (count($images) > 1)
        <script>
            (function () {
                var main = document.getElementById('product-main-image');
                var thumbs = Array.prototype.slice.call(document.querySelectorAll('.product-thumbnail'));
                var prev = document.querySelector('.product-slider-prev');
                var next = document.querySelector('.product-slider-next');
                var current = 0;

                if (!main || thumbs.length < 2) {
                    return;
                }

                function show(index) {
                    current = (index + thumbs.length) % thumbs.length;
                    main.src = thumbs[current].getAttribute('data-image');

                    thumbs.forEach(function (thumb, i) {
                        thumb.classList.toggle('active', i === current);
                    });
                }

                thumbs.forEach(function (thumb, i) {
                    thumb.addEventListener('click', function () {
                        show(i);
                    });
                });

                prev.addEventListener('click', function () {
                    show(current - 1);
                });

                next.addEventListener('click', function () {
                    show(current + 1);
                });
            })();
        </script>
    @endif

@endsection
