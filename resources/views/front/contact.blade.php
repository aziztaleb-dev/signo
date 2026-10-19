@extends('front.layouts.app')

@section('title', 'Contact - Signo')

@section('description', 'Contactez SIGNO, spécialiste de la signalétique, du conseil, des études et de la production en Tunisie.')

@section('content')

    @php
        use Illuminate\Support\Facades\Storage;
        $banner = $sections->get('banner');
        $address = $sections->get('address');
        $phones = $sections->get('phones');
        $email = $sections->get('email');
        $hours = $sections->get('hours');
        $map = $sections->get('map');
        $form = $sections->get('form');
        $social = $sections->get('social');
        $imageUrl = function ($path) {
            if (!$path) {
                return null;
            }
            if (
                str_starts_with($path, 'assets/') ||
                str_starts_with($path, 'http://') ||
                str_starts_with($path, 'https://') ||
                str_starts_with($path, '/')
            ) {
                return str_starts_with($path, 'assets/')
                    ? asset($path)
                    : $path;
            }
            return Storage::disk('public')->url($path);
        };
        $socialLinks = $social?->data ?? [];
        $phoneNumbers = $phones?->data['phones'] ?? [];
    @endphp
    {{-- BANNIÈRE --}}
    @if ($banner)
        <section
            class="news-banner"
            style="background-image:linear-gradient(var(--banner-shade), var(--banner-shade)),url('{{ $imageUrl($banner->image) }}');"
        >
            <h1>{{ $banner->title }}</h1>
        </section>
    @endif
    {{-- INFORMATIONS DE CONTACT --}}
    <section class="contact-section">
        <div class="content-width">
            <div class="contact-infos">
                {{-- ADRESSE --}}
                @if ($address)
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 21s7-6.1 7-12a7 7 0 1 0-14 0c0 5.9 7 12 7 12z"/>
                                <circle cx="12" cy="9" r="2.5"/>
                            </svg>
                        </div>
                        <div class="contact-info-content">
                            <h2>{{ $address->title }}</h2>
                            <p>
                                {!! nl2br(e($address->content)) !!}
                            </p>
                        </div>
                    </div>
                @endif
                {{-- TÉLÉPHONES --}}
                @if ($phones)
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M6.6 3.5l3 3.2-1.9 2.5c1 2 2.6 3.6 4.6 4.6l2.5-1.9 3.2 3c.6.6.6 1.5.1 2.1l-1.4 1.7c-.5.6-1.3.9-2 .7-3.2-.9-6.2-2.7-8.6-5.1s-4.2-5.4-5.1-8.6c-.2-.7.1-1.5.7-2l1.7-1.4c.6-.5 1.5-.5 2.1.1z"/>
                            </svg>
                        </div>
                        <div class="contact-info-content">
                            <h2>{{ $phones->title }}</h2>
                            <p>
                                @foreach ($phoneNumbers as $index => $phone)
                                    @if (!empty($phone['label']))
                                        <a href="tel:{{ $phone['value'] ?? $phone['label'] }}">
                                            {{ $phone['label'] }}
                                        </a>
                                    @endif
                                    @if ($index < count($phoneNumbers) - 1)
                                        <br>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                @endif
                {{-- EMAIL --}}
                @if ($email)
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="14" rx="2"/>
                                <path d="M4 7l8 6 8-6"/>
                            </svg>
                        </div>
                        <div class="contact-info-content">
                            <h2>{{ $email->title }}</h2>
                            <p>
                                <a href="mailto:{{ $email->content }}">
                                    {{ $email->content }}
                                </a>
                            </p>
                        </div>
                    </div>
                @endif
                {{-- HORAIRES --}}
                @if ($hours)
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>
                        </div>
                        <div class="contact-info-content">
                            <h2>{{ $hours->title }}</h2>
                            <p style="font-size: 13px">
                                {!! nl2br(e($hours->content)) !!}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
            {{-- CARTE ET FORMULAIRE --}}
            <div class="contact-main">
                {{-- GOOGLE MAPS --}}
                @if ($map && $map->content)
                    <div class="contact-map">
                        <iframe
                            src="{{ $map->content }}"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Localisation de SIGNO"
                        ></iframe>
                    </div>
                @endif
                {{-- FORMULAIRE --}}
                @if ($form)
                    <div class="contact-form-wrapper" id="contact-form">
                        <h2 class="section-title">
                            {{ $form->title }}
                        </h2>
                        <p class="contact-form-intro">
                            {{ $form->content }}
                        </p>
                        @if (session('contact_success'))
                            <div
                                role="status"
                                style="margin-bottom:20px;padding:12px 15px;border:1px solid #bbf7d0;border-radius:8px;background:#f0fdf4;color:#166534;font-size:14px;"
                            >
                                {{ session('contact_success') }}
                            </div>
                        @endif
                        <form
                            class="contact-form"
                            action="{{ route('contact.store') }}"
                            method="POST"
                        >
                            @csrf
                            <div class="contact-form-row">
                                <div class="contact-field">
                                    <label for="name">Nom</label>
                                    <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        placeholder="Votre nom"
                                        value="{{ old('name') }}"
                                    >
                                    @error('name')
                                    <small style="color:#dc2626;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="contact-field">
                                    <label for="email">Email</label>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        placeholder="Votre adresse email"
                                        value="{{ old('email') }}"
                                    >
                                    @error('email')
                                    <small style="color:#dc2626;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="contact-field">
                                <label for="phone">Téléphone</label>
                                <input
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    placeholder="Votre numéro de téléphone"
                                    value="{{ old('phone') }}"
                                >
                                @error('phone')
                                <small style="color:#dc2626;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="contact-field">
                                <label for="subject">Sujet</label>
                                <input
                                    id="subject"
                                    name="subject"
                                    type="text"
                                    placeholder="Objet de votre demande"
                                    value="{{ old('subject') }}"
                                >
                                @error('subject')
                                <small style="color:#dc2626;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="contact-field">
                                <label for="message">Message</label>
                                <textarea
                                    id="message"
                                    name="message"
                                    rows="6"
                                    placeholder="Votre message"
                                >{{ old('message') }}</textarea>
                                @error('message')
                                <small style="color:#dc2626;">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="contact-submit">
                                {{ $form->data['button_text'] ?? 'Envoyer le message' }}
                            </button>
                        </form>
                    </div>
                @endif
            </div>
            {{-- RÉSEAUX SOCIAUX --}}
            @if ($social)
                <div class="contact-social">
                    @foreach ([
                        'facebook' => 'Facebook',
                        'pinterest' => 'Pinterest',
                        'instagram' => 'Instagram',
                        'whatsapp' => 'WhatsApp',
                    ] as $key => $label)
                        @if (!empty($socialLinks[$key]))
                            <a
                                aria-label="{{ $label }}"
                                href="{{ $socialLinks[$key] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                @if ($key === 'facebook')
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M14 8h3V4h-3c-3.31 0-5 1.69-5 5v3H6v4h3v8h4v-8h3l1-4h-4V9c0-.67.33-1 1-1z"/>
                                    </svg>
                                @elseif ($key === 'pinterest')
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M12 2a10 10 0 0 0-3.64 19.31c-.09-1.64-.02-3.61.41-5.49l1.05-4.44s-.27-.54-.27-1.34c0-1.25.73-2.19 1.64-2.19.77 0 1.14.58 1.14 1.28 0 .78-.5 1.95-.76 3.04-.22.91.46 1.65 1.36 1.65 1.63 0 2.88-1.72 2.88-4.2 0-2.2-1.58-3.74-3.84-3.74-2.62 0-4.16 1.97-4.16 4 0 .79.3 1.64.68 2.1.07.09.08.17.06.27l-.25 1.03c-.04.17-.14.21-.32.13-1.2-.56-1.95-2.31-1.95-3.72 0-3.03 2.2-5.81 6.35-5.81 3.33 0 5.92 2.37 5.92 5.53 0 3.3-2.08 5.95-4.97 5.95-.97 0-1.88-.5-2.19-1.1l-.6 2.27c-.22.83-.82 1.87-1.22 2.5.92.28 1.89.43 2.89.43A10 10 0 1 0 12 2z"/>
                                    </svg>
                                @elseif ($key === 'instagram')
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="3" y="3" width="18" height="18" rx="5"/>
                                        <circle cx="12" cy="12" r="4"/>
                                        <circle cx="17.5" cy="6.5" r="1" class="social-dot"/>
                                    </svg>
                                @elseif ($key === 'whatsapp')
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M20.5 3.5A11.9 11.9 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.09 1.6 5.82L0 24l6.35-1.67A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.21-1.25-6.23-3.5-8.5zM12 21.9c-1.87 0-3.7-.5-5.3-1.45l-.38-.22-3.77.99 1.01-3.67-.25-.39A9.85 9.85 0 1 1 12 21.9z"/>
                                        <path d="M17.25 14.55c-.29-.15-1.72-.85-1.99-.95-.27-.1-.46-.15-.65.15-.19.29-.75.95-.92 1.14-.17.19-.34.22-.63.07-.29-.15-1.22-.45-2.32-1.43-.86-.77-1.44-1.72-1.61-2.01-.17-.29-.02-.45.13-.6.13-.13.29-.34.43-.51.15-.17.19-.29.29-.48.1-.19.05-.36-.02-.51-.07-.15-.65-1.57-.89-2.15-.24-.57-.48-.5-.65-.51h-.55c-.19 0-.51.07-.77.36-.27.29-1.01.99-1.01 2.42 0 1.43 1.04 2.81 1.19 3 .15.19 2.05 3.13 4.97 4.39.69.3 1.23.48 1.65.61.56-.08 1.72-.7 1.96-1.38.24-.68.24-1.26.17-1.38-.07-.12-.27-.19-.55-.34z"/>
                                    </svg>
                                @endif
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    @if ($errors->any() || session('contact_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var form = document.getElementById('contact-form');
                if (form) {
                    form.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        </script>
    @endif

@endsection
