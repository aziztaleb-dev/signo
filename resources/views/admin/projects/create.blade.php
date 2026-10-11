@extends('admin.layouts.app')

@section('title', 'Nouveau projet')

@section('page-title', 'Nouveau projet')

@section('content')

    <div class="card">

        <form
            action="{{ route('admin.projects.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

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
                <label for="image">Image</label>

                <input
                    type="file"
                    name="image"
                    id="image"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                @error('image')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Références clients</label>

                <div id="clients-wrapper">

                    @php
                        $oldClients = old('clients', ['']);
                        if (empty($oldClients)) {
                            $oldClients = [''];
                        }
                    @endphp

                    @foreach ($oldClients as $client)
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
                Créer le projet
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
