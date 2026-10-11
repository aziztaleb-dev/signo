/*
|--------------------------------------------------------------------------
| Product slideshow
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', () => {

    const mainImage = document.getElementById('product-main-image');

    const thumbnails = Array.from(
        document.querySelectorAll('.product-thumbnail')
    );

    const previousButton = document.querySelector(
        '.product-slider-prev'
    );

    const nextButton = document.querySelector(
        '.product-slider-next'
    );

    if (!mainImage || thumbnails.length === 0) {
        return;
    }

    let currentIndex = 0;


    function showImage(index) {

        if (index < 0) {
            index = thumbnails.length - 1;
        }

        if (index >= thumbnails.length) {
            index = 0;
        }

        currentIndex = index;

        const image = thumbnails[currentIndex]
            .getAttribute('data-image');

        mainImage.style.opacity = '0';

        setTimeout(() => {

            mainImage.src = image;

            mainImage.style.opacity = '1';

        }, 100);


        thumbnails.forEach((thumbnail, thumbnailIndex) => {

            thumbnail.classList.toggle(
                'active',
                thumbnailIndex === currentIndex
            );

        });

    }


    thumbnails.forEach((thumbnail, index) => {

        thumbnail.addEventListener('click', () => {

            showImage(index);

        });

    });


    previousButton?.addEventListener('click', () => {

        showImage(currentIndex - 1);

    });


    nextButton?.addEventListener('click', () => {

        showImage(currentIndex + 1);

    });


    document.addEventListener('keydown', (event) => {

        if (event.key === 'ArrowLeft') {
            showImage(currentIndex - 1);
        }

        if (event.key === 'ArrowRight') {
            showImage(currentIndex + 1);
        }

    });

});

document.addEventListener('DOMContentLoaded', () => {

    const menu = document.querySelector('.menu-icon');
    const search = document.querySelector('.header-icon:not(.menu-icon)');
    const header = document.querySelector('.site-header');

    let menuPanel = null;
    let searchPanel = null;


    /*
    |--------------------------------------------------------------------------
    | Mobile menu
    |--------------------------------------------------------------------------
    */

    menu?.addEventListener('click', () => {

        searchPanel?.remove();
        searchPanel = null;

        if (menuPanel) {
            menuPanel.remove();
            menuPanel = null;
            return;
        }

        const template = document.getElementById('mobile-menu-template');

        if (!template) {
            return;
        }

        menuPanel = document.createElement('nav');

        menuPanel.className = 'mobile-panel';

        menuPanel.setAttribute(
            'aria-label',
            'Menu secondaire'
        );

        menuPanel.innerHTML = template.innerHTML;

        header.append(menuPanel);
    });


    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    search?.addEventListener('click', () => {

        menuPanel?.remove();
        menuPanel = null;

        if (searchPanel) {
            searchPanel.remove();
            searchPanel = null;
            return;
        }

        searchPanel = document.createElement('form');

        searchPanel.className = 'search-bar';

        searchPanel.action = '/';

        searchPanel.method = 'get';

        searchPanel.innerHTML = `
            <input
                name="s"
                type="search"
                placeholder="Rechercher..."
                aria-label="Rechercher"
                autofocus
            >

            <button
                type="submit"
                aria-label="Lancer la recherche"
            >
                ⌕
            </button>
        `;

        header.append(searchPanel);

        searchPanel
            .querySelector('input')
            .focus();
    });

});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.proj-category').forEach(function (category) {
        var toggle = category.querySelector('.proj-category-toggle');
        var list = category.querySelector('.proj-category-list');
        var chevron = category.querySelector('.proj-chevron');

        if (!toggle || !list) {
            return;
        }

        toggle.addEventListener('click', function () {
            var isOpen = toggle.getAttribute('aria-expanded') === 'true';

            toggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
            list.hidden = isOpen;

            if (chevron) {
                chevron.classList.toggle('is-open', !isOpen);
            }
        });
    });
});

(function () {

    function setState(category, open) {
        var toggle = category.querySelector('.proj-category-toggle');
        var list = category.querySelector('.proj-category-list');
        var chevron = category.querySelector('.proj-chevron');

        if (!toggle || !list) {
            return;
        }

        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        list.hidden = !open;

        if (chevron) {
            chevron.classList.toggle('is-open', open);
        }
    }

    // Clic intercepté en phase de capture : ce script est le seul à traiter ces boutons
    document.addEventListener('click', function (event) {
        var toggle = event.target.closest('.proj-category-toggle');

        if (!toggle) {
            return;
        }

        event.preventDefault();
        event.stopImmediatePropagation();

        var category = toggle.closest('.proj-category');
        var list = category.querySelector('.proj-category-list');
        var wasOpen = list && !list.hidden;

        document.querySelectorAll('.proj-category').forEach(function (other) {
            setState(other, false);
        });

        if (!wasOpen) {
            setState(category, true);
        }
    }, true);

    // À l'ouverture de la page : seul le premier est ouvert
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.proj-category').forEach(function (category, index) {
            setState(category, index === 0);
        });
    });

})();
