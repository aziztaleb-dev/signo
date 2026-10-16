@extends('admin.layouts.app')

@section('title', 'Sous-catégories de travaux')

@section('page-title', 'Sous-catégories de travaux')

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
                    Liste des sous-catégories
                </h2>

                <p style="
                    margin:5px 0 0;
                    font-size:13px;
                    color:#6b7280;
                ">
                    {{ $workSubcategories->total() }} sous-catégorie(s)
                </p>
            </div>

            <a href="{{ route('admin.work-subcategories.create') }}" class="btn">
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

                Nouvelle sous-catégorie
            </a>

        </div>

        {{-- Tableau --}}
        <div class="table-responsive" style="overflow-x:auto;">

            <table>

                <thead>
                <tr>
                    <th>Sous-catégorie</th>
                    <th>Catégorie</th>
                    <th>Date</th>
                    <th style="width:180px;">Actions</th>
                </tr>
                </thead>

                <tbody>

                @forelse($workSubcategories as $workSubcategory)

                    <tr>

                        {{-- Nom --}}
                        <td>
                            <div style="
                                font-weight:600;
                                color:#1f2937;
                            ">
                                {{ $workSubcategory->name }}
                            </div>
                        </td>

                        {{-- Catégorie --}}
                        <td>
                            <span style="
                                display:inline-flex;
                                align-items:center;
                                padding:5px 9px;
                                border-radius:999px;
                                background:#f1f5f9;
                                color:#374151;
                                font-size:12px;
                                font-weight:600;
                            ">
                                {{ $workSubcategory->category->name }}
                            </span>
                        </td>

                        {{-- Date --}}
                        <td style="white-space:nowrap;">

                            <div style="
                                color:#374151;
                                font-size:13px;
                            ">
                                {{ $workSubcategory->created_at->format('d/m/Y') }}
                            </div>

                            <div style="
                                color:#9ca3af;
                                font-size:11px;
                                margin-top:2px;
                            ">
                                {{ $workSubcategory->created_at->format('H:i') }}
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
                                    href="{{ route('admin.work-subcategories.edit', $workSubcategory) }}"
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
                                    action="{{ route('admin.work-subcategories.destroy', $workSubcategory) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer cette sous-catégorie ?')"
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
                            colspan="4"
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
                                Aucune sous-catégorie
                            </div>

                            <div style="
                                margin-top:5px;
                                font-size:13px;
                                color:#9ca3af;
                            ">
                                Commencez par créer votre première sous-catégorie.
                            </div>

                            <div style="margin-top:18px;">
                                <a href="{{ route('admin.work-subcategories.create') }}" class="btn">
                                    + Nouvelle sous-catégorie
                                </a>
                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if($workSubcategories->hasPages())

            <div style="
                margin-top:22px;
                padding-top:18px;
                border-top:1px solid #f0f1f3;
            ">
                {{ $workSubcategories->links('vendor.pagination.admin') }}
            </div>

        @endif

    </div>

@endsection
