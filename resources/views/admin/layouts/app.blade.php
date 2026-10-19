<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('title', 'Administration') — Dr Nadine Ghithia</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets-admin/css/style.css') }}">

</head>
<body>

<div class="mobile-admin-header">
    <a href="{{ route('admin.dashboard') }}" class="mobile-brand">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
    </a>

    <button
        type="button"
        id="sidebar-toggle"
        class="sidebar-toggle"
        aria-label="Ouvrir le menu"
        aria-expanded="false"
    >
        <svg viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2"
             stroke-linecap="round">
            <path d="M3 6h18"></path>
            <path d="M3 12h18"></path>
            <path d="M3 18h18"></path>
        </svg>
    </button>
</div>

<div class="sidebar-overlay" id="sidebar-overlay"></div>

<aside class="sidebar" id="admin-sidebar">
    {{-- Logo --}}
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <div class="brand-logo">
                <img
                    src="{{ asset('assets/images/logo.png') }}"
                    alt="Logo Dr Nadine Ghithia"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                >

                <span class="brand-logo-placeholder" style="display:none;">
                NG
            </span>
            </div>
        </a>

        <button
            type="button"
            id="sidebar-close"
            class="sidebar-close"
            aria-label="Fermer le menu"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="m18 6-12 12"></path>
                <path d="m6 6 12 12"></path>
            </svg>
        </button>
    </div>




    {{-- Navigation --}}
    <div class="sidebar-content">

        <div class="nav-title">
            Dashboard
        </div>

        <a
            href="{{ route('admin.dashboard') }}"
            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                <rect x="14" y="14" width="7" height="7" rx="1"></rect>
            </svg>

            <span>Tableau de bord</span>
        </a>

        <div class="nav-title">
            Pages
        </div>

        <a
            href="{{ route('admin.home-page.index') }}"
            class="nav-link {{ request()->routeIs('admin.home-page.*') ? 'active' : '' }}"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                <path d="M3 9h18"></path>
                <path d="M9 9v12"></path>
                <path d="M13 13h4"></path>
                <path d="M13 17h4"></path>
            </svg>

            <span>Page d’accueil</span>
        </a>

        <a
            href="{{ route('admin.service-page.index') }}"
            class="nav-link {{ request()->routeIs('admin.service-page.*') ? 'active' : '' }}"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                <path d="M7 7h10"></path>
                <path d="M7 11h10"></path>
                <path d="M7 15h6"></path>
                <path d="M7 19h10"></path>
            </svg>

            <span>Nos services</span>
        </a>

        <a
            href="{{ route('admin.contact-page.index') }}"
            class="nav-link {{ request()->routeIs('admin.contact-page.*') ? 'active' : '' }}">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M21 10.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 20l1.9-5.7a8.38 8.38 0 0 1-.9-3.8A8.5 8.5 0 0 1 8.7 2.9a8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
            </svg>

            <span>Contact</span>
        </a>


        <div class="nav-title">
            Gestion
        </div>

        <a
            href="{{ route('admin.news.index') }}"
            class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M4 4h16v16H4z"></path>
                <path d="M8 8h8"></path>
                <path d="M8 12h8"></path>
                <path d="M8 16h5"></path>
            </svg>

            Actualités
        </a>

        <a
            href="{{ route('admin.new-products.index') }}"
            class="nav-link {{ request()->routeIs('admin.new-products.*') ? 'active' : '' }}"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M21 8l-9-5-9 5v8l9 5 9-5z"></path>
                <path d="M3 8l9 5 9-5"></path>
                <path d="M12 13v8"></path>
            </svg>

            Nouveaux produits
        </a>

        <a
            href="{{ route('admin.projects.index') }}"
            class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <rect x="3" y="7" width="18" height="13" rx="2"></rect>
                <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <path d="M3 13h18"></path>
            </svg>

            Projets
        </a>

        <a
            href="{{ route('admin.client-logos.index') }}"
            class="nav-link {{ request()->routeIs('admin.client-logos.*') ? 'active' : '' }}"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                <path d="M21 15l-5-5L5 21"></path>
            </svg>

            <span>Logos clients</span>
        </a>

        @php
            $worksOpen = request()->routeIs('admin.work-categories.*')
                || request()->routeIs('admin.work-subcategories.*')
                || request()->routeIs('admin.works.*');
        @endphp

        <button
            type="button"
            class="nav-link {{ $worksOpen ? 'active' : '' }}"
            onclick="
        var submenu = document.getElementById('works-submenu');
        var arrow = document.getElementById('works-arrow');
        var isHidden = submenu.style.display === 'none';
        submenu.style.display = isHidden ? 'block' : 'none';
        arrow.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
    "
            style="
        width:100%;
        border:0;
        background:{{ $worksOpen ? 'var(--primary)' : 'transparent' }};
        cursor:pointer;
        text-align:left;
        font-family:inherit;
    "
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18l3 3 6.3-6.3a4 4 0 0 0 5.4-5.4l-2.5 2.5-2.5-.5-.5-2.5z"></path>
            </svg>

            <span style="flex:1;">Travaux</span>

            <svg
                id="works-arrow"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                style="
            width:16px;
            height:16px;
            transition:transform .2s ease;
            transform:{{ $worksOpen ? 'rotate(180deg)' : 'rotate(0deg)' }};
        "
            >
                <path d="M6 9l6 6 6-6"></path>
            </svg>
        </button>

        <div
            id="works-submenu"
            style="display:{{ $worksOpen ? 'block' : 'none' }}; padding-left:14px;"
        >

            <a
                href="{{ route('admin.work-categories.index') }}"
                class="nav-link {{ request()->routeIs('admin.work-categories.*') ? 'active' : '' }}"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                </svg>

                Catégories
            </a>

            <a
                href="{{ route('admin.work-subcategories.index') }}"
                class="nav-link {{ request()->routeIs('admin.work-subcategories.*') ? 'active' : '' }}"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M4 6h16"></path>
                    <path d="M8 12h12"></path>
                    <path d="M12 18h8"></path>
                </svg>

                Sous-catégories
            </a>

            <a
                href="{{ route('admin.works.index') }}"
                class="nav-link {{ request()->routeIs('admin.works.*') ? 'active' : '' }}"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <path d="M21 15l-5-5L5 21"></path>
                </svg>

                Liste des travaux
            </a>
        </div>

        @php
            $unreadMessages = \App\Models\ContactMessage::whereNull('read_at')->count();
        @endphp

        <a
            href="{{ route('admin.contact-messages.index') }}"
            class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
            </svg>

            <span style="flex:1;">Messages</span>

            @if ($unreadMessages > 0)
                <span style="
            min-width:20px;
            padding:2px 7px;
            border-radius:999px;
            background:#ffffff;
            color:#000000;
            font-size:11px;
            font-weight:700;
            text-align:center;
        ">
            {{ $unreadMessages }}
        </span>
            @endif
        </a>
    </div>


    {{-- User / Logout --}}
    <div class="sidebar-footer">

        <div class="user-box">

            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>

            <div class="user-info">

                <div class="user-name">
                    {{ auth()->user()->name ?? 'Administrateur' }}
                </div>

                <div class="user-role">
                    Administrateur
                </div>

            </div>

        </div>


        <form
            action="{{ route('logout') }}"
            method="POST"
            class="logout-form"
        >
            @csrf

            <button
                type="submit"
                class="logout-button"
            >
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 17l5-5-5-5"></path>
                    <path d="M15 12H3"></path>
                    <path d="M21 3v18"></path>
                </svg>

                <span>Déconnexion</span>
            </button>
        </form>

    </div>
</aside>
<header class="admin-header">

    <a
        href="{{ url('/') }}"
        class="admin-header-link"
        target="_blank"
        rel="noopener"
    >
        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path d="M15 3h6v6"></path>
            <path d="M10 14 21 3"></path>
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
        </svg>

        Aller au site
    </a>

</header>
<main class="main">

    <div class="topbar">

        <div>
            <h1 class="page-heading">
                @yield('page-title')
            </h1>

            @hasSection('page-description')
                <p class="page-description">
                    @yield('page-description')
                </p>
            @endif
        </div>

    </div>


    @yield('content')
</main>
<script src="{{ asset('assets-admin/js/main.js') }}"></script>
</body>
</html>

