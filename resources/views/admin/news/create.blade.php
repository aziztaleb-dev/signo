@extends('admin.layouts.app')

@section('title', 'Nouvelle actualité')

@section('page-title', 'Nouvelle actualité')

@section('content')

    <div class="card">

        <form
            action="{{ route('admin.news.store') }}"
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
                <label for="image">Image</label>

                <input
                    type="file"
                    name="image"
                    id="image"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                @error('image')
                <div class="error">{{ $message }}</div>
                @enderror
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

            <button type="submit" class="btn">
                Créer l'actualité
            </button>

            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                Annuler
            </a>

        </form>

    </div>

@endsection
