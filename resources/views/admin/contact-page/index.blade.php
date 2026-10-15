@extends('admin.layouts.app')

@section('title', 'Contenu de la page Contact')
@section('page-title', 'Contenu de la page Contact')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3>Sections de la page Contact</h3>
        </div>
        <div class="card-body">
            <p>
                Gérez ici les coordonnées, les horaires, les liens des réseaux
                sociaux et les autres informations affichées sur la page Contact.
            </p>
            <div style="overflow-x:auto;">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Section</th>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($sections as $section)
                        <tr>
                            <td>{{ $section->name }}</td>
                            <td>{{ $section->title ?: 'Sans titre' }}</td>
                            <td>
                                @if ($section->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Désactivée</span>
                                @endif
                            </td>
                            <td>
                                {{ $section->image ? 'Oui' : 'Non' }}
                            </td>
                            <td>
                                <a
                                    href="{{ route('admin.contact-page.edit', $section) }}"
                                    class="btn"
                                >
                                    Modifier
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                Aucune section disponible.
                                Lancez ContactPageSettingSeeder.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
