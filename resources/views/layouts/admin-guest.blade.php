<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@hasSection('title')@yield('title') | Mobilier Addict@else {{ config('app.name', 'Mobilier Addict') }} @endif</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
        @stack('styles')
    </head>
    <body class="admin-body">
        <div class="container-fluid px-0">
            <div class="d-flex min-vh-100">
                <div class="flex-grow-1 min-w-0">
                    <header class="admin-topbar">
                        <div class="d-flex align-items-center justify-content-between gap-3 px-3 px-md-4 py-3">
                            <a href="{{ url('/') }}" class="text-decoration-none">
                                <div class="admin-brand">Mobilier Addict</div>
                                <div class="small" style="color: var(--admin-muted);">Espace Administrateur</div>
                            </a>
                            <a href="{{ url('/') }}" class="btn btn-admin-ghost">Retour au site</a>
                        </div>
                    </header>

                    <main class="py-4 py-md-5">
                        <div class="container" style="max-width: 980px;">
                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @stack('scripts')
    </body>
</html>
