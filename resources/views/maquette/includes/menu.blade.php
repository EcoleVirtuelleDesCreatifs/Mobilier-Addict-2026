@php
/**
 * Rendu du menu principal.
 * Variables optionnelles :
 *   $menu_class   : classes CSS ajoutées au <ul>
 *   $menu_mobile  : true pour le drawer mobile
 *   $menu_active  : slug de l'entrée active
 *   $menu_list    : liste d'entrées alternative
 */
$menu_class  = $menu_class  ?? '';
$menu_mobile = $menu_mobile ?? false;
$menu_active = $menu_active ?? (request()->route()?->getName() === 'menu.show'
    ? (string) request()->route('slug')
    : (request()->routeIs('home') ? 'index' : (request()->route()?->getName() ?? 'index')));
$_link_class = 'nav-link' . (isset($menu_link_class) ? ' ' . $menu_link_class : '');

// Use dynamic menus from DB if available, otherwise fallback to config
if (!empty($headerMenus) && $headerMenus->isNotEmpty()) {
    $_items = $headerMenus->map(function ($menu) {
        $slug = strtolower((string) ($menu->slug ?? ''));
        $customUrl = trim((string) ($menu->url ?? ''));
        if ($customUrl !== '') {
            $url = str_starts_with($customUrl, 'http') ? $customUrl : url($customUrl);
        } else {
            $url = in_array($slug, ['accueil', 'home', '/'], true) ? 'home' : ($slug !== '' ? 'menu.show:' . $menu->slug : 'home');
        }
        return [
            'slug'  => $slug === '/' ? 'index' : $slug,
            'label' => $menu->name,
            'url'   => $url,
        ];
    })->toArray();
} else {
    $_items = $menu_list ?? config('maquette.menu_items', []);
}
@endphp
<ul class="main-menu list-unstyled{{ $menu_class !== '' ? ' ' . $menu_class : '' }}">
@foreach ($_items as $item)
    @php $active = $menu_active === $item['slug'] || ($item['slug'] !== 'index' && request()->is($item['slug'])); @endphp
    @php
        $itemUrl = $item['url'];
        if (str_starts_with($itemUrl, 'http')) {
            // URL absolue déjà résolue
        } elseif (str_contains($itemUrl, ':')) {
            [$routeName, $param] = explode(':', $itemUrl, 2);
            $itemUrl = route($routeName, $param);
        } else {
            $itemUrl = route($itemUrl);
        }
    @endphp
    @php
        $menuIcons = [
            'index' => '<path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M9 21v-6h6v6"/>',
            'accueil' => '<path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M9 21v-6h6v6"/>',
            'matelas' => '<path d="M3 18v-6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v6"/><path d="M3 18h18"/><path d="M6 10V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3"/>',
            'protege-matelas-impermeable' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
            'oreillers-et-taies' => '<path d="M5 11a2 2 0 0 1 2 2v2h10v-2a2 2 0 1 1 4 0v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="M5 11V9a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2"/><path d="M11.25 5 9 7l2.25 2"/><path d="M12.75 5 15 7l-2.25 2"/>',
            'drap-et-couettes' => '<path d="m12 2 9 5-9 5-9-5 9-5z"/><path d="m3 12 9 5 9-5"/><path d="m3 17 9 5 9-5"/>',
            'draps-et-couettes' => '<path d="m12 2 9 5-9 5-9-5 9-5z"/><path d="m3 12 9 5 9-5"/><path d="m3 17 9 5 9-5"/>',
            'lit-canape' => '<path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1H6v-1a2 2 0 0 0-4 0Z"/><path d="M4 18v2"/><path d="M20 18v2"/>',
            'mobilier-accessoire' => '<path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1H6v-1a2 2 0 0 0-4 0Z"/><path d="M4 18v2"/><path d="M20 18v2"/>',
            'meuble-et-fauteuil' => '<path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1H6v-1a2 2 0 0 0-4 0Z"/><path d="M4 18v2"/><path d="M20 18v2"/>',
            'electromenager' => '<rect x="7" y="2" width="10" height="20" rx="2"/><path d="M12 18h.01"/>',
            'conseils' => '<path d="M12 2a7 7 0 0 1 7 7c0 2.4-1.2 4.5-3 5.7V17a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-2.3C6.2 13.5 5 11.4 5 9a7 7 0 0 1 7-7z"/><path d="M9 21h6"/>',
        ];
        $iconPath = $menuIcons[$item['slug']] ?? '<circle cx="12" cy="12" r="9"/>';
    @endphp
    <li class="menu-list-item nav-item{{ $active ? ' active' : '' }}">
        <a class="{{ $_link_class }}{{ $active && $menu_mobile ? ' active' : '' }}" href="{{ $itemUrl }}"@if($active) aria-current="page"@endif><span class="nav-icon" aria-hidden="true"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $iconPath !!}</svg></span>{{ html_entity_decode((string) $item['label'], ENT_QUOTES | ENT_HTML5, 'UTF-8') }}</a>
    </li>
@endforeach
</ul>
@php unset($menu_class, $menu_mobile, $menu_link_class, $menu_list, $menu_active); @endphp
