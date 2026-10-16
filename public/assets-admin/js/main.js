document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('admin-sidebar');
    const toggle = document.getElementById('sidebar-toggle');
    const close = document.getElementById('sidebar-close');
    const overlay = document.getElementById('sidebar-overlay');

    if (!sidebar || !toggle || !close || !overlay) {
        return;
    }

    function openSidebar() {
        sidebar.classList.add('is-open');
        overlay.classList.add('is-visible');
        document.body.classList.add('sidebar-open');

        toggle.setAttribute('aria-expanded', 'true');
        toggle.setAttribute('aria-label', 'Fermer le menu');

        close.focus();
    }

    function closeSidebar(returnFocus = true) {
        sidebar.classList.remove('is-open');
        overlay.classList.remove('is-visible');
        document.body.classList.remove('sidebar-open');

        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Ouvrir le menu');

        if (returnFocus) {
            toggle.focus();
        }
    }

    toggle.addEventListener('click', function () {
        if (sidebar.classList.contains('is-open')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    close.addEventListener('click', function () {
        closeSidebar();
    });

    overlay.addEventListener('click', function () {
        closeSidebar();
    });

    document.addEventListener('keydown', function (event) {
        if (
            event.key === 'Escape' &&
            sidebar.classList.contains('is-open')
        ) {
            closeSidebar();
        }
    });

    /* Fermer après navigation sur mobile */
    sidebar.querySelectorAll('a.nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 1024) {
                closeSidebar(false);
            }
        });
    });

    /* Fermer si la fenêtre repasse en mode desktop */
    window.addEventListener('resize', function () {
        if (window.innerWidth > 1024) {
            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-visible');
            document.body.classList.remove('sidebar-open');

            toggle.setAttribute('aria-expanded', 'false');
        }
    });
});
