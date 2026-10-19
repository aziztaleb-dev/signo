@extends('admin.layouts.app')

@section('title', 'Modifier le projet')

@section('page-title', 'Modifier le projet')

@section('content')


    <div class="card">

        <form
            action="{{ route('admin.projects.update', $project) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titre</label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $project->title) }}"
                    maxlength="255"
                >

                @error('title')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>

                @if (!empty($project->image))
                    <div style="margin:8px 0 12px;">
                        <img
                            src="{{ asset('storage/' . $project->image) }}"
                            alt="{{ $project->title }}"
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
                <label>Références clients</label>

                <div id="clients-wrapper">

                    @php
                        $currentClients = old('clients', $project->clients ?? []);
                        if (empty($currentClients)) {
                            $currentClients = [''];
                        }
                    @endphp

                    @foreach ($currentClients as $client)
                        <div class="client-row">

                            <button
                                type="button"
                                class="client-drag-handle"
                                aria-label="Déplacer cette référence"
                                title="Glisser pour réorganiser"
                            >
                                <svg
                                    width="18"
                                    height="18"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <circle cx="9" cy="5" r="1.5"></circle>
                                    <circle cx="15" cy="5" r="1.5"></circle>
                                    <circle cx="9" cy="12" r="1.5"></circle>
                                    <circle cx="15" cy="12" r="1.5"></circle>
                                    <circle cx="9" cy="19" r="1.5"></circle>
                                    <circle cx="15" cy="19" r="1.5"></circle>
                                </svg>
                            </button>

                            <input
                                type="text"
                                name="clients[]"
                                value="{{ $client }}"
                                maxlength="255"
                                placeholder="Ex : BIAT"
                            >

                            <button
                                type="button"
                                class="btn btn-danger remove-client"
                                style="padding:10px 12px; font-size:12px;"
                            >
                                Retirer
                            </button>

                        </div>
                    @endforeach

                </div>

                <button
                    type="button"
                    id="add-client"
                    class="btn btn-secondary"
                    style="margin-top:12px; padding:8px 12px; font-size:12px;"
                >
                    + Ajouter une référence
                </button>

                @error('clients')
                <div class="error">{{ $message }}</div>
                @enderror

                @foreach ($errors->get('clients.*') as $messages)
                    @foreach ($messages as $message)
                        <div class="error">{{ $message }}</div>
                    @endforeach
                @endforeach
            </div>

            <button type="submit" class="btn">
                Enregistrer les modifications
            </button>

            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                Annuler
            </a>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>

    <script>
        (function () {
            const wrapper = document.getElementById('clients-wrapper');
            const addButton = document.getElementById('add-client');

            if (!wrapper || !addButton) {
                return;
            }

            // Activer le drag & drop.
            Sortable.create(wrapper, {
                animation: 180,
                handle: '.client-drag-handle',
                draggable: '.client-row',
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                forceFallback: false,
                fallbackTolerance: 5
            });

            // Créer une nouvelle référence.
            function createRow() {
                const row = document.createElement('div');

                row.className = 'client-row';

                row.innerHTML = `
                <button
                    type="button"
                    class="client-drag-handle"
                    aria-label="Déplacer cette référence"
                    title="Glisser pour réorganiser"
                >
                    <svg
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        aria-hidden="true"
                    >
                        <circle cx="9" cy="5" r="1.5"></circle>
                        <circle cx="15" cy="5" r="1.5"></circle>
                        <circle cx="9" cy="12" r="1.5"></circle>
                        <circle cx="15" cy="12" r="1.5"></circle>
                        <circle cx="9" cy="19" r="1.5"></circle>
                        <circle cx="15" cy="19" r="1.5"></circle>
                    </svg>
                </button>

                <input
                    type="text"
                    name="clients[]"
                    maxlength="255"
                    placeholder="Ex : BIAT"
                >

                <button
                    type="button"
                    class="btn btn-danger remove-client"
                    style="padding:10px 12px; font-size:12px;"
                >
                    Retirer
                </button>
            `;

                return row;
            }

            // Ajouter une référence.
            addButton.addEventListener('click', function () {
                const row = createRow();

                wrapper.appendChild(row);
                row.querySelector('input').focus();
            });

            // Supprimer une référence.
            wrapper.addEventListener('click', function (event) {
                const button = event.target.closest('.remove-client');

                if (!button) {
                    return;
                }

                const rows = wrapper.querySelectorAll('.client-row');
                const row = button.closest('.client-row');

                if (rows.length > 1) {
                    row.remove();
                } else {
                    row.querySelector('input').value = '';
                }
            });
        })();
    </script>

@endsection
