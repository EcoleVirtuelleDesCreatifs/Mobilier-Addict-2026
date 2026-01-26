<nav class="custom-main-menu">
    <ul>
        @foreach($menus as $menu)
            <li class="{{ $menu->children->isNotEmpty() ? 'has-submenu' : '' }} {{ Request::is(ltrim($menu->url, '/')) ? 'active' : '' }}">
                <a href="{{ url($menu->url) }}">
                    {{ $menu->title }}
                    @if($menu->children->isNotEmpty())
                        <span class="submenu-indicator">▼</span>
                    @endif
                </a>
                @if($menu->children->isNotEmpty())
                    <ul class="submenu">
                        @foreach($menu->children as $child)
                            <li><a href="{{ url($child->url) }}">{{ $child->title }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
