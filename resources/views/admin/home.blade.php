@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <script type="application/json" id="ad-dashboard-data">{!! \App\Support\AdminShell::json($dashboard ?? []) !!}</script>
            <div data-vue="dashboard" data-source="ad-dashboard-data">
                <div class="row g-3">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="col-6 col-xl-3"><div class="ad-skeleton" style="height:96px"></div></div>
                    @endfor
                    <div class="col-12"><div class="ad-skeleton" style="height:120px"></div></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin-components')
    <script defer src="{{ \App\Support\AdminShell::asset('assets/admin-app/js/pages/dashboard.js') }}"></script>
@endpush
