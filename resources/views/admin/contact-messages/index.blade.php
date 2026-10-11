@extends('admin.layouts.app')

@section('title', 'Messages de contact')

@section('page-title', 'Messages de contact')

@section('content')

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="card">

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
                    Liste des messages
                </h2>

                <p style="
                    margin:5px 0 0;
                    font-size:13px;
                    color:#6b7280;
                ">
                    {{ $contactMessages->total() }} message(s)
                </p>
            </div>
        </div>

        <div style="overflow-x:auto;">

            <table>

                <thead>
                <tr>
                    <th style="width:90px;">Statut</th>
                    <th>Expéditeur</th>
                    <th>Sujet</th>
                    <th>Date</th>
                    <th style="width:180px;">Actions</th>
                </tr>
                </thead>

                <tbody>

                @forelse ($contactMessages as $contactMessage)

                    <tr>

                        <td>
                            @if ($contactMessage->isRead())
                                <span style="
                                    display:inline-flex;
                                    padding:5px 9px;
                                    border-radius:999px;
                                    background:#f1f5f9;
                                    color:#6b7280;
                                    font-size:12px;
                                    font-weight:600;
                                ">
                                    Lu
                                </span>
                            @else
                                <span style="
                                    display:inline-flex;
                                    padding:5px 9px;
                                    border-radius:999px;
                                    background:var(--primary);
                                    color:#ffffff;
                                    font-size:12px;
                                    font-weight:600;
                                ">
                                    Nouveau
                                </span>
                            @endif
                        </td>

                        <td>
                            <div style="
                                font-weight:{{ $contactMessage->isRead() ? '500' : '700' }};
                                color:#1f2937;
                            ">
                                {{ $contactMessage->name }}
                            </div>

                            <div style="
                                margin-top:3px;
                                color:#6b7280;
                                font-size:12px;
                            ">
                                {{ $contactMessage->email }}
                            </div>
                        </td>

                        <td>
                            <div style="
                                max-width:350px;
                                color:#374151;
                                font-weight:{{ $contactMessage->isRead() ? '400' : '600' }};
                                display:-webkit-box;
                                -webkit-line-clamp:2;
                                -webkit-box-orient:vertical;
                                overflow:hidden;
                            ">
                                {{ $contactMessage->subject ?: \Illuminate\Support\Str::limit($contactMessage->message, 80) }}
                            </div>
                        </td>

                        <td style="white-space:nowrap;">
                            <div style="color:#374151; font-size:13px;">
                                {{ $contactMessage->created_at->format('d/m/Y') }}
                            </div>

                            <div style="color:#9ca3af; font-size:11px; margin-top:2px;">
                                {{ $contactMessage->created_at->format('H:i') }}
                            </div>
                        </td>

                        <td>
                            <div style="display:flex; align-items:center; gap:7px;">

                                <a
                                    href="{{ route('admin.contact-messages.show', $contactMessage) }}"
                                    class="btn btn-secondary"
                                    style="padding:8px 10px; font-size:12px;"
                                >
                                    Lire
                                </a>

                                <form
                                    action="{{ route('admin.contact-messages.destroy', $contactMessage) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce message ?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                        style="padding:8px 10px; font-size:12px;"
                                    >
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
                            style="text-align:center; padding:60px 20px;"
                        >
                            <div style="font-size:15px; font-weight:600; color:#374151;">
                                Aucun message
                            </div>

                            <div style="margin-top:5px; font-size:13px; color:#9ca3af;">
                                Les messages envoyés depuis le formulaire de contact apparaîtront ici.
                            </div>
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if ($contactMessages->hasPages())
            <div style="
                margin-top:22px;
                padding-top:18px;
                border-top:1px solid #f0f1f3;
            ">
                {{ $contactMessages->links('vendor.pagination.admin') }}
            </div>
        @endif

    </div>

@endsection
