@extends('admin.layouts.app')

@section('title', 'Nouveaux produits')

@section('page-title', 'Nouveaux produits')

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
                    Liste des nouveaux produits
                </h2>

                <p style="
                    margin:5px 0 0;
                    font-size:13px;
                    color:#6b7280;
                ">
                    {{ $newProducts->total() }} produit(s)
                </p>
            </div>

            <a href="{{ route('admin.new-products.create') }}" class="btn">
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

                Nouveau produit
            </a>

        </div>

        {{-- Tableau --}}
        <div class="table-responsive" style="overflow-x:auto;">

            <table>

                <thead>
                <tr>
                    <th style="width:90px;">Album</th>
                    <th>Produit</th>
                    <th>Fiche produit</th>
                    <th>Date</th>
                    <th style="width:180px;">Actions</th>
                </tr>
                </thead>

                <tbody>

                @forelse($newProducts as $product)

                    @php
                        $productImages = $product->images ?? [];
                    @endphp

                    <tr>

                        {{-- Album --}}
                        <td>

                            @if (count($productImages) > 0)

                                <div style="position:relative; width:52px; height:52px;">

                                    <img
                                        src="{{ asset('storage-files/' . $productImages[0]) }}"
                                        alt="{{ $product->name }}"
                                        style="
                                            width:52px;
                                            height:52px;
                                            object-fit:cover;
                                            border-radius:8px;
                                            display:block;
                                        "
                                    >

                                    @if (count($productImages) > 1)
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
                                            +{{ count($productImages) - 1 }}
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

                        {{-- Nom + description --}}
                        <td>

                            <div style="
                                font-weight:600;
                                color:#1f2937;
                                margin-bottom:4px;
                            ">
                                {{ $product->name }}
                            </div>

                            @if($product->description)

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
                                    {{ $product->description }}
                                </div>

                            @endif

                        </td>

                        {{-- PDF --}}
                        <td>

                            @if ($product->pdf)

                                <a
                                    href="{{ asset('storage-files/' . $product->pdf) }}"
                                    target="_blank"
                                    rel="noopener"
                                    style="
                                        display:inline-flex;
                                        align-items:center;
                                        gap:6px;
                                        color:#dc2626;
                                        font-size:13px;
                                        font-weight:600;
                                        text-decoration:none;
                                    "
                                >
                                    <svg
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <path d="M14 3v6h6"></path>
                                    </svg>

                                    Voir le PDF
                                </a>

                            @else

                                <span style="color:#9ca3af;">-</span>

                            @endif

                        </td>

                        {{-- Date --}}
                        <td style="white-space:nowrap;">

                            <div style="
                                color:#374151;
                                font-size:13px;
                            ">
                                {{ $product->created_at->format('d/m/Y') }}
                            </div>

                            <div style="
                                color:#9ca3af;
                                font-size:11px;
                                margin-top:2px;
                            ">
                                {{ $product->created_at->format('H:i') }}
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
                                    href="{{ route('admin.new-products.edit', $product) }}"
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
                                    action="{{ route('admin.new-products.destroy', $product) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?')"
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
                                Aucun nouveau produit
                            </div>

                            <div style="
                                margin-top:5px;
                                font-size:13px;
                                color:#9ca3af;
                            ">
                                Commencez par créer votre premier produit.
                            </div>

                            <div style="margin-top:18px;">
                                <a href="{{ route('admin.new-products.create') }}" class="btn">
                                    + Nouveau produit
                                </a>
                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if($newProducts->hasPages())

            <div style="
                margin-top:22px;
                padding-top:18px;
                border-top:1px solid #f0f1f3;
            ">
                {{ $newProducts->links('vendor.pagination.admin')}}
            </div>

        @endif

    </div>

@endsection
