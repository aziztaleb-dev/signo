@extends('admin.layouts.app')

@section('title', 'Modifier un logo')
@section('page-title', 'Modifier le logo client')

@section('content')
    <div class="card">
        <form action="{{ route('admin.client-logos.update', $clientLogo) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom du client</label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $clientLogo->name) }}"
                       maxlength="255"
                       required>
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Logo actuel</label>
                <div style="margin:10px 0;">
                    <img src="{{ str_starts_with($clientLogo->image, 'assets/')
                ? asset($clientLogo->image)
                : asset('storage-files/' . $clientLogo->image) }}"
                         alt="{{ $clientLogo->name }}"
                         style="max-width:220px;max-height:120px;object-fit:contain;">
                </div>
            </div>

            <div class="form-group">
                <label for="image">Remplacer le logo</label>
                <input type="file"
                       name="image"
                       id="image"
                       accept=".jpg,.jpeg,.png,.webp,.svg">
                <small>Laisse ce champ vide pour conserver le logo actuel.</small>
                @error('image')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                        @checked(old('is_active', $clientLogo->is_active))>
                    Afficher ce logo sur le site
                </label>
            </div>

            <button type="submit" class="btn">Enregistrer</button>

            <a href="{{ route('admin.client-logos.index') }}"
               class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
