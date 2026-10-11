@extends('admin.layouts.app')

@section('title', 'Nouveau travail')

@section('page-title', 'Nouveau travail')

@section('content')

    <div class="card">

        <form
            action="{{ route('admin.works.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="form-group">
                <label for="work_category_id">Catégorie</label>

                <select id="work_category_id">

                    <option value="">
                        -- Sélectionner une catégorie --
                    </option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(old('work_category_id') == $category->id)
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
                    value="{{ old('title') }}"
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
                    value="{{ old('title_en') }}"
                    maxlength="255"
                >

                @error('title_en')
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

            <button type="submit" class="btn">
                Créer le travail
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
            var oldSubcategoryId = "{{ old('work_subcategory_id') }}";

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
                loadSubcategories(categorySelect.value, oldSubcategoryId);
            }
        })();
    </script>

@endsection
