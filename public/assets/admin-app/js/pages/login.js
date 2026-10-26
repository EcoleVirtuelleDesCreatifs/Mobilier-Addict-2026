/* Page de connexion : afficher le mot de passe, alerte majuscules, état d'envoi */
(function () {
    'use strict';

    var form = document.getElementById('ad-login-form');
    if (!form) return;

    var password = form.querySelector('input[name="password"]');
    var toggle = form.querySelector('[data-toggle-password]');
    var caps = form.querySelector('[data-caps]');
    var submit = form.querySelector('button[type="submit"]');

    if (toggle && password) {
        toggle.addEventListener('click', function () {
            var show = password.type === 'password';
            password.type = show ? 'text' : 'password';
            toggle.setAttribute('aria-label', show ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
            toggle.querySelector('i').className = show ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
            password.focus();
        });
    }

    if (caps && password) {
        var check = function (e) {
            if (typeof e.getModifierState === 'function') caps.hidden = !e.getModifierState('CapsLock');
        };
        password.addEventListener('keyup', check);
        password.addEventListener('keydown', check);
        password.addEventListener('blur', function () { caps.hidden = true; });
    }

    form.addEventListener('submit', function (e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            var invalid = form.querySelector(':invalid');
            if (invalid) {
                invalid.classList.add('is-invalid');
                invalid.focus();
            }
            return;
        }
        submit.disabled = true;
        submit.querySelector('.ad-login-label').hidden = true;
        submit.querySelector('.ad-login-loading').hidden = false;
    });

    form.addEventListener('input', function (e) {
        if (e.target.classList.contains('is-invalid') && e.target.checkValidity()) {
            e.target.classList.remove('is-invalid');
        }
    });

    // Retour arrière (bfcache) : réactive le bouton
    window.addEventListener('pageshow', function () {
        submit.disabled = false;
        submit.querySelector('.ad-login-label').hidden = false;
        submit.querySelector('.ad-login-loading').hidden = true;
    });
})();
