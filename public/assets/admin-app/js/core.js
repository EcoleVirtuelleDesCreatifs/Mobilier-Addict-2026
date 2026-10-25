/* Mobilier Addict — Admin : noyau partagé (Vue 3, sans build) */
(function (window, document) {
    'use strict';

    var registry = {};
    var bus = Vue.reactive({ toasts: [], confirm: null });
    var toastId = 0;

    var AdminApp = {
        bus: bus,

        /** Enregistre un composant racine monté sur [data-vue="name"]. */
        register: function (name, component) {
            registry[name] = component;
        },

        /** Lit un bloc <script type="application/json" id="..."> */
        readJson: function (id) {
            var el = document.getElementById(id);
            if (!el) return {};
            try {
                return JSON.parse(el.textContent || '{}');
            } catch (e) {
                console.error('[admin] JSON invalide dans #' + id, e);
                return {};
            }
        },

        csrf: function () {
            var meta = document.querySelector('meta[name="csrf-token"]');
            return meta ? meta.getAttribute('content') : '';
        },

        fetchJson: function (url) {
            return fetch(url, {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin'
            }).then(function (res) {
                if (!res.ok) throw new Error('HTTP ' + res.status);
                return res.json();
            });
        },

        /** Soumet un POST classique (navigation) avec jeton CSRF. */
        post: function (url, fields) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            form.style.display = 'none';
            var data = Object.assign({ _token: AdminApp.csrf() }, fields || {});
            Object.keys(data).forEach(function (key) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = data[key] == null ? '' : data[key];
                form.appendChild(input);
            });
            document.body.appendChild(form);
            form.submit();
        },

        number: function (value) {
            return new Intl.NumberFormat('fr-FR').format(Number(value) || 0);
        },

        money: function (value) {
            return AdminApp.number(Math.round(Number(value) || 0)) + ' F';
        },

        toast: function (message, type) {
            var id = ++toastId;
            bus.toasts.push({ id: id, message: message, type: type || 'success' });
            setTimeout(function () { AdminApp.dismiss(id); }, 4500);
        },

        dismiss: function (id) {
            var i = bus.toasts.findIndex(function (t) { return t.id === id; });
            if (i > -1) bus.toasts.splice(i, 1);
        },

        /** Ouvre la modale de confirmation, renvoie une Promise<boolean>. */
        confirm: function (message, options) {
            return new Promise(function (resolve) {
                bus.confirm = Object.assign({
                    title: 'Confirmer l\'action',
                    message: message,
                    okLabel: 'Confirmer',
                    danger: true,
                    resolve: resolve
                }, options || {});
            });
        },

        /** Formulaires de filtres [data-auto-submit] : envoi au changement de liste ou après la saisie. */
        autoSubmit: function () {
            document.querySelectorAll('form[data-auto-submit]').forEach(function (form) {
                var timer;
                form.addEventListener('change', function (e) {
                    if (e.target.matches('select')) form.requestSubmit ? form.requestSubmit() : form.submit();
                });
                form.addEventListener('input', function (e) {
                    if (!e.target.matches('input[type="search"]')) return;
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        form.requestSubmit ? form.requestSubmit() : form.submit();
                    }, 600);
                });
            });
        },

        boot: function () {
            AdminApp.autoSubmit();
            document.querySelectorAll('[data-vue]').forEach(function (el) {
                var name = el.getAttribute('data-vue');
                var component = registry[name];
                if (!component) {
                    console.warn('[admin] composant Vue inconnu : ' + name);
                    return;
                }
                var source = el.getAttribute('data-source');
                var props = source ? AdminApp.readJson(source) : {};
                try {
                    Vue.createApp(component, { initial: props }).mount(el);
                } catch (e) {
                    console.error('[admin] échec du montage de ' + name, e);
                }
            });
        }
    };

    window.AdminApp = AdminApp;
})(window, document);
