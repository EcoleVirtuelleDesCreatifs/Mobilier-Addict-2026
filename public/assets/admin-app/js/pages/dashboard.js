/* Tableau de bord : KPI, trafic temps réel, produits les plus vus, commandes récentes */
(function (document) {
    'use strict';

    var REFRESH_MS = 15000;

    var SOURCE_ICONS = {
        facebook: ['fa-brands fa-facebook', '#1877f2'],
        instagram: ['fa-brands fa-instagram', '#e1306c'],
        tiktok: ['fa-brands fa-tiktok', '#111827'],
        whatsapp: ['fa-brands fa-whatsapp', '#22c55e'],
        google: ['fa-brands fa-google', '#ea4335'],
        youtube: ['fa-brands fa-youtube', '#ff0000'],
        linkedin: ['fa-brands fa-linkedin', '#0a66c2'],
        'x-twitter': ['fa-brands fa-x-twitter', '#111827'],
        pinterest: ['fa-brands fa-pinterest', '#e60023'],
        snapchat: ['fa-brands fa-snapchat', '#eab308'],
        telegram: ['fa-brands fa-telegram', '#229ed9'],
        bing: ['fa-brands fa-microsoft', '#0078d4'],
        direct: ['fa-solid fa-arrow-right-to-bracket', '#00234D'],
        'e-mail': ['fa-solid fa-envelope', '#7c3aed'],
        newsletter: ['fa-solid fa-envelope', '#7c3aed'],
        sms: ['fa-solid fa-comment-sms', '#0ea5e9']
    };

    AdminApp.register('dashboard', {
        props: { initial: { type: Object, default: function () { return {}; } } },

        data: function () {
            var d = this.initial;
            return {
                today: d.today || '',
                kpis: d.kpis || [],
                traffic: d.traffic || null,
                abandonedCarts: d.abandonedCarts || 0,
                topProducts: d.topProducts || { day: [], week: [], month: [] },
                latestOrders: d.latestOrders || [],
                overview: d.overview || [],
                origins: d.origins || null,
                originPeriod: 'week',
                quickLinks: d.quickLinks || [],
                urls: d.urls || {},
                period: 'day',
                periods: [{ key: 'day', label: 'Jour' }, { key: 'week', label: 'Semaine' }, { key: 'month', label: 'Mois' }],
                updatedAt: Date.now(),
                now: Date.now(),
                live: true
            };
        },

        computed: {
            currentTop: function () {
                return this.topProducts[this.period] || [];
            },
            maxViews: function () {
                return this.currentTop.reduce(function (max, p) { return Math.max(max, p.views); }, 1);
            },
            originSources: function () {
                return this.origins ? (this.origins.sources[this.originPeriod] || []) : [];
            },
            originCities: function () {
                return this.origins ? (this.origins.cities[this.originPeriod] || []) : [];
            },
            originCommunes: function () {
                return this.origins ? (this.origins.communes[this.originPeriod] || []) : [];
            },
            sourcesTotal: function () {
                return this.originSources.reduce(function (sum, s) { return sum + s.visitors; }, 0) || 1;
            },
            citiesTotal: function () {
                return this.originCities.reduce(function (sum, c) { return sum + c.visitors; }, 0) || 1;
            },
            communesMax: function () {
                return this.originCommunes.reduce(function (max, c) { return Math.max(max, c.total); }, 1);
            },
            updatedLabel: function () {
                var s = Math.max(0, Math.round((this.now - this.updatedAt) / 1000));
                return s < 5 ? 'à l’instant' : 'il y a ' + s + ' s';
            }
        },

        mounted: function () {
            var self = this;
            this._tick = setInterval(function () { self.now = Date.now(); }, 1000);
            if (this.traffic && this.urls.realtime) {
                this._poll = setInterval(this.refresh, REFRESH_MS);
            }
        },

        beforeUnmount: function () {
            clearInterval(this._tick);
            clearInterval(this._poll);
        },

        methods: {
            number: AdminApp.number,
            money: AdminApp.money,
            sourceIcon: function (key) {
                return (SOURCE_ICONS[key] || ['fa-solid fa-globe', '#6b7280'])[0];
            },
            sourceColor: function (key) {
                return (SOURCE_ICONS[key] || ['fa-solid fa-globe', '#6b7280'])[1];
            },
            percent: function (value, total) {
                return Math.round(value / total * 100);
            },
            flag: function (code) {
                if (!code || code.length !== 2) return '🌍';
                return String.fromCodePoint.apply(null, code.toUpperCase().split('').map(function (c) { return 127397 + c.charCodeAt(0); }));
            },
            refresh: function () {
                if (document.hidden) return;
                var self = this;
                AdminApp.fetchJson(this.urls.realtime).then(function (data) {
                    self.traffic = data.visitors || self.traffic;
                    self.abandonedCarts = data.abandonedCarts != null ? data.abandonedCarts : self.abandonedCarts;
                    self.updatedAt = Date.now();
                    self.live = true;
                }).catch(function () {
                    self.live = false;
                });
            }
        },

        template: `
<div class="ad-page-head">
    <div>
        <h1>Tableau de bord</h1>
        <p class="text-capitalize">{{ today }}</p>
    </div>
    <div class="ad-page-actions">
        <a v-for="q in quickLinks.slice(0, 2)" :key="q.url" :href="q.url" class="btn" :class="q.icon.indexOf('plus') > -1 ? 'btn-admin-pink' : 'btn-admin-ghost'">
            <i :class="q.icon" class="me-1"></i> {{ q.label }}
        </a>
    </div>
</div>

<div class="row g-3 mb-3">
    <div v-for="k in kpis" :key="k.label" class="col-6 col-xl-3">
        <a :href="k.url" class="ad-stat" :class="'tone-' + k.tone">
            <span class="ad-stat-icon"><i :class="k.icon"></i></span>
            <span>
                <span class="ad-stat-label d-block">{{ k.label }}</span>
                <span class="ad-stat-value d-block">{{ number(k.value) }}</span>
                <span class="ad-stat-hint">{{ k.hint }}</span>
            </span>
        </a>
    </div>
</div>

<div v-if="traffic" class="ad-live mb-3">
    <div class="ad-live-head">
        <span><span class="ad-pulse" :style="live ? '' : 'background:#f59e0b;animation:none'"></span>Trafic en direct</span>
        <span>Mis à jour {{ updatedLabel }}</span>
    </div>
    <div class="ad-live-grid">
        <div class="ad-live-item"><small>En ligne (5 min)</small><strong>{{ number(traffic.realtime) }}</strong></div>
        <div class="ad-live-item"><small>Aujourd'hui</small><strong>{{ number(traffic.today) }}</strong></div>
        <div class="ad-live-item"><small>Ce mois</small><strong>{{ number(traffic.month) }}</strong></div>
        <div class="ad-live-item"><small>Paniers abandonnés (30 j)</small><strong class="text-warning">{{ number(abandonedCarts) }}</strong></div>
    </div>
</div>

<div v-if="origins" class="ad-card mb-3">
    <div class="ad-card-head">
        <h2 class="ad-card-title"><i class="fa-solid fa-earth-africa me-1" style="color:var(--ad-pink)"></i> Origine des visiteurs</h2>
        <div class="ad-tabs">
            <button v-for="p in periods" :key="p.key" type="button" :class="{ 'is-active': originPeriod === p.key }" @click="originPeriod = p.key">{{ p.label }}</button>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-12 col-lg-4 ad-origin-col">
            <div class="ad-origin-title">Sources de trafic</div>
            <div v-for="s in originSources" :key="s.label + s.medium" class="ad-origin-row">
                <span class="ad-origin-icon" :style="{ color: sourceColor(s.key) }"><i :class="sourceIcon(s.key)"></i></span>
                <span class="flex-grow-1" style="min-width:0">
                    <span class="d-flex justify-content-between gap-2">
                        <span class="ad-strong text-truncate">{{ s.label }} <small class="ad-sub fw-normal">· {{ s.medium }}</small></span>
                        <span class="ad-sub text-nowrap">{{ number(s.visitors) }} · {{ percent(s.visitors, sourcesTotal) }} %</span>
                    </span>
                    <span class="ad-bar"><span :style="{ width: percent(s.visitors, sourcesTotal) + '%', background: sourceColor(s.key) }"></span></span>
                </span>
            </div>
            <div v-if="!originSources.length" class="ad-empty py-4"><i class="fa-solid fa-route"></i>{{ origins.enabled ? 'Aucune visite sur cette période' : 'Suivi des sources non activé' }}</div>
        </div>
        <div class="col-12 col-lg-4 ad-origin-col">
            <div class="ad-origin-title">Villes de connexion</div>
            <div v-for="c in originCities" :key="c.label + c.detail" class="ad-origin-row">
                <span class="ad-origin-icon ad-origin-flag">{{ flag(c.flag) }}</span>
                <span class="flex-grow-1" style="min-width:0">
                    <span class="d-flex justify-content-between gap-2">
                        <span class="ad-strong text-truncate">{{ c.label }}</span>
                        <span class="ad-sub text-nowrap">{{ number(c.visitors) }} · {{ percent(c.visitors, citiesTotal) }} %</span>
                    </span>
                    <span class="ad-sub d-block text-truncate">{{ c.detail }}</span>
                </span>
            </div>
            <div v-if="!originCities.length" class="ad-empty py-4"><i class="fa-solid fa-location-dot"></i>{{ origins.enabled ? 'Localisation en cours de collecte' : 'Suivi des villes non activé' }}</div>
        </div>
        <div class="col-12 col-lg-4 ad-origin-col">
            <div class="ad-origin-title">Communes de livraison <small class="ad-sub fw-normal">(commandes)</small></div>
            <div v-for="c in originCommunes" :key="c.label" class="ad-origin-row">
                <span class="ad-origin-icon" style="color:var(--ad-pink)"><i class="fa-solid fa-location-dot"></i></span>
                <span class="flex-grow-1" style="min-width:0">
                    <span class="d-flex justify-content-between gap-2">
                        <span class="ad-strong text-truncate">{{ c.label }}</span>
                        <span class="ad-sub text-nowrap">{{ number(c.total) }} cmd</span>
                    </span>
                    <span class="ad-bar"><span :style="{ width: (c.total / communesMax * 100) + '%' }"></span></span>
                </span>
            </div>
            <div v-if="!originCommunes.length" class="ad-empty py-4"><i class="fa-solid fa-truck"></i>Aucune commande sur cette période</div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-12 col-xl-6">
        <div class="ad-card h-100">
            <div class="ad-card-head">
                <h2 class="ad-card-title">Produits les plus vus</h2>
                <div class="ad-tabs">
                    <button v-for="p in periods" :key="p.key" type="button" :class="{ 'is-active': period === p.key }" @click="period = p.key">{{ p.label }}</button>
                </div>
            </div>
            <div>
                <a v-for="(p, i) in currentTop" :key="p.url" :href="p.url" class="ad-list-row">
                    <span class="ad-rank">{{ i + 1 }}</span>
                    <img v-if="p.image" :src="p.image" class="ad-thumb" alt="" loading="lazy">
                    <span v-else class="ad-thumb ad-thumb-placeholder"><i class="fa-solid fa-box"></i></span>
                    <span class="flex-grow-1 min-w-0" style="min-width:0">
                        <span class="ad-strong d-block text-truncate">{{ p.name }}</span>
                        <span class="ad-bar"><span :style="{ width: (p.views / maxViews * 100) + '%' }"></span></span>
                    </span>
                    <span class="ad-sub text-nowrap">{{ number(p.views) }} vue{{ p.views > 1 ? 's' : '' }}</span>
                </a>
                <div v-if="!currentTop.length" class="ad-empty"><i class="fa-regular fa-eye"></i>Aucune donnée sur cette période</div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <div class="ad-card h-100">
            <div class="ad-card-head">
                <h2 class="ad-card-title">Commandes récentes</h2>
                <a :href="urls.orders" class="btn btn-sm btn-admin-ghost">Tout voir</a>
            </div>
            <div>
                <a v-for="o in latestOrders" :key="o.id" :href="o.url" class="ad-list-row">
                    <span class="flex-grow-1" style="min-width:0">
                        <span class="ad-strong d-block">{{ o.number }}</span>
                        <span class="ad-sub d-block text-truncate">{{ o.customer }} · {{ o.date }}</span>
                    </span>
                    <span class="ad-badge" :class="'is-' + o.tone">{{ o.status }}</span>
                    <span class="ad-strong text-nowrap" style="color:var(--ad-pink)">{{ money(o.total) }}</span>
                </a>
                <div v-if="!latestOrders.length" class="ad-empty"><i class="fa-solid fa-bag-shopping"></i>Aucune commande pour le moment</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-xl-7">
        <div class="ad-card h-100">
            <div class="ad-card-head"><h2 class="ad-card-title">Accès rapides</h2></div>
            <div class="ad-card-body">
                <div class="ad-quick">
                    <a v-for="q in quickLinks" :key="q.url" :href="q.url"><i :class="q.icon"></i>{{ q.label }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-5">
        <div class="ad-card h-100">
            <div class="ad-card-head"><h2 class="ad-card-title">Aperçu du site</h2></div>
            <div>
                <div v-for="o in overview" :key="o.label" class="ad-list-row">
                    <span class="ad-rank"><i :class="o.icon"></i></span>
                    <span class="flex-grow-1">{{ o.label }}</span>
                    <span class="ad-strong">{{ number(o.value) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
`
    });
})(document);
