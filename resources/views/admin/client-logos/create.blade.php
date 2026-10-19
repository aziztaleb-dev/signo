@extends('admin.layouts.app')

@section('title', 'Ajouter un logo')
@section('page-title', 'Ajouter un logo client')

@section('content')
    <div class="card">
        <form action="{{ route('admin.client-logos.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Nom du client</label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name') }}"
                       maxlength="255"
                       required>
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Logo</label>
                <input type="file"
                       name="image"
                       id="image"
                       accept=".jpg,.jpeg,.png,.webp,.svg"
                       required>
                <small>Formats acceptés : JPG, PNG, WebP ou SVG. Taille maximale : 2 Mo.</small>
                @error('image')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                        @checked(old('is_active', true))>
                    Afficher ce logo sur le site
                </label>
            </div>

            <button type="submit" class="btn">Ajouter le logo</button>

            <a href="{{ route('admin.client-logos.index') }}"
               class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
