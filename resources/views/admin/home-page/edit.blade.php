@extends('admin.layouts.app')

@section('title', 'Modifier : ' . $section->name)

@section('page-title', 'Modifier : ' . $section->name)

@section('content')

    <div class="card">

        <form
            class="home-page-form"
            action="{{ route('admin.home-page.update', $section) }}"
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

                        $paragraphs = array_pad(
                            $paragraphs,
                            max(2, count($paragraphs)),
                            ''
                        );
                    @endphp

                    @foreach ($paragraphs as $index => $paragraph)

                        <div style="margin-bottom: 12px;">

                            <label for="paragraph_{{ $index }}">
                                Paragraphe {{ $index + 1 }}
                            </label>

                            <textarea
                                name="paragraphs[]"
                                id="paragraph_{{ $index }}"
                                rows="4"
                            >{{ $paragraph }}</textarea>

                            @error('paragraphs.' . $index)
                            <div class="error">{{ $message }}</div>
                            @enderror

                        </div>

                    @endforeach

                    @error('paragraphs')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    <small>
                        Pour ajouter un paragraphe, renseignez un champ vide.
                    </small>

                </div>

                {{-- Citation --}}
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

                {{-- Auteur de la citation --}}
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

                <hr>

                {{-- Image principale --}}
                <div class="form-group">

                    <h3 class="form-section-title">Image principale</h3>

                    @if ($section->image)

                        <div class="image-card">

                            <img
                                src="{{ asset('storage-files/' . $section->image) }}"
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
                        Formats acceptés : JPG, JPEG, PNG et WEBP. Taille maximale : 5 Mo.
                    </small>

                    @error('image')
                    <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <hr>

                {{-- Galerie actuelle --}}
                <div class="form-group">

                    <h3 class="form-section-title">Galerie actuelle</h3>

                    @php
                        $gallery = $section->gallery ?? [];

                        if (is_string($gallery)) {
                            $gallery = json_decode($gallery, true) ?? [];
                        }

                        $gallery = is_array($gallery) ? $gallery : [];

                        $removedGallery = old('remove_gallery', []);

                        if (!is_array($removedGallery)) {
                            $removedGallery = [];
                        }
                    @endphp

                    @if (count($gallery))

                        <div class="current-images">

                            @foreach ($gallery as $path)

                                <div class="image-card">

                                    <img
                                        src="{{ asset('storage-files/' . $path) }}"
                                        alt="{{ $section->name }}"
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
                            Cochez les images que vous souhaitez supprimer,
                            puis enregistrez les modifications.
                        </small>

                    @else

                        <p>Aucune image dans la galerie.</p>

                    @endif

                </div>

                {{-- Ajouter des images à la galerie --}}
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
                        Maximum : 10 images au total, 5 Mo par image.
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
                    href="{{ route('admin.home-page.index') }}"
                    class="btn btn-secondary"
                >
                    Annuler
                </a>

            </div>

        </form>

    </div>

@endsection
