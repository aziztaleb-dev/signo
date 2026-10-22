@extends('admin.layouts.app')

@section('title', "Modifier l'actualité")

@section('page-title', "Modifier l'actualité")

@section('content')

    <div class="card">

        <form
            action="{{ route('admin.news.update', $news) }}"
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
                    value="{{ old('name', $news->name) }}"
                    maxlength="255"
                >

                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>

                @if (!empty($news->image))
                    <div style="margin:8px 0 12px;">
                        <img
                            src="{{ asset('storage-files/' . $news->image) }}"
                            alt="{{ $news->name }}"
                            width="100"
                            style="
                                width:100px;
                                height:100px;
                                object-fit:cover;
                                border-radius:8px;
                                display:block;
                            "
                        >
                    </div>
                @endif

                <input
                    type="file"
                    name="image"
                    id="image"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small style="color:#6b7280;">
                    Laissez vide pour conserver l'image actuelle.
                </small>

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
                >{{ old('description', $news->description) }}</textarea>

                @error('description')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">
                Enregistrer les modifications
            </button>

            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                Annuler
            </a>

        </form>

    </div>

@endsection
