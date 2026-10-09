@php
$footerMenus = config('maquette.footer_menus', []);
$currentRoute = request()->route() ? request()->route()->getName() : '';
@endphp
@foreach ($footerMenus[$footerGroup] ?? [] as [$url, $label])
    @php
        $resolvedUrl = $url;
        $isActive = false;
        if (str_contains($url, ':')) {
            [$routeName, $param] = explode(':', $url, 2);
            $resolvedUrl = route($routeName, $param);
            $isActive = $currentRoute === $routeName;
        } else {
            $resolvedUrl = route($url);
            $isActive = $currentRoute === $url;
        }
    @endphp
    <li class="footer-menu-item"><a href="{{ $resolvedUrl }}"{{ $isActive ? ' aria-current="page"' : '' }}>{{ $label }}</a></li>
@endforeach
@php unset($footerGroup); @endphp
