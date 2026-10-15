@extends('admin.layouts.app')

@section('title', 'Modifier : ' . $section->name)
@section('page-title', 'Modifier : ' . $section->name)

@section('content')

    @php
        $sectionData = $section->data ?? [];
        $phones = $sectionData['phones'] ?? [
            ['label' => '', 'value' => ''],
        ];
        $imageUrl = function ($path) {
            if (!$path) {
                return null;
            }
            if (
                str_starts_with($path, 'assets/') ||
                str_starts_with($path, 'http://') ||
                str_starts_with($path, 'https://') ||
                str_starts_with($path, '/')
            ) {
                return str_starts_with($path, 'assets/')
                    ? asset($path)
                    : $path;
            }
            return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
        };
    @endphp
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul style="margin-bottom:0; margin-top:8px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <form
            class="home-page-form"
            action="{{ route('admin.contact-page.update', $section) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')
            <div class="card-body">
                {{-- INFORMATIONS GÉNÉRALES --}}
                <div class="form-group">
                    <h3 class="form-section-title">Informations générales</h3>
                    <label for="title">Titre</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        value="{{ old('title', $section->title) }}"
                    >
                    @error('title')
                    <small style="color:#dc2626;">{{ $message }}</small>
                    @enderror
                </div>
                {{-- CONTENU TEXTUEL --}}
                @if (in_array($section->key, ['address', 'email', 'hours', 'map', 'form']))
                    <div class="form-group">
                        <h3 class="form-section-title">
                            {{ $section->key === 'map' ? 'URL Google Maps' : 'Contenu' }}
                        </h3>
                        @if ($section->key === 'map')
                            <label for="content">URL de la carte intégrable</label>
                        @elseif ($section->key === 'email')
                            <label for="content">Adresse email</label>
                        @elseif ($section->key === 'address')
                            <label for="content">Adresse complète</label>
                        @elseif ($section->key === 'hours')
                            <label for="content">Horaires d’ouverture</label>
                        @else
                            <label for="content">Texte d’introduction du formulaire</label>
                        @endif
                        <textarea
                            id="content"
                            name="content"
                            class="form-control"
                            rows="5"
                        >{{ old('content', $section->content) }}</textarea>
                        @error('content')
                        <small style="color:#dc2626;">{{ $message }}</small>
                        @enderror
                    </div>
                @endif
                {{-- TÉLÉPHONES --}}
                @if ($section->key === 'phones')
                    <div class="form-group">
                        <h3 class="form-section-title">Numéros de téléphone</h3>
                        <div id="phones-container">
                            @foreach (old('data.phones', $phones) as $index => $phone)
                                <div class="phone-row" style="display:flex; gap:12px; margin-bottom:12px; align-items:end; flex-wrap:wrap;">
                                    <div style="flex:1; min-width:180px;">
                                        <label>Numéro affiché</label>
                                        <input
                                            type="text"
                                            name="data[phones][{{ $index }}][label]"
                                            class="form-control"
                                            value="{{ $phone['label'] ?? '' }}"
                                        >
                                    </div>
                                    <div style="flex:1; min-width:180px;">
                                        <label>Numéro pour le lien tel:</label>
                                        <input
                                            type="text"
                                            name="data[phones][{{ $index }}][value]"
                                            class="form-control"
                                            value="{{ $phone['value'] ?? '' }}"
                                        >
                                    </div>
                                    <button
                                        type="button"
                                        class="btn remove-phone"
                                    >
                                        Supprimer
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn" id="add-phone">
                            Ajouter un numéro
                        </button>
                    </div>
                @endif
                {{-- RÉSEAUX SOCIAUX --}}
                @if ($section->key === 'social')
                    <div class="form-group">
                        <h3 class="form-section-title">Liens des réseaux sociaux</h3>
                        @foreach (['facebook' => 'Facebook', 'pinterest' => 'Pinterest', 'instagram' => 'Instagram', 'whatsapp' => 'WhatsApp'] as $key => $label)
                            <div class="form-group">
                                <label for="data_{{ $key }}">{{ $label }}</label>
                                <input
                                    type="url"
                                    id="data_{{ $key }}"
                                    name="data[{{ $key }}]"
                                    class="form-control"
                                    value="{{ old('data.' . $key, $sectionData[$key] ?? '') }}"
                                    placeholder="https://..."
                                >
                                @error('data.' . $key)
                                <small style="color:#dc2626;">{{ $message }}</small>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                @endif
                {{-- BOUTON DU FORMULAIRE --}}
                @if ($section->key === 'form')
                    <div class="form-group">
                        <label for="data_button_text">Texte du bouton</label>
                        <input
                            type="text"
                            id="data_button_text"
                            name="data[button_text]"
                            class="form-control"
                            value="{{ old('data.button_text', $sectionData['button_text'] ?? 'Envoyer le message') }}"
                        >
                    </div>
                @endif
                {{-- IMAGE --}}
                @if ($section->key === 'banner')
                    <div class="form-group">
                        <h3 class="form-section-title">Image de la bannière</h3>
                        @if ($section->image)
                            <div class="image-card" style="margin-bottom:15px;">
                                <img
                                    src="{{ $imageUrl($section->image) }}"
                                    alt="Image actuelle"
                                    style="max-width:300px; max-height:180px; object-fit:cover;"
                                >
                                <div style="margin-top:10px;">
                                    <label>
                                        <input
                                            type="checkbox"
                                            name="remove_image"
                                            value="1"
                                            @checked(old('remove_image'))
                                        >
                                        Supprimer l’image actuelle
                                    </label>
                                </div>
                            </div>
                        @endif
                        <label for="image">Nouvelle image</label>
                        <input
                            type="file"
                            id="image"
                            name="image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >
                        @error('image')
                        <small style="color:#dc2626;">{{ $message }}</small>
                        @enderror
                    </div>
                @endif

            </div>
            <div class="card-footer" style="display:flex; gap:10px; flex-wrap:wrap;">
                <button type="submit" class="btn">
                    Enregistrer les modifications
                </button>
                <a
                    href="{{ route('admin.contact-page.index') }}"
                    class="btn"
                >
                    Annuler
                </a>
            </div>
        </form>
    </div>
    @if ($section->key === 'phones')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('phones-container');
                const addButton = document.getElementById('add-phone');
                let nextIndex = {{ count(old('data.phones', $phones)) }};
                addButton.addEventListener('click', function () {
                    if (container.querySelectorAll('.phone-row').length >= 10) {
                        alert('Vous pouvez ajouter jusqu’à 10 numéros.');
                        return;
                    }
                    const row = document.createElement('div');
                    row.className = 'phone-row';
                    row.style.cssText = 'display:flex;gap:12px;margin-bottom:12px;align-items:end;flex-wrap:wrap;';
                    row.innerHTML = `
                    <div style="flex:1;min-width:180px;">
                        <label>Numéro affiché</label>
                        <input type="text" name="data[phones][${nextIndex}][label]" class="form-control">
                    </div>
                    <div style="flex:1;min-width:180px;">
                        <label>Numéro pour le lien tel:</label>
                        <input type="text" name="data[phones][${nextIndex}][value]" class="form-control">
                    </div>
                    <button type="button" class="btn remove-phone">Supprimer</button>
                `;
                    container.appendChild(row);
                    nextIndex++;
                });
                container.addEventListener('click', function (event) {
                    const button = event.target.closest('.remove-phone');
                    if (button) {
                        const rows = container.querySelectorAll('.phone-row');
                        if (rows.length > 1) {
                            button.closest('.phone-row').remove();
                        } else {
                            button.closest('.phone-row').querySelectorAll('input').forEach(input => {
                                input.value = '';
                            });
                        }
                    }
                });
            });
        </script>
    @endif

@endsection
