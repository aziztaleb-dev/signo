@extends('admin.layouts.app')

@section('title', 'Nouveau produit')

@section('page-title', 'Nouveau produit')

@section('content')

    <div class="card">

        <form
            action="{{ route('admin.new-products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="form-group">
                <label for="name">Nom</label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    maxlength="255"
                >

                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="images">Album d'images</label>

                <input
                    type="file"
                    name="images[]"
                    id="images"
                    accept=".jpg,.jpeg,.png,.webp"
                    multiple
                >

                <small style="color:#6b7280;">
                    Vous pouvez sélectionner plusieurs images (jpg, png, webp, 4 Mo maximum chacune).
                </small>

                @error('images')
                <div class="error">{{ $message }}</div>
                @enderror

                @foreach ($errors->get('images.*') as $messages)
                    @foreach ($messages as $message)
                        <div class="error">{{ $message }}</div>
                    @endforeach
                @endforeach
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea
                    name="description"
                    id="description"
                    rows="6"
                >{{ old('description') }}</textarea>

                @error('description')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="pdf">Fiche produit (PDF)</label>

                <input
                    type="file"
                    name="pdf"
                    id="pdf"
                    accept=".pdf,application/pdf"
                >

                <small style="color:#6b7280;">
                    Format PDF, 10 Mo maximum.
                </small>

                @error('pdf')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">
                Créer le produit
            </button>

            <a href="{{ route('admin.new-products.index') }}" class="btn btn-secondary">
                Annuler
            </a>

        </form>

    </div>

@endsection
