@extends('admin.layouts.app')

@section('title', 'Modifier le produit')

@section('page-title', 'Modifier le produit')

@section('content')

    <div class="card">

        <form
            action="{{ route('admin.new-products.update', $newProduct) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom</label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $newProduct->name) }}"
                    maxlength="255"
                >

                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Images actuelles</label>

                @if (!empty($newProduct->images))

                    <div style="
                        display:flex;
                        flex-wrap:wrap;
                        gap:14px;
                        margin:10px 0 6px;
                    ">

                        @foreach ($newProduct->images as $imagePath)

                            <div style="width:110px;">

                                <img
                                    src="{{ asset('storage/' . $imagePath) }}"
                                    alt="{{ $newProduct->name }}"
                                    style="
                                        width:110px;
                                        height:110px;
                                        object-fit:cover;
                                        border-radius:8px;
                                        display:block;
                                    "
                                >

                                <label style="
                                    display:flex;
                                    align-items:center;
                                    gap:6px;
                                    margin-top:6px;
                                    font-size:12px;
                                    font-weight:500;
                                    color:#dc2626;
                                    cursor:pointer;
                                ">
                                    <input
                                        type="checkbox"
                                        name="remove_images[]"
                                        value="{{ $imagePath }}"
                                        style="
                                            width:auto;
                                            margin:0;
                                            padding:0;
                                        "
                                        @checked(in_array($imagePath, old('remove_images', [])))
                                    >
                                    Supprimer
                                </label>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div style="color:#6b7280; font-size:13px; margin-top:6px;">
                        Aucune image pour le moment.
                    </div>

                @endif
            </div>

            <div class="form-group">
                <label for="images">Ajouter des images à l'album</label>

                <input
                    type="file"
                    name="images[]"
                    id="images"
                    accept=".jpg,.jpeg,.png,.webp"
                    multiple
                >

                <small style="color:#6b7280;">
                    Les nouvelles images seront ajoutées à l'album. Cochez « Supprimer » pour retirer une image existante.
                </small>

                @error('images')
                <div class="error">{{ $message }}</div>
                @enderror

                @foreach ($errors->get('images.*') as $messages)
                    @foreach ($messages as $message)
                        <div class="error">{{ $message }}</div>
                    @endforeach
                @endforeach

                @error('remove_images')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea
                    name="description"
                    id="description"
                    rows="6"
                >{{ old('description', $newProduct->description) }}</textarea>

                @error('description')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="pdf">Fiche produit (PDF)</label>

                @if ($newProduct->pdf)
                    <div style="margin:8px 0 10px;">
                        <a
                            href="{{ asset('storage/' . $newProduct->pdf) }}"
                            target="_blank"
                            rel="noopener"
                            style="
                                display:inline-flex;
                                align-items:center;
                                gap:6px;
                                color:#dc2626;
                                font-size:13px;
                                font-weight:600;
                                text-decoration:none;
                            "
                        >
                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                <path d="M14 3v6h6"></path>
                            </svg>

                            Voir le PDF actuel
                        </a>
                    </div>
                @endif

                <input
                    type="file"
                    name="pdf"
                    id="pdf"
                    accept=".pdf,application/pdf"
                >

                <small style="color:#6b7280;">
                    Laissez vide pour conserver le PDF actuel.
                </small>

                @error('pdf')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">
                Enregistrer les modifications
            </button>

            <a href="{{ route('admin.new-products.index') }}" class="btn btn-secondary">
                Annuler
            </a>

        </form>

    </div>

@endsection
