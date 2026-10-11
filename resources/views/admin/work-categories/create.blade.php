@extends('admin.layouts.app')

@section('title', 'Nouvelle catégorie')

@section('page-title', 'Nouvelle catégorie de travaux')

@section('content')

    <div class="card">

        <form action="{{ route('admin.work-categories.store') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="name">Nom de la catégorie</label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    maxlength="255"
                    placeholder="Ex : Hôtellerie & restauration"
                >

                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">
                Créer la catégorie
            </button>

            <a href="{{ route('admin.work-categories.index') }}" class="btn btn-secondary">
                Annuler
            </a>

        </form>

    </div>

@endsection
