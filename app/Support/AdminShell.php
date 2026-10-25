<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;

/**
 * Données du shell admin (menu, utilisateur, notifications) transmises au composant Vue.
 */
class AdminShell
{
    public static function payload(): array
    {
        $user = auth()->user();
        $role = (string) ($user->role ?? '');
        $canManage = in_array($role, ['editor', 'admin', 'super_admin'], true);
        $isAdmin = in_array($role, ['admin', 'super_admin'], true);

        $menu = self::filter([
            ['section' => 'Général'],
            self::link('Tableau de bord', 'fa-solid fa-gauge-high', 'admin.dashboard', ['admin.dashboard']),
            self::link('Statistiques', 'fa-solid fa-chart-pie', 'admin.stats.index', ['admin.stats.*']),

            ['section' => 'Boutique'],
            self::group('Catalogue', 'fa-solid fa-couch', ['admin.products.*', 'admin.categories.*', 'admin.menus.*'], [
                self::child('Produits', 'admin.products.index', ['admin.products.index', 'admin.products.edit']),
                $canManage ? self::child('Nouveau produit', 'admin.products.create') : null,
                self::child('Catégories', 'admin.categories.index', ['admin.categories.index', 'admin.categories.edit']),
                self::child('Menus', 'admin.menus.index', ['admin.menus.*']),
            ]),
            self::group('Ventes', 'fa-solid fa-bag-shopping', ['admin.orders.*', 'admin.quotes.*', 'admin.invoices.*'], [
                self::child('Commandes', 'admin.orders.index', ['admin.orders.*']),
                self::child('Devis', 'admin.quotes.index', ['admin.quotes.*']),
                self::child('Factures', 'admin.invoices.index', ['admin.invoices.*']),
            ]),

            ['section' => 'Site'],
            self::group("Page d'accueil", 'fa-solid fa-house', ['admin.home_sections.*', 'admin.slider.*', 'admin.space_sections.*', 'admin.b2b.*', 'admin.settings.new-products-button.*'], [
                self::child('Sections', 'admin.home_sections.index', ['admin.home_sections.*']),
                $canManage ? self::child('Sliders', 'admin.slider.index', ['admin.slider.*']) : null,
                $canManage ? self::child('Espaces', 'admin.space_sections.index', ['admin.space_sections.*']) : null,
                $canManage ? self::child('B2B', 'admin.b2b.index', ['admin.b2b.*']) : null,
                $canManage ? self::child('Bouton nouveautés', 'admin.settings.new-products-button.edit', ['admin.settings.new-products-button.*']) : null,
            ]),
            self::group('Contenus', 'fa-solid fa-newspaper', ['admin.articles.*'], [
                self::child('Articles', 'admin.articles.index', ['admin.articles.index', 'admin.articles.edit', 'admin.articles.show']),
                $canManage ? self::child('Nouvel article', 'admin.articles.create') : null,
            ]),
            self::group('Marketing', 'fa-solid fa-bullhorn', ['admin.newsletter.*', 'admin.game.*', 'admin.settings.facebook-pixel.*'], [
                self::child('Grand Jeu', 'admin.game.index', ['admin.game.*']),
                self::child('Newsletter', 'admin.newsletter.index', ['admin.newsletter.*']),
                self::child('Facebook Pixel', 'admin.settings.facebook-pixel.edit', ['admin.settings.facebook-pixel.*']),
            ]),

            $isAdmin ? ['section' => 'Administration'] : null,
            $isAdmin ? self::group('Utilisateurs', 'fa-solid fa-users', ['admin.users.*', 'admin.roles.*'], [
                self::child('Tous les utilisateurs', 'admin.users.index', ['admin.users.index', 'admin.users.edit', 'admin.users.show']),
                self::child('Nouvel utilisateur', 'admin.users.create'),
                self::child('Statistiques', 'admin.users.stats'),
                self::child('Rôles', 'admin.roles.index', ['admin.roles.*']),
            ]) : null,
        ]);

        return [
            'title' => self::title($menu),
            'menu' => $menu,
            'user' => [
                'name' => (string) ($user->name ?? ''),
                'role' => $role,
                'avatar' => ! empty($user->profile_picture) ? asset('storage/' . $user->profile_picture) : null,
            ],
            'notifications' => self::notifications($user),
            'urls' => [
                'home' => self::url('admin.dashboard'),
                'site' => url('/'),
                'profile' => self::url('admin.profile'),
                'logout' => self::url('logout'),
                'notifications' => self::url('admin.notifications.index'),
                'notificationsReadAll' => self::url('admin.notifications.read-all'),
            ],
            'csrf' => csrf_token(),
            'logo' => asset('assets/logo/mobile/logo.png'),
        ];
    }

    /** URL d'un fichier public avec version (cache navigateur invalidé à chaque modification). */
    public static function asset(string $path): string
    {
        $file = public_path($path);

        return asset($path) . (is_file($file) ? '?v=' . filemtime($file) : '');
    }

    /** JSON sûr pour une balise <script type="application/json">. */
    public static function json($data): string
    {
        return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '{}';
    }

    private static function notifications($user): array
    {
        if (! $user || ! method_exists($user, 'notifications')) {
            return ['unread' => 0, 'items' => []];
        }

        try {
            $items = $user->notifications()->latest()->limit(8)->get()->map(function ($n) {
                $data = is_array($n->data) ? $n->data : [];

                return [
                    'id' => $n->id,
                    'title' => (string) ($data['title'] ?? 'Notification'),
                    'message' => (string) ($data['message'] ?? ''),
                    'url' => $data['url'] ?? null,
                    'unread' => is_null($n->read_at),
                    'date' => $n->created_at ? $n->created_at->diffForHumans() : '',
                    'readUrl' => self::url('admin.notifications.read', $n->id),
                ];
            })->values()->all();

            return ['unread' => $user->unreadNotifications()->count(), 'items' => $items];
        } catch (\Throwable $e) {
            return ['unread' => 0, 'items' => []];
        }
    }

    private static function title(array $menu): string
    {
        foreach ($menu as $item) {
            foreach ($item['children'] ?? [] as $child) {
                if ($child['active']) {
                    return $child['label'];
                }
            }
            if (! empty($item['active']) && empty($item['children'])) {
                return $item['label'];
            }
        }

        return 'Administration';
    }

    private static function link(string $label, string $icon, string $route, array $patterns = []): ?array
    {
        $url = self::url($route);

        return $url ? ['label' => $label, 'icon' => $icon, 'url' => $url, 'active' => self::is($patterns ?: [$route])] : null;
    }

    private static function group(string $label, string $icon, array $patterns, array $children): ?array
    {
        $children = array_values(array_filter($children));

        return $children ? ['label' => $label, 'icon' => $icon, 'active' => self::is($patterns), 'children' => $children] : null;
    }

    private static function child(string $label, string $route, array $patterns = []): ?array
    {
        $url = self::url($route);

        return $url ? ['label' => $label, 'url' => $url, 'active' => self::is($patterns ?: [$route])] : null;
    }

    private static function filter(array $items): array
    {
        $items = array_values(array_filter($items));

        // Retire les titres de section sans élément après eux
        return array_values(array_filter($items, function ($item, $i) use ($items) {
            return ! isset($item['section']) || (isset($items[$i + 1]) && ! isset($items[$i + 1]['section']));
        }, ARRAY_FILTER_USE_BOTH));
    }

    private static function is(array $patterns): bool
    {
        return request()->routeIs(...$patterns);
    }

    private static function url(string $route, $params = []): ?string
    {
        return Route::has($route) ? route($route, $params) : null;
    }
}
