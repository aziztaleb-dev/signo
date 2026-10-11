@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Cartes de statistiques --}}
    <div style="
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
        gap:20px;
        margin-bottom:24px;
    ">

        @foreach ($stats as $stat)

            <a
                href="{{ $stat['route'] }}"
                class="card"
                style="
                    display:flex;
                    align-items:center;
                    justify-content:space-between;
                    gap:15px;
                    text-decoration:none;
                "
            >

                <div>
                    <div style="
                        font-size:13px;
                        font-weight:600;
                        color:#6b7280;
                    ">
                        {{ $stat['label'] }}
                    </div>

                    <div style="
                        margin-top:8px;
                        font-size:32px;
                        font-weight:700;
                        line-height:1;
                        color:#111827;
                    ">
                        {{ $stat['count'] }}
                    </div>
                </div>

                <div style="
                    width:48px;
                    height:48px;
                    border-radius:12px;
                    background:var(--primary);
                    color:#ffffff;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    flex-shrink:0;
                ">
                    <svg
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        @if ($stat['icon'] === 'news')
                            <path d="M4 4h16v16H4z"></path>
                            <path d="M8 8h8"></path>
                            <path d="M8 12h8"></path>
                            <path d="M8 16h5"></path>
                        @elseif ($stat['icon'] === 'box')
                            <path d="M21 8l-9-5-9 5v8l9 5 9-5z"></path>
                            <path d="M3 8l9 5 9-5"></path>
                            <path d="M12 13v8"></path>
                        @elseif ($stat['icon'] === 'briefcase')
                            <rect x="3" y="7" width="18" height="13" rx="2"></rect>
                            <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            <path d="M3 13h18"></path>
                        @elseif ($stat['icon'] === 'folder')
                            <path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        @elseif ($stat['icon'] === 'list')
                            <path d="M4 6h16"></path>
                            <path d="M8 12h12"></path>
                            <path d="M12 18h8"></path>
                        @elseif ($stat['icon'] === 'mail')
                            <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                            <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
                        @else
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <path d="M21 15l-5-5L5 21"></path>
                        @endif
                    </svg>
                </div>

            </a>

        @endforeach

    </div>

    {{-- Derniers ajouts --}}
    <div class="card">

        <div style="margin-bottom:20px;">
            <h2 style="
                margin:0;
                font-size:17px;
                font-weight:600;
                color:#111827;
            ">
                Derniers ajouts
            </h2>

            <p style="
                margin:5px 0 0;
                font-size:13px;
                color:#6b7280;
            ">
                Les 5 derniers éléments créés, tous modules confondus.
            </p>
        </div>

        <div style="overflow-x:auto;">

            <table>

                <thead>
                <tr>
                    <th>Type</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th style="width:120px;">Action</th>
                </tr>
                </thead>

                <tbody>

                @forelse ($latest as $item)

                    <tr>

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
                                {{ $item['type'] }}
                            </span>
                        </td>

                        <td>
                            <div style="
                                font-weight:600;
                                color:#1f2937;
                            ">
                                {{ $item['title'] }}
                            </div>
                        </td>

                        <td style="white-space:nowrap;">

                            <div style="
                                color:#374151;
                                font-size:13px;
                            ">
                                {{ $item['date']->format('d/m/Y') }}
                            </div>

                            <div style="
                                color:#9ca3af;
                                font-size:11px;
                                margin-top:2px;
                            ">
                                {{ $item['date']->format('H:i') }}
                            </div>

                        </td>

                        <td>
                            <a
                                href="{{ $item['url'] }}"
                                class="btn btn-secondary"
                                style="
                                    padding:8px 10px;
                                    font-size:12px;
                                "
                            >
                                Modifier
                            </a>
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="4"
                            style="
                                text-align:center;
                                padding:50px 20px;
                            "
                        >
                            <div style="
                                font-size:15px;
                                font-weight:600;
                                color:#374151;
                            ">
                                Aucun contenu pour le moment
                            </div>

                            <div style="
                                margin-top:5px;
                                font-size:13px;
                                color:#9ca3af;
                            ">
                                Les derniers éléments créés apparaîtront ici.
                            </div>
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection
