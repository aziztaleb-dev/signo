@extends('admin.layouts.app')

@section('title', 'Contenu de la page d’accueil')

@section('page-title', 'Contenu de la page d’accueil')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <h3>Sections de la page d’accueil</h3>
        </div>

        <div class="card-body">

            <p>
                Gérez ici les textes, les images et les galeries affichés sur
                la page d’accueil de votre site.
            </p>

            <div class="table-responsive" style="overflow-x:auto;">

                <table class="table">

                    <thead>
                    <tr>
                        <th>Section</th>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th>Images</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse ($sections as $section)

                        <tr>

                            <td>
                                {{ $section->name }}
                            </td>

                            <td>
                                {{ $section->title ?: 'Sans titre' }}
                            </td>

                            <td>
                                @if ($section->is_active)
                                    <span class="badge bg-success">
                                            Active
                                        </span>
                                @else
                                    <span class="badge bg-secondary">
                                            Désactivée
                                        </span>
                                @endif
                            </td>

                            <td>
                                {{ ($section->image ? 1 : 0) + count($section->gallery ?? []) }}
                            </td>

                            <td>
                                <a
                                    href="{{ route('admin.home-page.edit', $section) }}"
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
                                Lancez le seeder HomePageSectionSeeder.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
