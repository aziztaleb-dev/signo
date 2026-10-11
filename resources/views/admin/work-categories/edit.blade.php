@extends('admin.layouts.app')

@section('title', 'Modifier la catégorie')

@section('page-title', 'Modifier la catégorie de travaux')

@section('content')

    <div class="card">

        <form action="{{ route('admin.work-categories.update', $workCategory) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom de la catégorie</label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $workCategory->name) }}"
                    maxlength="255"
                >

                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">
                Enregistrer les modifications
            </button>

            <a href="{{ route('admin.work-categories.index') }}" class="btn btn-secondary">
                Annuler
            </a>

        </form>

    </div>

@endsection
