<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $shell = \App\Support\AdminShell::payload();
        $pageTitle = trim($__env->yieldContent('title')) ?: $shell['title'];
        $shell['title'] = $pageTitle;
    @endphp
    <title>{{ $pageTitle }} | Mobilier Addict</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/favicon.png') }}">

    <link rel="stylesheet" href="{{ \App\Support\AdminShell::asset('assets/admin-app/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ \App\Support\AdminShell::asset('assets/admin-app/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ \App\Support\AdminShell::asset('assets/admin-app/css/admin.css') }}">
    @stack('styles')
</head>
<body class="ad-body">
    <script>if (localStorage.getItem('ma-admin-sidebar-mini') === '1') document.body.classList.add('ad-mini');</script>

    <script type="application/json" id="ad-shell-data">{!! \App\Support\AdminShell::json($shell) !!}</script>
    <div class="ad-shell-root" data-vue="shell" data-source="ad-shell-data"></div>

    <main class="ad-main" id="main-wrapper">
        @yield('content')

        <footer class="ad-footer">
            <span>© {{ date('Y') }} Mobilier Addict</span>
            <a href="{{ url('/') }}" target="_blank" rel="noopener">mobilier-addict.com</a>
        </footer>
    </main>

    <div class="ad-shell-root" data-vue="feedback"></div>

    <noscript>
        <div class="alert alert-warning m-3">JavaScript est requis pour la navigation de l'administration.</div>
    </noscript>

    <script src="{{ \App\Support\AdminShell::asset('assets/admin-app/vendor/vue.global.prod.js') }}"></script>
    <script src="{{ \App\Support\AdminShell::asset('assets/admin-app/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ \App\Support\AdminShell::asset('assets/admin-app/js/core.js') }}"></script>
    <script src="{{ \App\Support\AdminShell::asset('assets/admin-app/js/components/shell.js') }}"></script>
    <script src="{{ \App\Support\AdminShell::asset('assets/admin-app/js/components/feedback.js') }}"></script>
    @stack('admin-components')
    <script src="{{ \App\Support\AdminShell::asset('assets/admin-app/js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
