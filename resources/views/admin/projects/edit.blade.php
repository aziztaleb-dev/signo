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
                        <div class="client-row" style="display:flex; gap:8px; align-items:center; margin-top:8px;">
                            <input
                                type="text"
                                name="clients[]"
                                value="{{ $client }}"
                                maxlength="255"
                                placeholder="Ex : BIAT"
                                style="margin:0;"
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

    <script>
        (function () {
            var wrapper = document.getElementById('clients-wrapper');
            var addButton = document.getElementById('add-client');

            function createRow() {
                var row = document.createElement('div');
                row.className = 'client-row';
                row.style.cssText = 'display:flex; gap:8px; align-items:center; margin-top:8px;';

                var input = document.createElement('input');
                input.type = 'text';
                input.name = 'clients[]';
                input.maxLength = 255;
                input.placeholder = 'Ex : BIAT';
                input.style.margin = '0';

                var button = document.createElement('button');
                button.type = 'button';
                button.className = 'btn btn-danger remove-client';
                button.style.cssText = 'padding:10px 12px; font-size:12px;';
                button.textContent = 'Retirer';

                row.appendChild(input);
                row.appendChild(button);

                return row;
            }

            addButton.addEventListener('click', function () {
                var row = createRow();
                wrapper.appendChild(row);
                row.querySelector('input').focus();
            });

            wrapper.addEventListener('click', function (event) {
                var button = event.target.closest('.remove-client');

                if (!button) {
                    return;
                }

                var rows = wrapper.querySelectorAll('.client-row');

                if (rows.length > 1) {
                    button.closest('.client-row').remove();
                } else {
                    rows[0].querySelector('input').value = '';
                }
            });
        })();
    </script>

@endsection
