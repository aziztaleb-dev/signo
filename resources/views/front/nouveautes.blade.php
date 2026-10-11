@extends('front.layouts.app')

@section('title', 'Nouveautés - Signo')

@section('description')
    Actualités et nouveaux produits de SIGNO : signalétique, études et réalisations en Tunisie.
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
        <h1>NOUVEAUTÉS</h1>
    </section>


    <div class="news-content">

        {{-- =========================
             ACTUALITÉS
        ========================== --}}
        <section
            aria-labelledby="news-actualites"
            class="content-width news-section"
        >

            <h2
                class="section-title"
                id="news-actualites"
            >
                ACTUALITÉS
            </h2>

            <div class="news-updates">

                @forelse ($newsItems as $item)

                    <article class="news-update">

                        <div class="news-update-copy">

                            <h3>
                                {{ $item->name }}
                            </h3>

                            <p>
                                {!! nl2br(e($item->description)) !!}
                            </p>

                        </div>

                        @if ($item->image)
                            <img
                                src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->name }}"
                                loading="lazy"
                            >
                        @endif

                    </article>

                @empty

                    <p>Aucune actualité pour le moment.</p>

                @endforelse

            </div>
        </section>


        {{-- =========================
             NOUVEAUX PRODUITS
        ========================== --}}
        <section
            aria-labelledby="news-produits"
            class="content-width news-section news-products"
        >

            <h2
                class="section-title"
                id="news-produits"
            >
                NOUVEAUX PRODUITS
            </h2>


            <div class="ps-lightbox" id="ps-lightbox" aria-hidden="true">
                <img src="" alt="">
            </div>

            @forelse ($newProducts as $product)

                @php
                    $productImages = $product->images ?? [];
                @endphp

                <article class="news-product">

                    <div class="news-product-copy">

                        <h3>
                            {{ $product->name }}
                        </h3>

                        <p>
                            {!! nl2br(e($product->description)) !!}
                        </p>

                    </div>


                    {{-- Album en diaporama (2 images par slide) --}}
                    <div class="ps-gallery">

                        <button
                            aria-label="Photos précédentes de {{ $product->name }}"
                            class="ps-arrow ps-prev"
                            type="button"
                        >
                            <svg
                                aria-hidden="true"
                                fill="none"
                                height="20"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                viewBox="0 0 24 24"
                                width="20"
                            >
                                <path d="m15 18-6-6 6-6"></path>
                            </svg>
                        </button>

                        <div class="ps-track">

                            @forelse ($productImages as $index => $imagePath)

                                <button
                                    aria-label="Agrandir une photo de {{ $product->name }}"
                                    class="ps-slide"
                                    type="button"
                                >
                                    <img
                                        src="{{ asset('storage/' . $imagePath) }}"
                                        alt="{{ $product->name }} — vue {{ $index + 1 }}"
                                        loading="lazy"
                                    >
                                </button>

                            @empty

                                <div class="ps-empty">Aucune photo</div>

                            @endforelse

                        </div>

                        <button
                            aria-label="Photos suivantes de {{ $product->name }}"
                            class="ps-arrow ps-next"
                            type="button"
                        >
                            <svg
                                aria-hidden="true"
                                fill="none"
                                height="20"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                viewBox="0 0 24 24"
                                width="20"
                            >
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </button>

                    </div>


                    {{-- Fiche produit (bouton compact avec icône PDF) --}}
                    <div class="ps-sheet">

                        @if ($product->pdf)

                            <a
                                href="{{ asset('storage/' . $product->pdf) }}"
                                class="ps-sheet-btn"
                                target="_blank"
                                rel="noopener"
                                download="{{ \Illuminate\Support\Str::slug($product->name) }}.pdf"
                                title="Télécharger la fiche produit"
                                aria-label="Télécharger la fiche produit de {{ $product->name }}"
                            >
                                <svg
                                    aria-hidden="true"
                                    fill="none"
                                    height="18"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    viewBox="0 0 24 24"
                                    width="18"
                                >
                                    <path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <path d="M14 3v6h6"></path>
                                    <path d="M12 12v5"></path>
                                    <path d="m9.5 14.5 2.5 2.5 2.5-2.5"></path>
                                </svg>

                                PDF
                            </a>

                        @else

                            <span
                                class="ps-sheet-btn is-disabled"
                                aria-disabled="true"
                                title="Aucune fiche produit disponible"
                            >
                    <svg
                        aria-hidden="true"
                        fill="none"
                        height="18"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        viewBox="0 0 24 24"
                        width="18"
                    >
                        <path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                        <path d="M14 3v6h6"></path>
                        <path d="M12 12v5"></path>
                        <path d="m9.5 14.5 2.5 2.5 2.5-2.5"></path>
                    </svg>

                    PDF
                </span>

                        @endif

                    </div>

                </article>

            @empty

                <p>Aucun nouveau produit pour le moment.</p>

            @endforelse
        </section>

    </div>

@endsection


@push('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const groups = [
                [
                    'news-06.jpg',
                    'news-07.jpg',
                    'news-08.jpg',
                    'news-09.jpg'
                ],
                [
                    'news-10.jpg',
                    'news-11.jpg',
                    'news-12.jpg',
                    'news-13.jpg'
                ],
                [
                    'news-14.jpg',
                    'news-15.jpg',
                    'news-16.jpg',
                    'news-17.jpg'
                ],
                [
                    'news-18.jpg',
                    'news-19.jpg',
                    'news-20.jpg'
                ]
            ];

            document
                .querySelectorAll('.news-product')
                .forEach((product, index) => {

                    const images = groups[index];

                    if (!images) {
                        return;
                    }

                    let position = 0;

                    function showImages() {

                        product
                            .querySelectorAll('.gallery-photo img')
                            .forEach((img, i) => {

                                const imageIndex =
                                    (position + i) % images.length;

                                img.src =
                                    '{{ asset('assets/images') }}/' +
                                    images[imageIndex];

                                img.alt =
                                    product.querySelector('h3').textContent +
                                    ' — vue ' +
                                    (imageIndex + 1);
                            });
                    }


                    product
                        .querySelector('.gallery-prev')
                        ?.addEventListener('click', () => {

                            position =
                                (position - 1 + images.length) %
                                images.length;

                            showImages();
                        });


                    product
                        .querySelector('.gallery-next')
                        ?.addEventListener('click', () => {

                            position =
                                (position + 1) %
                                images.length;

                            showImages();
                        });


                    product
                        .querySelectorAll('.gallery-photo')
                        .forEach(button => {

                            button.addEventListener('click', () => {

                                const box =
                                    document.createElement('div');

                                box.className =
                                    'news-lightbox';

                                box.setAttribute(
                                    'role',
                                    'dialog'
                                );

                                box.setAttribute(
                                    'aria-modal',
                                    'true'
                                );


                                const close =
                                    document.createElement('button');

                                close.setAttribute(
                                    'aria-label',
                                    'Fermer la photo'
                                );

                                close.textContent = '✕';


                                const img =
                                    document.createElement('img');

                                img.src =
                                    button.querySelector('img').src;

                                img.alt =
                                    product.querySelector('h3').textContent;


                                box.append(close, img);

                                box.addEventListener(
                                    'click',
                                    () => box.remove()
                                );

                                document.body.append(box);
                            });

                        });

                });

        });
    </script>

@endpush
