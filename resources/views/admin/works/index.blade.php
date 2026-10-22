@extends('admin.layouts.app')

@section('title', 'Travaux')

@section('page-title', 'Travaux')

@section('content')

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="error" style="margin-bottom:20px;">{{ session('error') }}</div>
    @endif

    <div class="card">

        {{-- Header du tableau --}}
        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
            gap:15px;
        ">

            <div>
                <h2 style="
                    margin:0;
                    font-size:17px;
                    font-weight:600;
                    color:#111827;
                ">
                    Liste des travaux
                </h2>

                <p style="
                    margin:5px 0 0;
                    font-size:13px;
                    color:#6b7280;
                ">
                    @if($search !== '')
                        {{ $works->total() }} résultat(s) pour « {{ $search }} »
                    @else
                        {{ $works->total() }} travail(aux)
                    @endif
                </p>
            </div>

            <a href="{{ route('admin.works.create') }}" class="btn">
                <svg
                    width="17"
                    height="17"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M12 5v14"></path>
                    <path d="M5 12h14"></path>
                </svg>

                Nouveau travail
            </a>

        </div>

        {{-- Barre de recherche --}}
        <form
            action="{{ route('admin.works.index') }}"
            method="GET"
            style="
        display:flex;
        align-items:center;
        gap:10px;
        margin-bottom:20px;
    "
        >
            <div style="
        position:relative;
        flex:1;
        max-width:450px;
    ">
                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    style="
                position:absolute;
                left:12px;
                top:50%;
                transform:translateY(-50%);
                color:#9ca3af;
                pointer-events:none;
            "
                >
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>

                <input
                    type="search"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Rechercher par nom, nom anglais ou slug..."
                    style="
                width:100%;
                box-sizing:border-box;
                padding:11px 12px 11px 40px;
                border:1px solid #e5e7eb;
                border-radius:8px;
                font-size:13px;
                color:#374151;
                outline:none;
                background:#fff;
            "
                >
            </div>

            <button type="submit" class="btn">
                Rechercher
            </button>

            @if($search !== '')
                <a
                    href="{{ route('admin.works.index') }}"
                    class="btn btn-secondary"
                    style="text-decoration:none;"
                >
                    Réinitialiser
                </a>
            @endif
        </form>

        {{-- Tableau --}}
        <div class="table-responsive" style="overflow-x:auto;">

            <table>

                <thead>
                <tr>
                    <th style="width:90px;">Album</th>
                    <th>Travail</th>
                    <th>Catégorie</th>
                    <th>Date</th>
                    <th style="width:180px;">Actions</th>
                </tr>
                </thead>

                <tbody>

                @forelse($works as $work)

                    @php
                        $workImages = $work->images ?? [];
                    @endphp

                    <tr>

                        {{-- Album --}}
                        <td>

                            @if (count($workImages) > 0)

                                <div style="position:relative; width:52px; height:52px;">

                                    <img
                                        src="{{ asset('storage-files/' . $workImages[0]) }}"
                                        alt="{{ $work->title }}"
                                        style="
                                            width:52px;
                                            height:52px;
                                            object-fit:cover;
                                            border-radius:8px;
                                            display:block;
                                        "
                                    >

                                    @if (count($workImages) > 1)
                                        <span style="
                                            position:absolute;
                                            right:-6px;
                                            bottom:-6px;
                                            padding:2px 6px;
                                            border-radius:999px;
                                            background:#111827;
                                            color:#ffffff;
                                            font-size:10px;
                                            font-weight:600;
                                        ">
                                            +{{ count($workImages) - 1 }}
                                        </span>
                                    @endif

                                </div>

                            @else

                                <div style="
                                    width:52px;
                                    height:52px;
                                    border-radius:8px;
                                    background:#f1f5f9;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    color:#94a3b8;
                                ">
                                    <svg
                                        width="21"
                                        height="21"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <path d="M21 15l-5-5L5 21"></path>
                                    </svg>
                                </div>

                            @endif

                        </td>

                        {{-- Titre + description --}}
                        <td>

                            <div style="
                                font-weight:600;
                                color:#1f2937;
                                margin-bottom:4px;
                            ">
                                {{ $work->title }}
                            </div>

                            @if($work->description)

                                <div style="
                                    max-width:350px;
                                    color:#6b7280;
                                    font-size:12px;
                                    line-height:1.5;
                                    display:-webkit-box;
                                    -webkit-line-clamp:2;
                                    -webkit-box-orient:vertical;
                                    overflow:hidden;
                                ">
                                    {{ $work->description }}
                                </div>

                            @endif

                        </td>

                        {{-- Catégorie / Sous-catégorie --}}
                        <td>

                            <div style="
                                font-weight:600;
                                color:#374151;
                                font-size:13px;
                            ">
                                {{ $work->subcategory->category->name }}
                            </div>

                            <span style="
                                display:inline-flex;
                                align-items:center;
                                margin-top:5px;
                                padding:4px 9px;
                                border-radius:999px;
                                background:#f1f5f9;
                                color:#374151;
                                font-size:12px;
                                font-weight:600;
                            ">
                                {{ $work->subcategory->name }}
                            </span>

                        </td>

                        {{-- Date --}}
                        <td style="white-space:nowrap;">

                            <div style="
                                color:#374151;
                                font-size:13px;
                            ">
                                {{ $work->created_at->format('d/m/Y') }}
                            </div>

                            <div style="
                                color:#9ca3af;
                                font-size:11px;
                                margin-top:2px;
                            ">
                                {{ $work->created_at->format('H:i') }}
                            </div>

                        </td>

                        {{-- Actions --}}
                        <td>

                            <div style="
                                display:flex;
                                align-items:center;
                                gap:7px;
                            ">

                                {{-- Modifier --}}
                                <a
                                    href="{{ route('admin.works.edit', $work) }}"
                                    class="btn btn-secondary"
                                    style="
                                        padding:8px 10px;
                                        font-size:12px;
                                    "
                                >
                                    <svg
                                        width="15"
                                        height="15"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path d="M12 20h9"></path>
                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                                    </svg>

                                    Modifier
                                </a>

                                {{-- Supprimer --}}
                                <form
                                    action="{{ route('admin.works.destroy', $work) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce travail ?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                        style="
                                            padding:8px 10px;
                                            font-size:12px;
                                        "
                                    >
                                        <svg
                                            width="15"
                                            height="15"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path d="M3 6h18"></path>
                                            <path d="M8 6V4h8v2"></path>
                                            <path d="M19 6l-1 14H6L5 6"></path>
                                            <path d="M10 11v5"></path>
                                            <path d="M14 11v5"></path>
                                        </svg>

                                        Supprimer
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            style="
                                text-align:center;
                                padding:60px 20px;
                            "
                        >

                            <div style="
                                font-size:15px;
                                font-weight:600;
                                color:#374151;
                            ">
                                Aucun travail
                            </div>

                            <div style="
                                margin-top:5px;
                                font-size:13px;
                                color:#9ca3af;
                            ">
                            </div>

                            <div style="margin-top:18px;">
                                <a href="{{ route('admin.works.create') }}" class="btn">
                                    + Nouveau travail
                                </a>
                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if($works->hasPages())

            <div style="
                margin-top:22px;
                padding-top:18px;
                border-top:1px solid #f0f1f3;
            ">
                {{ $works->links('vendor.pagination.admin') }}
            </div>

        @endif

    </div>

@endsection
