/* Shell admin : sidebar, barre supérieure, recherche rapide, notifications, profil */
(function () {
    'use strict';

    var MINI_KEY = 'ma-admin-sidebar-mini';

    AdminApp.register('shell', {
        props: { initial: { type: Object, default: function () { return {}; } } },

        data: function () {
            var menu = this.initial.menu || [];
            var open = {};
            menu.forEach(function (item, i) {
                if (item.children && item.active) open[i] = true;
            });

            return {
                menu: menu,
                open: open,
                user: this.initial.user || {},
                notifications: this.initial.notifications || { unread: 0, items: [] },
                urls: this.initial.urls || {},
                logo: this.initial.logo || '',
                title: this.initial.title || 'Administration',
                mini: localStorage.getItem(MINI_KEY) === '1',
                navOpen: false,
                dropdown: null,
                query: '',
                searchFocus: false,
                cursor: 0
            };
        },

        computed: {
            initials: function () {
                return (this.user.name || '?').trim().split(/\s+/).slice(0, 2).map(function (w) { return w.charAt(0); }).join('').toUpperCase();
            },
            searchIndex: function () {
                var list = [];
                this.menu.forEach(function (item) {
                    if (item.url) list.push({ label: item.label, group: '', url: item.url, icon: item.icon });
                    (item.children || []).forEach(function (child) {
                        list.push({ label: child.label, group: item.label, url: child.url, icon: item.icon });
                    });
                });
                return list;
            },
            results: function () {
                var q = this.normalize(this.query);
                if (!q) return [];
                var self = this;
                return this.searchIndex.filter(function (entry) {
                    return self.normalize(entry.label + ' ' + entry.group).indexOf(q) > -1;
                }).slice(0, 8);
            }
        },

        watch: {
            mini: function (value) {
                localStorage.setItem(MINI_KEY, value ? '1' : '0');
                document.body.classList.toggle('ad-mini', value);
            },
            navOpen: function (value) {
                document.body.classList.toggle('ad-nav-open', value);
            },
            query: function () {
                this.cursor = 0;
            }
        },

        mounted: function () {
            var self = this;
            document.body.classList.toggle('ad-mini', this.mini);
            document.title = this.title + ' | Mobilier Addict';

            this._onClick = function (e) {
                if (!e.target.closest('.ad-dropdown')) self.dropdown = null;
                if (!e.target.closest('.ad-search')) self.searchFocus = false;
            };
            this._onKey = function (e) {
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                    e.preventDefault();
                    if (self.$refs.search) self.$refs.search.focus();
                }
                if (e.key === 'Escape') {
                    self.dropdown = null;
                    self.navOpen = false;
                    self.searchFocus = false;
                }
            };
            document.addEventListener('click', this._onClick);
            document.addEventListener('keydown', this._onKey);
        },

        beforeUnmount: function () {
            document.removeEventListener('click', this._onClick);
            document.removeEventListener('keydown', this._onKey);
        },

        methods: {
            normalize: function (s) {
                return String(s || '').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').trim();
            },
            toggleGroup: function (i) {
                if (this.mini && window.innerWidth >= 992) {
                    this.mini = false;
                }
                this.open[i] = !this.open[i];
            },
            toggleSidebar: function () {
                if (window.innerWidth < 992) {
                    this.navOpen = !this.navOpen;
                } else {
                    this.mini = !this.mini;
                }
            },
            toggleDropdown: function (name) {
                this.dropdown = this.dropdown === name ? null : name;
            },
            moveCursor: function (step) {
                if (!this.results.length) return;
                this.cursor = (this.cursor + step + this.results.length) % this.results.length;
            },
            go: function (entry) {
                entry = entry || this.results[this.cursor];
                if (entry) window.location.href = entry.url;
            },
            openNotification: function (n) {
                if (n.unread && n.readUrl) {
                    AdminApp.post(n.readUrl, { redirect_to: n.url || window.location.href });
                } else if (n.url) {
                    window.location.href = n.url;
                }
            },
            readAll: function () {
                AdminApp.post(this.urls.notificationsReadAll);
            },
            logout: function () {
                AdminApp.post(this.urls.logout);
            }
        },

        template: `
<aside class="ad-sidebar" aria-label="Navigation principale">
    <a :href="urls.home" class="ad-brand">
        <img :src="logo" alt="Mobilier Addict">
    </a>
    <nav class="ad-nav">
        <template v-for="(item, i) in menu" :key="i">
            <div v-if="item.section" class="ad-nav-section">{{ item.section }}</div>
            <a v-else-if="!item.children" :href="item.url" class="ad-nav-link" :class="{ 'is-active': item.active }" :title="item.label">
                <i class="ad-nav-icon" :class="item.icon"></i>
                <span class="ad-nav-label">{{ item.label }}</span>
            </a>
            <div v-else>
                <button type="button" class="ad-nav-link" :class="{ 'is-open': open[i], 'is-active': item.active && !open[i] }" :title="item.label" @click="toggleGroup(i)">
                    <i class="ad-nav-icon" :class="item.icon"></i>
                    <span class="ad-nav-label">{{ item.label }}</span>
                    <i class="fa-solid fa-chevron-right ad-nav-caret"></i>
                </button>
                <ul v-show="open[i]" class="ad-nav-sub">
                    <li v-for="child in item.children" :key="child.url">
                        <a :href="child.url" :class="{ 'is-active': child.active }">{{ child.label }}</a>
                    </li>
                </ul>
            </div>
        </template>
    </nav>
    <div class="ad-sidebar-foot">
        <a :href="urls.site" target="_blank" rel="noopener" class="ad-nav-link" title="Voir le site">
            <i class="ad-nav-icon fa-solid fa-arrow-up-right-from-square"></i>
            <span class="ad-nav-label">Voir le site</span>
        </a>
    </div>
</aside>

<div v-if="navOpen" class="ad-backdrop" @click="navOpen = false"></div>

<header class="ad-topbar">
    <button type="button" class="ad-icon-btn" @click="toggleSidebar" aria-label="Menu">
        <i class="fa-solid fa-bars"></i>
    </button>
    <h1 class="ad-page-title">{{ title }}</h1>

    <div class="ad-search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input ref="search" v-model="query" type="search" placeholder="Rechercher une page…" autocomplete="off"
               @focus="searchFocus = true"
               @keydown.down.prevent="moveCursor(1)"
               @keydown.up.prevent="moveCursor(-1)"
               @keydown.enter.prevent="go()">
        <kbd v-if="!query">Ctrl K</kbd>
        <div v-if="searchFocus && query" class="ad-search-results">
            <a v-for="(r, i) in results" :key="r.url" :href="r.url" :class="{ 'is-focus': i === cursor }" @mouseenter="cursor = i">
                <i :class="r.icon"></i> {{ r.label }} <small v-if="r.group">{{ r.group }}</small>
            </a>
            <div v-if="!results.length" class="ad-search-empty">Aucun résultat</div>
        </div>
    </div>

    <div class="ad-dropdown">
        <button type="button" class="ad-icon-btn" @click="toggleDropdown('notif')" aria-label="Notifications">
            <i class="fa-regular fa-bell"></i>
            <span v-if="notifications.unread" class="ad-count">{{ notifications.unread > 99 ? '99+' : notifications.unread }}</span>
        </button>
        <transition name="ad-fade">
            <div v-if="dropdown === 'notif'" class="ad-dropdown-menu is-wide">
                <div class="ad-dropdown-head">
                    Notifications
                    <button v-if="notifications.unread" type="button" class="btn btn-sm btn-admin-ghost" @click="readAll">Tout lire</button>
                </div>
                <div class="ad-notif-list">
                    <a v-for="n in notifications.items" :key="n.id" href="#" class="ad-notif" :class="{ 'is-unread': n.unread }" @click.prevent="openNotification(n)">
                        <strong>{{ n.title }}</strong>
                        <p v-if="n.message">{{ n.message }}</p>
                        <time>{{ n.date }}</time>
                    </a>
                    <div v-if="!notifications.items.length" class="ad-search-empty">Aucune notification</div>
                </div>
                <a :href="urls.notifications" class="ad-dropdown-item justify-content-center border-top">Voir toutes les notifications</a>
            </div>
        </transition>
    </div>

    <div class="ad-dropdown">
        <button type="button" class="ad-user" @click="toggleDropdown('user')">
            <img v-if="user.avatar" :src="user.avatar" class="ad-avatar" alt="">
            <span v-else class="ad-avatar">{{ initials }}</span>
            <span class="ad-user-meta">
                <strong>{{ user.name }}</strong>
                <small>{{ (user.role || '').replace('_', ' ') }}</small>
            </span>
        </button>
        <transition name="ad-fade">
            <div v-if="dropdown === 'user'" class="ad-dropdown-menu">
                <a :href="urls.profile" class="ad-dropdown-item"><i class="fa-regular fa-user"></i> Mon profil</a>
                <a :href="urls.site" target="_blank" rel="noopener" class="ad-dropdown-item"><i class="fa-solid fa-store"></i> Voir le site</a>
                <button type="button" class="ad-dropdown-item text-danger border-top" @click="logout"><i class="fa-solid fa-right-from-bracket"></i> Se déconnecter</button>
            </div>
        </transition>
    </div>
</header>
`
    });
})();
