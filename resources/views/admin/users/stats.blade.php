@extends('layouts.admin')

@section('title', 'Statistiques utilisateurs')

@php
    $totalUsers = (int) ($summary->total ?? 0);
    $maxGrowth = max(1, (int) $monthlyGrowth->max('total'));
    $roleLabels = ['super_admin' => 'Super administrateurs', 'admin' => 'Administrateurs', 'editor' => 'Éditeurs', 'writer' => 'Rédacteurs', 'user' => 'Utilisateurs', 'sans_role' => 'Sans rôle'];
@endphp

@section('content')
<div class="content-body user-stats-page">
    <div class="container-fluid">
        <header class="user-stats-head">
            <div>
                <p>Administration</p>
                <h1>Statistiques utilisateurs</h1>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.users.create') }}" class="user-stats-btn is-primary"><i class="fas fa-user-plus"></i> Ajouter</a>
                <a href="{{ route('admin.users.index') }}" class="user-stats-btn"><i class="fas fa-users"></i> Liste des utilisateurs</a>
            </div>
        </header>

        <section class="user-kpis">
            <div class="user-kpi">
                <span class="user-kpi-icon"><i class="fas fa-users"></i></span>
                <div><small>Total</small><strong>{{ number_format($totalUsers, 0, ',', ' ') }}</strong><span>comptes</span></div>
            </div>
            <div class="user-kpi is-success">
                <span class="user-kpi-icon"><i class="fas fa-user-check"></i></span>
                <div><small>Actifs</small><strong>{{ number_format((int) ($summary->active ?? 0), 0, ',', ' ') }}</strong><span>{{ $totalUsers ? round(((int) $summary->active / $totalUsers) * 100) : 0 }} % du total</span></div>
            </div>
            <div class="user-kpi is-pink">
                <span class="user-kpi-icon"><i class="fas fa-user-plus"></i></span>
                <div><small>Nouveaux ce mois</small><strong>{{ number_format((int) ($summary->new_this_month ?? 0), 0, ',', ' ') }}</strong><span>inscriptions</span></div>
            </div>
            <div class="user-kpi is-info">
                <span class="user-kpi-icon"><i class="fas fa-bolt"></i></span>
                <div><small>Actifs récemment</small><strong>{{ number_format((int) ($summary->recently_active ?? 0), 0, ',', ' ') }}</strong><span>30 derniers jours</span></div>
            </div>
        </section>

        <div class="user-stats-grid">
            <section class="user-stat-card">
                <div class="user-card-head">
                    <div><h2>Évolution des inscriptions</h2><p>Six derniers mois</p></div>
                </div>
                <div class="user-growth-chart">
                    @foreach($monthlyGrowth as $month)
                        <div class="user-growth-column">
                            <strong>{{ $month['total'] }}</strong>
                            <div class="user-growth-track"><span style="height:{{ max(5, round(($month['total'] / $maxGrowth) * 100)) }}%"></span></div>
                            <small>{{ $month['label'] }}</small>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="user-stat-card">
                <div class="user-card-head">
                    <div><h2>Répartition par rôle</h2><p>Accès à l’administration</p></div>
                </div>
                <div class="user-role-list">
                    @forelse($roleCounts as $role)
                        @php($percentage = $totalUsers ? round(((int) $role->total / $totalUsers) * 100) : 0)
                        <div class="user-role-row">
                            <div><strong>{{ $roleLabels[$role->role_name] ?? ucfirst(str_replace('_', ' ', $role->role_name)) }}</strong><span>{{ $role->total }} compte{{ $role->total > 1 ? 's' : '' }}</span></div>
                            <div class="user-role-progress"><span style="width:{{ $percentage }}%"></span></div>
                            <em>{{ $percentage }}%</em>
                        </div>
                    @empty
                        <div class="user-stats-empty">Aucun rôle attribué.</div>
                    @endforelse
                </div>
            </section>
        </div>

        <section class="user-stat-card user-recent-card">
            <div class="user-card-head">
                <div><h2>Derniers utilisateurs</h2><p>Les dix inscriptions les plus récentes</p></div>
                <a href="{{ route('admin.users.index') }}">Tout voir</a>
            </div>
            <div class="table-responsive">
                <table class="table user-stats-table align-middle mb-0">
                    <thead><tr><th>Utilisateur</th><th>Rôle</th><th>Statut</th><th>Dernière connexion</th><th>Inscription</th><th></th></tr></thead>
                    <tbody>
                        @forelse($recentUsers as $user)
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <span class="user-avatar">{{ mb_strtoupper(mb_substr($user->name ?: $user->email, 0, 1)) }}</span>
                                        <div><strong>{{ $user->name ?: 'Sans nom' }}</strong><small>{{ $user->email }}</small></div>
                                    </div>
                                </td>
                                <td><span class="user-role-badge">{{ $roleLabels[$user->role] ?? ucfirst(str_replace('_', ' ', $user->role ?: 'Sans rôle')) }}</span></td>
                                <td><span class="user-state {{ $user->is_active ? 'is-active' : '' }}">{{ $user->is_active ? 'Actif' : 'Inactif' }}</span></td>
                                <td><span class="user-date">{{ $user->last_login_at?->diffForHumans() ?? 'Jamais' }}</span></td>
                                <td><span class="user-date">{{ $user->created_at?->format('d/m/Y') }}</span></td>
                                <td class="text-end"><a href="{{ route('admin.users.edit', $user) }}" class="user-edit-link" aria-label="Modifier {{ $user->name }}"><i class="fas fa-arrow-right"></i></a></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="user-stats-empty">Aucun utilisateur.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="user-health">
            <div><span class="user-health-dot is-green"></span><strong>{{ number_format((int) ($summary->active ?? 0)) }}</strong><small>Comptes actifs</small></div>
            <div><span class="user-health-dot is-red"></span><strong>{{ number_format((int) ($summary->inactive ?? 0)) }}</strong><small>Comptes désactivés</small></div>
            <div><span class="user-health-dot is-gray"></span><strong>{{ number_format((int) ($summary->never_logged_in ?? 0)) }}</strong><small>Jamais connectés</small></div>
        </section>
    </div>
</div>
@endsection

@push('styles')
<style>
.user-stats-page{background:#f5f7fa;min-height:100vh}.user-stats-page .container-fluid{padding:28px 30px 40px}.user-stats-head{display:flex;align-items:end;justify-content:space-between;gap:20px;margin-bottom:24px}.user-stats-head p{margin:0 0 3px;color:#929baa;font-size:11px;text-transform:uppercase;letter-spacing:.1em}.user-stats-head h1{margin:0;color:#00234D;font-size:27px;font-weight:800;letter-spacing:-.03em}.user-stats-btn{height:38px;padding:0 13px;border-radius:10px;border:1px solid #dde3ea;background:#fff;color:#00234D;display:inline-flex;align-items:center;gap:7px;text-decoration:none;font-size:11px;font-weight:700}.user-stats-btn:hover{border-color:#ec4899;color:#ec4899}.user-stats-btn.is-primary{background:#ec4899;border-color:#ec4899;color:#fff}.user-stats-btn.is-primary:hover{background:#d43682;color:#fff}
.user-kpis{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-bottom:18px}.user-kpi{display:flex;align-items:center;gap:13px;padding:18px;background:#fff;border:1px solid #e5e9ef;border-radius:16px}.user-kpi-icon{width:43px;height:43px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:rgba(0,35,77,.07);color:#00234D;flex:0 0 43px}.user-kpi small,.user-kpi strong,.user-kpi span{display:block}.user-kpi small{font-size:9px;text-transform:uppercase;letter-spacing:.09em;color:#929baa}.user-kpi strong{font-size:22px;color:#00234D;line-height:1.2}.user-kpi div>span{font-size:9px;color:#9da5b1}.user-kpi.is-success .user-kpi-icon{background:#e9f8ef;color:#16813d}.user-kpi.is-pink .user-kpi-icon{background:#fff0f7;color:#ec4899}.user-kpi.is-info .user-kpi-icon{background:#eaf6ff;color:#1681be}
.user-stats-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:18px}.user-stat-card{background:#fff;border:1px solid #e5e9ef;border-radius:17px;padding:21px;box-shadow:0 8px 24px rgba(0,35,77,.035)}.user-card-head{display:flex;align-items:center;justify-content:space-between;gap:15px;margin-bottom:20px}.user-card-head h2{margin:0;color:#00234D;font-size:15px;font-weight:800}.user-card-head p{margin:2px 0 0;color:#9aa3b0;font-size:10px}.user-card-head>a{font-size:10px;font-weight:800;color:#ec4899;text-decoration:none;text-transform:uppercase;letter-spacing:.06em}
.user-growth-chart{height:210px;display:flex;align-items:end;justify-content:space-around;gap:14px;padding-top:20px}.user-growth-column{height:100%;flex:1;display:flex;flex-direction:column;align-items:center;justify-content:end;gap:7px}.user-growth-column>strong{font-size:10px;color:#697587}.user-growth-track{width:26px;height:145px;background:#f1f3f6;border-radius:8px;position:relative;overflow:hidden}.user-growth-track span{position:absolute;left:0;right:0;bottom:0;border-radius:8px;background:linear-gradient(180deg,#ec4899,#c52e77);min-height:5px}.user-growth-column small{text-transform:capitalize;font-size:9px;color:#8d97a5}
.user-role-list{display:flex;flex-direction:column;gap:15px}.user-role-row{display:grid;grid-template-columns:145px 1fr 38px;align-items:center;gap:12px}.user-role-row strong,.user-role-row span{display:block}.user-role-row strong{color:#344058;font-size:10.5px}.user-role-row div:first-child span{color:#a0a8b4;font-size:8.5px;margin-top:2px}.user-role-progress{height:7px;border-radius:999px;background:#f0f2f5;overflow:hidden}.user-role-progress span{height:100%;background:#00234D;border-radius:999px}.user-role-row:nth-child(2n) .user-role-progress span{background:#ec4899}.user-role-row em{font-size:9px;color:#7f8997;font-style:normal;text-align:right}
.user-recent-card{margin-bottom:14px}.user-stats-table thead th{border:0;border-bottom:1px solid #edf0f4;color:#98a2b0;font-size:8.5px;text-transform:uppercase;letter-spacing:.08em;padding:9px 11px}.user-stats-table tbody td{border-color:#f0f2f5;padding:10px 11px}.user-cell{display:flex;align-items:center;gap:10px;min-width:190px}.user-avatar{width:35px;height:35px;border-radius:10px;background:#00234D;color:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;flex:0 0 35px}.user-cell strong,.user-cell small{display:block}.user-cell strong{font-size:10.5px;color:#303c51}.user-cell small{font-size:8.5px;color:#9ca4b0;margin-top:2px}.user-role-badge,.user-state{display:inline-block;border-radius:999px;background:#f0f2f5;color:#667181;padding:5px 8px;font-size:8px;font-weight:800;text-transform:uppercase}.user-state.is-active{background:#e9f8ef;color:#16813d}.user-date{font-size:9px;color:#818b99}.user-edit-link{width:28px;height:28px;border-radius:8px;background:#f3f5f7;color:#00234D;display:inline-flex;align-items:center;justify-content:center;text-decoration:none}.user-edit-link:hover{background:#ec4899;color:#fff}.user-stats-empty{text-align:center;color:#9ba4b1;font-size:11px;padding:30px!important}
.user-health{display:grid;grid-template-columns:repeat(3,1fr);background:#fff;border:1px solid #e5e9ef;border-radius:14px;overflow:hidden}.user-health>div{display:flex;align-items:center;justify-content:center;gap:8px;padding:13px;border-left:1px solid #edf0f4}.user-health>div:first-child{border-left:0}.user-health-dot{width:7px;height:7px;border-radius:50%}.user-health-dot.is-green{background:#16a34a}.user-health-dot.is-red{background:#dc3545}.user-health-dot.is-gray{background:#98a2b3}.user-health strong{font-size:13px;color:#00234D}.user-health small{font-size:9px;color:#919aa7}
@media(max-width:991.98px){.user-kpis{grid-template-columns:repeat(2,1fr)}.user-stats-grid{grid-template-columns:1fr}}
@media(max-width:767.98px){.user-stats-page .container-fluid{padding:20px 15px 32px}.user-stats-head{align-items:flex-start;flex-direction:column}.user-stats-head h1{font-size:23px}.user-kpis{gap:9px}.user-kpi{padding:12px;gap:9px}.user-kpi-icon{width:36px;height:36px;flex-basis:36px}.user-kpi strong{font-size:18px}.user-role-row{grid-template-columns:110px 1fr 32px}.user-health{grid-template-columns:1fr}.user-health>div{border-left:0;border-top:1px solid #edf0f4}.user-health>div:first-child{border-top:0}}
</style>
@endpush
