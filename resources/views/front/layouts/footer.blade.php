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


            <a class="footer-contact-line" href="tel:+21670730491">
                +216 70 730 491
            </a>

            <a class="footer-contact-line" href="tel:+21670730485">
                +216 70 730 485
            </a>

            <a
                class="footer-contact-line"
                href="mailto:signo@signo.com.tn"
            >
                signo@signo.com.tn
            </a>


            <p class="footer-contact-line">
                15 rue El Ifada - 2080 Ariana - Tunisie
            </p>

        </div>

    </div>


    <div class="footer-bottom">

        © {{ date('Y') }} Signo.
        Tous les droits sont réservés.

    </div>

</footer>
