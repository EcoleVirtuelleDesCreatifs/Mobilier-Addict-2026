/* Démarrage : monte chaque composant Vue déclaré via data-vue="..." */
(function () {
    'use strict';

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', AdminApp.boot);
    } else {
        AdminApp.boot();
    }
})();
