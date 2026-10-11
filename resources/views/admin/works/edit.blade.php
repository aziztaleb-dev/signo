@extends('admin.layouts.app')

@section('title', 'Modifier le travail')

@section('page-title', 'Modifier le travail')

@section('content')

    <div class="card">

        <form
            action="{{ route('admin.works.update', $work) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="work_category_id">Catégorie</label>

                <select id="work_category_id">

                    <option value="">
                        -- Sélectionner une catégorie --
                    </option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(old('work_category_id', $selectedCategoryId) == $category->id)
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="work_subcategory_id">Sous-catégorie</label>

                <select name="work_subcategory_id" id="work_subcategory_id" disabled>
                    <option value="">
                        -- Sélectionnez d'abord une catégorie --
                    </option>
                </select>

                @error('work_subcategory_id')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Titre</label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $work->title) }}"
                    maxlength="255"
                >

                @error('title')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title_en">Titre EN</label>

                <input
                    type="text"
                    name="title_en"
                    id="title_en"
                    value="{{ old('title_en', $work->title_en) }}"
                    maxlength="255"
                >

                @error('title_en')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Images actuelles</label>

                @if (!empty($work->images))

                    <div style="
                        display:flex;
                        flex-wrap:wrap;
                        gap:14px;
                        margin:10px 0 6px;
                    ">

                        @foreach ($work->images as $imagePath)

                            <div style="width:110px;">

                                <img
                                    src="{{ asset('storage/' . $imagePath) }}"
                                    alt="{{ $work->title }}"
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
                >{{ old('description', $work->description) }}</textarea>

                @error('description')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">
                Enregistrer les modifications
            </button>

            <a href="{{ route('admin.works.index') }}" class="btn btn-secondary">
                Annuler
            </a>

        </form>

    </div>

    <script>
        (function () {
            var categorySelect = document.getElementById('work_category_id');
            var subcategorySelect = document.getElementById('work_subcategory_id');
            var urlTemplate = "{{ route('admin.works.subcategories', ['workCategory' => '__ID__']) }}";
            var currentSubcategoryId = "{{ old('work_subcategory_id', $work->work_subcategory_id) }}";

            function resetSubcategories(message, disabled) {
                subcategorySelect.innerHTML = '';

                var option = document.createElement('option');
                option.value = '';
                option.textContent = message;
                subcategorySelect.appendChild(option);

                subcategorySelect.disabled = disabled;
            }

            function loadSubcategories(categoryId, selectedId) {
                if (!categoryId) {
                    resetSubcategories("-- Sélectionnez d'abord une catégorie --", true);
                    return;
                }

                resetSubcategories('Chargement...', true);

                fetch(urlTemplate.replace('__ID__', categoryId), {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error('Erreur de chargement');
                        }
                        return response.json();
                    })
                    .then(function (items) {
                        if (items.length === 0) {
                            resetSubcategories('Aucune sous-catégorie pour cette catégorie', true);
                            return;
                        }

                        resetSubcategories('-- Sélectionner une sous-catégorie --', false);

                        items.forEach(function (item) {
                            var option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item.name;

                            if (selectedId && String(item.id) === String(selectedId)) {
                                option.selected = true;
                            }

                            subcategorySelect.appendChild(option);
                        });
                    })
                    .catch(function () {
                        resetSubcategories('Erreur de chargement, réessayez', true);
                    });
            }

            categorySelect.addEventListener('change', function () {
                loadSubcategories(categorySelect.value, null);
            });

            if (categorySelect.value) {
                loadSubcategories(categorySelect.value, currentSubcategoryId);
            }
        })();
    </script>

@endsection
