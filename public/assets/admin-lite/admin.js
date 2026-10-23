(function () {
    'use strict';

    // Hamburger : affiche/masque la sidebar sur mobile
    var navControl = document.querySelector('.nav-control');
    if (navControl) {
        navControl.addEventListener('click', function () {
            document.body.classList.toggle('ad-sidebar-open');
        });
    }

    // Sous-menus du sidebar (remplace metismenu)
    document.querySelectorAll('.metismenu a.has-arrow').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var li = link.parentElement;
            var sub = li.querySelector('ul');
            li.classList.toggle('mm-active');
            if (sub) {
                sub.classList.toggle('mm-show');
            }
        });
    });

    // Preloader : disparait après le chargement
    var preloader = document.getElementById('preloader');
    if (preloader) {
        setTimeout(function () {
            preloader.style.transition = 'opacity .3s';
            preloader.style.opacity = '0';
            setTimeout(function () {
                preloader.remove();
                var wrapper = document.getElementById('main-wrapper');
                if (wrapper) {
                    wrapper.classList.add('show');
                }
            }, 300);
        }, 600);
    }
})();
