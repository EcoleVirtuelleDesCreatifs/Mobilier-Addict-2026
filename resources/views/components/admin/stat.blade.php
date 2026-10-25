@props(['label', 'value', 'icon' => 'fa-solid fa-chart-simple', 'tone' => 'navy', 'hint' => null, 'href' => null])

@php
    $statTag = $href ? 'a' : 'div';
@endphp

<{{ $statTag }} @if ($href) href="{{ $href }}" @endif class="ad-stat tone-{{ $tone }}">
    <span class="ad-stat-icon"><i class="{{ $icon }}"></i></span>
    <span style="min-width:0">
        <span class="ad-stat-label d-block">{{ $label }}</span>
        <span class="ad-stat-value d-block text-truncate">{{ $value }}</span>
        @if ($hint)
            <span class="ad-stat-hint d-block text-truncate">{{ $hint }}</span>
        @endif
    </span>
</{{ $statTag }}>
