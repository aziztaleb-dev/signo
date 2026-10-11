@extends('admin.layouts.app')

@section('title', 'Message de contact')

@section('page-title', 'Message de contact')

@section('content')

    <div class="card">

        <div style="
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
            gap:20px;
            margin-bottom:24px;
        ">

            <div>
                <div style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase;">
                    Nom
                </div>
                <div style="margin-top:5px; font-weight:600; color:#1f2937;">
                    {{ $contactMessage->name }}
                </div>
            </div>

            <div>
                <div style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase;">
                    Email
                </div>
                <div style="margin-top:5px;">
                    <a
                        href="mailto:{{ $contactMessage->email }}"
                        style="color:var(--primary); text-decoration:none; font-weight:600;"
                    >
                        {{ $contactMessage->email }}
                    </a>
                </div>
            </div>

            <div>
                <div style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase;">
                    Téléphone
                </div>
                <div style="margin-top:5px; color:#1f2937;">
                    @if ($contactMessage->phone)
                        <a
                            href="tel:{{ $contactMessage->phone }}"
                            style="color:inherit; text-decoration:none;"
                        >
                            {{ $contactMessage->phone }}
                        </a>
                    @else
                        -
                    @endif
                </div>
            </div>

            <div>
                <div style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase;">
                    Reçu le
                </div>
                <div style="margin-top:5px; color:#1f2937;">
                    {{ $contactMessage->created_at->format('d/m/Y à H:i') }}
                </div>
            </div>

        </div>

        <div style="margin-bottom:24px;">
            <div style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase;">
                Sujet
            </div>
            <div style="margin-top:5px; font-weight:600; color:#1f2937;">
                {{ $contactMessage->subject ?: '-' }}
            </div>
        </div>

        <div style="margin-bottom:24px;">
            <div style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase;">
                Message
            </div>
            <div style="
                margin-top:8px;
                padding:16px;
                border:1px solid #e5e7eb;
                border-radius:8px;
                background:#f8fafc;
                color:#1f2937;
                line-height:1.7;
            ">
                {!! nl2br(e($contactMessage->message)) !!}
            </div>
        </div>

        <div style="display:flex; gap:8px; flex-wrap:wrap;">

            <a
                href="mailto:{{ $contactMessage->email }}?subject={{ rawurlencode('Re: ' . ($contactMessage->subject ?: 'Votre message')) }}"
                class="btn"
            >
                Répondre par email
            </a>

            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">
                Retour à la liste
            </a>

            <form
                action="{{ route('admin.contact-messages.destroy', $contactMessage) }}"
                method="POST"
                style="display:inline;"
                onsubmit="return confirm('Voulez-vous vraiment supprimer ce message ?')"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    Supprimer
                </button>
            </form>

        </div>

    </div>

@endsection
