@extends('maquette.layout')

@section('title', ($pageTitle ?? 'Tous les produits') . ' à Abidjan | Mobilier Addict Côte d\'Ivoire')
@section('meta_description', $pageMetaDescription ?? 'Achetez ' . ($pageTitle ?? 'tous les produits') . ' à Abidjan avec Mobilier Addict. Livraison en Côte d\'Ivoire, mobilier, literie et électroménager pour la maison.')

@section('content')
    @if(request()->routeIs('nouveautes.index'))
        <section class="new-arrivals-head" aria-labelledby="new-arrivals-title">
            <div class="container">
                <div class="new-arrivals-head__inner">
                    <div class="new-arrivals-head__copy">
                        <span class="new-arrivals-head__kicker">Fraîchement ajoutés</span>
                        <h1 id="new-arrivals-title">Nos dernières <span>nouveautés.</span></h1>
                        <p>Découvrez les pièces qui viennent de rejoindre notre catalogue, sélectionnées pour renouveler votre intérieur.</p>
                    </div>
                    <div class="new-arrivals-head__count">
                        <strong>{{ number_format(method_exists($products, 'total') ? $products->total() : $products->count(), 0, ',', ' ') }}</strong>
                        <span>nouveaux produits</span>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @include('maquette.includes.product-collection', [
        'collectionProducts' => $products,
        'collectionTitle' => $pageHeading ?? $pageTitle ?? 'Tous les produits',
        'collectionDescription' => request()->routeIs('nouveautes.index') ? null : ($pageSubtitle ?? null),
        'collectionCategories' => $menuCategories ?? collect(),
        'hideCollectionTitle' => request()->routeIs('nouveautes.index'),
    ])
@endsection

@push('styles')
<style>
.new-arrivals-head{padding:64px 0 50px;background:#f7f4f6;position:relative;overflow:hidden;border-bottom:1px solid #eee7ec}.new-arrivals-head::after{content:"N";position:absolute;right:4%;top:-64px;font-size:240px;line-height:1;font-weight:900;color:rgba(0,35,77,.035);pointer-events:none}.new-arrivals-head__inner{display:flex;align-items:end;justify-content:space-between;gap:40px;position:relative;z-index:1}.new-arrivals-head__copy{max-width:720px}.new-arrivals-head__kicker{display:inline-flex;align-items:center;gap:10px;color:#ec4899;font-size:11px;font-weight:800;letter-spacing:.15em;text-transform:uppercase;margin-bottom:13px}.new-arrivals-head__kicker::before{content:"";width:34px;height:2px;background:#ec4899}.new-arrivals-head h1{margin:0;color:#00234D;font-size:clamp(36px,5vw,64px);line-height:1.02;font-weight:800;letter-spacing:-.045em}.new-arrivals-head h1 span{color:#ec4899;font-style:italic}.new-arrivals-head p{max-width:620px;margin:16px 0 0;color:#667085;font-size:14px;line-height:1.7}.new-arrivals-head__count{flex:0 0 auto;min-width:150px;background:#00234D;color:#fff;border-radius:20px;padding:19px 22px;text-align:center;box-shadow:0 14px 34px rgba(0,35,77,.16)}.new-arrivals-head__count strong,.new-arrivals-head__count span{display:block}.new-arrivals-head__count strong{font-size:27px;line-height:1;color:#fff}.new-arrivals-head__count span{margin-top:6px;color:rgba(255,255,255,.58);font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:.09em}.new-arrivals-head+.collection{padding-top:46px!important}
@media(max-width:767.98px){.new-arrivals-head{padding:45px 0 38px}.new-arrivals-head__inner{align-items:flex-start;flex-direction:column;gap:23px}.new-arrivals-head p{font-size:13px}.new-arrivals-head__count{min-width:0;width:100%;display:flex;align-items:center;justify-content:center;gap:8px;padding:14px}.new-arrivals-head__count strong{font-size:21px}.new-arrivals-head__count span{margin:0}.new-arrivals-head::after{font-size:170px;right:-25px}.new-arrivals-head+.collection{padding-top:30px!important}}
</style>
@endpush
