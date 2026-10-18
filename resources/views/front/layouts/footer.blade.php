@php
    $phoneNumbers = $phones?->data['phones'] ?? [];
    $email = $sections->get('email');
            $address = $sections->get('address');
@endphp
<footer
    class="site-footer"
    style="background-image:linear-gradient(var(--banner-shade), var(--banner-shade)),url('{{ asset('assets/images/footer.png') }}');">

    <div class="content-width footer-main">


        <a href="{{ route('home') }}">

            <img
                alt="SIGNO"
                class="footer-logo"
                src="{{ asset('assets/images/logo.png') }}"
            >

        </a>


        <div>

            <h2>
                LIENS UTILES
            </h2>

            <a href="{{ route('nouveautes') }}">
                NOUVEAUTÉS
            </a>

            <a href="{{ route('services') }}">
                NOS SERVICES
            </a>

            <a href="{{ route('projets') }}">
                NOS PROJETS
            </a>

            <a href="{{ route('contact') }}">
                CONTACT
            </a>

        </div>


        <div>

            <h2>
                NOUS JOINDRE
            </h2>
            @if ($phoneNumbers)
                @foreach ($phoneNumbers as $index => $phone)
                    @if (!empty($phone['label']))
                        <a class="footer-contact-line" href="tel:{{ $phone['value'] ?? $phone['label'] }}">
                            {{ $phone['label'] }}
                        </a>
                    @endif
                @endforeach
            @endif

            @if ($email)
                <a class="footer-contact-line" href="mailto:{{ $email->content }}">
                    {{ $email->content }}
                </a>
            @endif

            @if ($address)
                <p class="footer-contact-line">
                    {{ $address->content }}
                </p>
            @endif

        </div>

    </div>


    <div class="footer-bottom">

        © {{ date('Y') }} Signo.
        Tous les droits sont réservés.

    </div>

</footer>
