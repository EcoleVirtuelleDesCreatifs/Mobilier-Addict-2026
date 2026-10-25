/* Toasts + modale de confirmation (remplace window.confirm) */
(function (document) {
    'use strict';

    AdminApp.register('feedback', {
        props: { initial: { type: Object, default: function () { return {}; } } },

        data: function () {
            return { bus: AdminApp.bus };
        },

        mounted: function () {
            var flash = this.initial || {};
            if (flash.success) AdminApp.toast(flash.success, 'success');
            if (flash.error) AdminApp.toast(flash.error, 'error');

            // Formulaires avec data-confirm="Message"
            document.addEventListener('submit', function (e) {
                var form = e.target;
                if (!form || !form.hasAttribute || !form.hasAttribute('data-confirm')) return;
                if (form.dataset.confirmed === '1') {
                    delete form.dataset.confirmed;
                    return;
                }
                e.preventDefault();
                var submitter = e.submitter || null;
                AdminApp.confirm(form.getAttribute('data-confirm') || 'Confirmer cette action ?', {
                    okLabel: form.getAttribute('data-confirm-ok') || 'Supprimer'
                }).then(function (ok) {
                    if (!ok) return;
                    form.dataset.confirmed = '1';
                    if (typeof form.requestSubmit === 'function') {
                        form.requestSubmit(submitter && submitter.form === form ? submitter : undefined);
                    } else {
                        form.submit();
                    }
                });
            }, true);
        },

        methods: {
            close: function (value) {
                var c = this.bus.confirm;
                this.bus.confirm = null;
                if (c && c.resolve) c.resolve(value);
            },
            dismiss: function (id) {
                AdminApp.dismiss(id);
            }
        },

        template: `
<div class="ad-toasts" aria-live="polite">
    <transition-group name="ad-toast">
        <div v-for="t in bus.toasts" :key="t.id" class="ad-toast" :class="'is-' + t.type">
            <i class="fa-solid" :class="t.type === 'error' ? 'fa-circle-xmark' : 'fa-circle-check'"></i>
            <span>{{ t.message }}</span>
            <button type="button" @click="dismiss(t.id)" aria-label="Fermer"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </transition-group>
</div>

<transition name="ad-fade">
    <div v-if="bus.confirm" class="ad-modal-wrap" @click.self="close(false)" @keydown.esc="close(false)">
        <div class="ad-modal" role="dialog" aria-modal="true">
            <div class="ad-modal-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h3>{{ bus.confirm.title }}</h3>
            <p>{{ bus.confirm.message }}</p>
            <div class="ad-modal-actions">
                <button type="button" class="btn btn-admin-ghost" @click="close(false)">Annuler</button>
                <button type="button" class="btn" :class="bus.confirm.danger ? 'btn-danger' : 'btn-admin-primary'" @click="close(true)" v-focus>{{ bus.confirm.okLabel }}</button>
            </div>
        </div>
    </div>
</transition>
`,

        directives: {
            focus: { mounted: function (el) { el.focus(); } }
        }
    });
})(document);
