@extends('admin.layouts.app')

@section('title', 'Modifier : ' . $section->name)

@section('page-title', 'Modifier : ' . $section->name)

@section('content')

    <div class="card">

        <form
            class="home-page-form"
            action="{{ route('admin.service-page.update', $section) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="card-body">

                {{-- Erreurs générales --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Veuillez vérifier les informations suivantes :</strong>

                        <ul style="margin: 8px 0 0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Titre --}}
                <div class="form-group">

                    <h3 class="form-section-title">Titre</h3>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', $section->title) }}"
                        maxlength="255"
                    >

                    @error('title')
                    <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Sous-titre --}}
                <div class="form-group">

                    <h3 class="form-section-title">Sous-titre</h3>

                    <input
                        type="text"
                        name="subtitle"
                        id="subtitle"
                        value="{{ old('subtitle', $section->subtitle) }}"
                        maxlength="255"
                    >

                    @error('subtitle')
                    <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Paragraphes --}}
                <div class="form-group">

                    <h3 class="form-section-title">Paragraphes</h3>

                    @php
                        $paragraphs = old(
                            'paragraphs',
                            $section->paragraphs ?? []
                        );

                        if (!is_array($paragraphs)) {
                            $paragraphs = [];
                        }

                        $paragraphs = array_values($paragraphs);

                        $paragraphs = array_pad(
                            $paragraphs,
                            max(1, count($paragraphs)),
                            ''
                        );
                    @endphp

                    <div id="paragraphs-container">

                        @foreach ($paragraphs as $index => $paragraph)

                            <div class="paragraph-item" style="margin-bottom: 16px;">

                                <label for="paragraph_{{ $index }}">
                                    Paragraphe {{ $index + 1 }}
                                </label>

                                <textarea
                                    name="paragraphs[]"
                                    id="paragraph_{{ $index }}"
                                    rows="4"
                                >{{ $paragraph }}</textarea>

                                <button
                                    type="button"
                                    class="btn btn-secondary remove-paragraph"
                                    style="margin-top: 6px;"
                                >
                                    Supprimer ce paragraphe
                                </button>

                                @error('paragraphs.' . $index)
                                <div class="error">{{ $message }}</div>
                                @enderror

                            </div>

                        @endforeach

                    </div>

                    <button
                        type="button"
                        class="btn"
                        id="add-paragraph"
                    >
                        Ajouter un paragraphe
                    </button>

                    @error('paragraphs')
                    <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Citation --}}
                @if ($section->key === 'studies')

                    <hr>

                    <div class="form-group">

                        <h3 class="form-section-title">Citation</h3>

                        <textarea
                            name="quote"
                            id="quote"
                            rows="3"
                        >{{ old('quote', $section->quote) }}</textarea>

                        @error('quote')
                        <div class="error">{{ $message }}</div>
                        @enderror

                    </div>

                    {{-- Auteur --}}
                    <div class="form-group">

                        <h3 class="form-section-title">Auteur de la citation</h3>

                        <input
                            type="text"
                            name="quote_author"
                            id="quote_author"
                            value="{{ old('quote_author', $section->quote_author) }}"
                        >

                        @error('quote_author')
                        <div class="error">{{ $message }}</div>
                        @enderror

                    </div>

                @endif

                {{-- Éléments des études --}}
                @if ($section->key === 'studies')

                    <hr>

                    <div class="form-group">

                        <h3 class="form-section-title">Éléments des études</h3>

                        @php
                            $items = old('items', $section->items ?? []);

                            if (!is_array($items)) {
                                $items = [];
                            }

                            $items = array_values($items);
                        @endphp

                        <div id="items-container">

                            @foreach ($items as $index => $item)

                                <div
                                    class="item-card"
                                    style="border: 1px solid #ddd; padding: 16px; margin-bottom: 16px;"
                                >

                                    <h4>
                                        Élément {{ $index + 1 }}
                                    </h4>

                                    <div class="form-group">

                                        <label for="item_title_{{ $index }}">
                                            Titre
                                        </label>

                                        <input
                                            type="text"
                                            name="items[{{ $index }}][title]"
                                            id="item_title_{{ $index }}"
                                            value="{{ $item['title'] ?? '' }}"
                                        >

                                        @error('items.' . $index . '.title')
                                        <div class="error">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="form-group">

                                        <label for="item_text_{{ $index }}">
                                            Description
                                        </label>

                                        <textarea
                                            name="items[{{ $index }}][text]"
                                            id="item_text_{{ $index }}"
                                            rows="4"
                                        >{{ $item['text'] ?? '' }}</textarea>

                                        @error('items.' . $index . '.text')
                                        <div class="error">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <button
                                        type="button"
                                        class="btn btn-secondary remove-item"
                                    >
                                        Supprimer cet élément
                                    </button>

                                </div>

                            @endforeach

                        </div>

                        <button
                            type="button"
                            class="btn"
                            id="add-item"
                        >
                            Ajouter un élément
                        </button>

                        @error('items')
                        <div class="error">{{ $message }}</div>
                        @enderror

                    </div>

                @endif

                <hr>

                {{-- Image principale --}}
                <div class="form-group">

                    <h3 class="form-section-title">Image principale</h3>

                    @if ($section->image)

                        @php
                            $currentImage = $section->image;

                            $currentImageUrl = str_starts_with($currentImage, 'assets/')
                                ? asset($currentImage)
                                : {{ asset('storage-files/' . $currentImage) }};
                        @endphp

                        <div class="image-card">

                            <img
                                src="{{ $currentImageUrl }}"
                                alt="{{ $section->name }}"
                            >

                            <label class="image-delete">

                                <input
                                    type="checkbox"
                                    name="remove_image"
                                    value="1"
                                    @checked(old('remove_image'))
                                >

                                Supprimer l'image

                            </label>

                        </div>

                    @else

                        <p>Aucune image principale.</p>

                    @endif

                    <label for="image">
                        Choisir ou remplacer l'image principale
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="form-control"
                    >

                    <small>
                        Formats acceptés : JPG, JPEG, PNG et WEBP.
                        Taille maximale : 5 Mo.
                    </small>

                    @error('image')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    @error('remove_image')
                    <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <hr>

                {{-- Galerie actuelle --}}
                @php
                    $gallery = $section->gallery ?? [];

                    if (is_string($gallery)) {
                        $gallery = json_decode($gallery, true) ?? [];
                    }

                    $gallery = is_array($gallery) ? array_values($gallery) : [];

                    $removedGallery = old('remove_gallery', []);

                    if (!is_array($removedGallery)) {
                        $removedGallery = [];
                    }
                @endphp

                <div class="form-group">

                    <h3 class="form-section-title">Galerie actuelle</h3>

                    @if (count($gallery))

                        <div class="current-images">

                            @foreach ($gallery as $index => $path)

                                @php
                                    $galleryImageUrl = str_starts_with($path, 'assets/')
                                        ? asset($path)
                                        :  {{ asset('storage-files/' . $path) }};
                                @endphp

                                <div class="image-card">

                                    <img
                                        src="{{ $galleryImageUrl }}"
                                        alt="{{ $section->name }} — image {{ $index + 1 }}"
                                    >

                                    <label class="image-delete">

                                        <input
                                            type="checkbox"
                                            name="remove_gallery[]"
                                            value="{{ $path }}"
                                            @checked(in_array($path, $removedGallery, true))
                                        >

                                        Supprimer l'image

                                    </label>

                                </div>

                            @endforeach

                        </div>

                        <small>
                            Cochez les images à supprimer, puis enregistrez.
                        </small>

                    @else

                        <p>Aucune image dans la galerie.</p>

                    @endif

                </div>

                {{-- Ajouter des images --}}
                <div class="form-group">

                    <h3 class="form-section-title">
                        Ajouter des images à la galerie
                    </h3>

                    <input
                        type="file"
                        name="gallery[]"
                        id="gallery"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple
                    >

                    <small>
                        Formats acceptés : JPG, JPEG, PNG et WEBP.
                        Maximum 5 Mo par image.
                    </small>

                    @error('gallery')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    @foreach ($errors->get('gallery.*') as $messages)
                        @foreach ($messages as $message)
                            <div class="error">{{ $message }}</div>
                        @endforeach
                    @endforeach

                </div>

                <hr>

                {{-- Texte du bouton --}}
                <div class="form-group">

                    <h3 class="form-section-title">Texte du bouton</h3>

                    <input
                        type="text"
                        name="button_text"
                        id="button_text"
                        value="{{ old('button_text', $section->button_text) }}"
                    >

                    @error('button_text')
                    <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                {{-- URL du bouton --}}
                <div class="form-group">

                    <h3 class="form-section-title">URL du bouton</h3>

                    <input
                        type="text"
                        name="button_url"
                        id="button_url"
                        value="{{ old('button_url', $section->button_url) }}"
                    >

                    @error('button_url')
                    <div class="error">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            {{-- Actions --}}
            <div class="card-footer">

                <button type="submit" class="btn">
                    Enregistrer les modifications
                </button>

                <a
                    href="{{ route('admin.service-page.index') }}"
                    class="btn btn-secondary"
                >
                    Annuler
                </a>

            </div>

        </form>

    </div>


    {{-- Modèles pour les nouveaux champs --}}
    <template id="paragraph-template">
        <div class="paragraph-item" style="margin-bottom: 16px;">

            <label>Paragraphe</label>

            <textarea
                name="paragraphs[]"
                rows="4"
            ></textarea>

            <button
                type="button"
                class="btn btn-secondary remove-paragraph"
                style="margin-top: 6px;"
            >
                Supprimer ce paragraphe
            </button>

        </div>
    </template>


    <template id="item-template">
        <div
            class="item-card"
            style="border: 1px solid #ddd; padding: 16px; margin-bottom: 16px;"
        >

            <h4>Nouvel élément</h4>

            <div class="form-group">

                <label>Titre</label>

                <input type="text" class="new-item-title">

            </div>

            <div class="form-group">

                <label>Description</label>

                <textarea class="new-item-text" rows="4"></textarea>

            </div>

            <button
                type="button"
                class="btn btn-secondary remove-item"
            >
                Supprimer cet élément
            </button>

        </div>
    </template>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /*
             * Ajouter un paragraphe.
             */
            const addParagraphButton = document.getElementById('add-paragraph');
            const paragraphsContainer = document.getElementById('paragraphs-container');
            const paragraphTemplate = document.getElementById('paragraph-template');

            if (addParagraphButton && paragraphsContainer && paragraphTemplate) {
                addParagraphButton.addEventListener('click', function () {
                    const fragment = paragraphTemplate.content.cloneNode(true);
                    paragraphsContainer.appendChild(fragment);
                });
            }

            /*
             * Supprimer un paragraphe.
             */
            document.addEventListener('click', function (event) {
                const button = event.target.closest('.remove-paragraph');

                if (button) {
                    button.closest('.paragraph-item').remove();
                }
            });

            /*
             * Ajouter un élément aux études.
             */
            const addItemButton = document.getElementById('add-item');
            const itemsContainer = document.getElementById('items-container');
            const itemTemplate = document.getElementById('item-template');

            if (addItemButton && itemsContainer && itemTemplate) {
                addItemButton.addEventListener('click', function () {
                    const index = Date.now();
                    const fragment = itemTemplate.content.cloneNode(true);
                    const card = fragment.querySelector('.item-card');

                    card.querySelector('.new-item-title').name =
                        `items[${index}][title]`;

                    card.querySelector('.new-item-text').name =
                        `items[${index}][text]`;

                    itemsContainer.appendChild(fragment);
                });
            }

            /*
             * Supprimer un élément.
             */
            document.addEventListener('click', function (event) {
                const button = event.target.closest('.remove-item');

                if (button) {
                    button.closest('.item-card').remove();
                }
            });

        });
    </script>

@endsection
