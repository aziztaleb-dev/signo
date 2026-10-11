@extends('front.layouts.app')

@section('title', 'Page introuvable - Signo')

@section('description', 'La page que vous recherchez est introuvable.')

@section('content')

    <section
        aria-label="Erreur 404"
        style="
            padding:100px 20px;
            text-align:center;
        "
    >

        <div
            style="
                max-width:620px;
                margin:0 auto;
            "
        >

            <div
                style="
                    font-size:clamp(90px, 18vw, 160px);
                    font-weight:800;
                    line-height:1;
                    letter-spacing:-.04em;
                    color:var(--primary, #d32f2f);
                "
            >
                404
            </div>

            <h2
                style="
                    margin:20px 0 12px;
                    font-size:26px;
                    font-weight:700;
                    color:#ffffff;
                "
            >
                Oups, cette page n'existe pas
            </h2>

            <p
                style="
                    margin:0 0 32px;
                    font-size:16px;
                    line-height:1.7;
                    color:#ffffff;
                "
            >
                La page que vous recherchez a peut-être été déplacée,
                supprimée, ou l'adresse saisie est incorrecte.
            </p>

            <div
                style="
                    display:flex;
                    flex-wrap:wrap;
                    justify-content:center;
                    gap:12px;
                "
            >

                <a
                    href="{{ route('home') }}"
                    style="
                        display:inline-flex;
                        align-items:center;
                        justify-content:center;
                        padding:14px 28px;
                        border-radius:8px;
                        background:var(--primary, #d32f2f);
                        color:#ffffff;
                        font-size:14px;
                        font-weight:700;
                        letter-spacing:.04em;
                        text-decoration:none;
                    "
                >
                    RETOUR À L'ACCUEIL
                </a>

                <a
                    href="{{ route('contact') }}"
                    style="
                        display:inline-flex;
                        align-items:center;
                        justify-content:center;
                        padding:14px 28px;
                        border:2px solid #ffffff;
                        border-radius:8px;
                        background:transparent;
                        color:#ffffff;
                        font-size:14px;
                        font-weight:700;
                        letter-spacing:.04em;
                        text-decoration:none;
                    "
                >
                    NOUS CONTACTER
                </a>

            </div>

        </div>

    </section>

@endsection
