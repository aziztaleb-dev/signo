@extends('admin.layouts.app')

@section('title', 'Modifier la sous-catégorie')

@section('page-title', 'Modifier la sous-catégorie de travaux')

@section('content')

    <div class="card">

        <form action="{{ route('admin.work-subcategories.update', $workSubcategory) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="work_category_id">Catégorie</label>

                <select name="work_category_id" id="work_category_id">

                    <option value="">
                        -- Sélectionner une catégorie --
                    </option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(old('work_category_id', $workSubcategory->work_category_id) == $category->id)
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>

                @error('work_category_id')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Nom de la sous-catégorie</label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $workSubcategory->name) }}"
                    maxlength="255"
                >

                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">
                Enregistrer les modifications
            </button>

            <a href="{{ route('admin.work-subcategories.index') }}" class="btn btn-secondary">
                Annuler
            </a>

        </form>

    </div>

@endsection
