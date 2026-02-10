@extends('layouts.front')

@section('title', $pageTitle)
@section('meta_description', 'Découvrez nos produits pour ' . $pageTitle . ' sur Mobilier Addict.')

@section('content')
@php $isMatelasMenu = strtolower(trim((string) ($menu->slug ?? ''))) === 'matelas'; @endphp

@if($isMatelasMenu)
    <style>
        .matelas-page{
            --ma-rose:#ff3a7f;
            --ma-navy:#0b1b3a;
            --ma-ink:#071126;
            --ma-sky:#6ee7ff;
            --ma-border:#e2e8f0;
            --ma-muted:#64748b;
            background:linear-gradient(180deg,#fff,#f8fafc);
        }
        .matelas-hero{padding:140px 0 110px;min-height:520px;display:flex;align-items:center;background:linear-gradient(180deg, #1f2a45 0%, #2b3650 100%);color:#fff;position:relative;overflow:hidden;}
        .matelas-hero::before{content:"";position:absolute;inset:-2px;background:radial-gradient(900px 420px at 30% 20%, rgba(255,58,127,.20), rgba(255,58,127,0) 60%), radial-gradient(900px 520px at 80% 10%, rgba(110,231,255,.14), rgba(110,231,255,0) 62%);pointer-events:none;}
        .matelas-hero::after{content:"";position:absolute;left:0;right:0;bottom:-1px;height:2px;background:rgba(255,255,255,.10);pointer-events:none;}
        .matelas-clouds{position:absolute;inset:0;pointer-events:none;opacity:.95;}
        .matelas-cloud{position:absolute;width:220px;height:86px;border-radius:999px;background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.14);box-shadow:0 30px 80px rgba(0,0,0,.20);backdrop-filter: blur(2px);filter: saturate(1.05);animation:maCloudFloat 12s ease-in-out infinite;}
        .matelas-cloud::before,.matelas-cloud::after{content:"";position:absolute;background:inherit;border:inherit;border-radius:999px;}
        .matelas-cloud::before{width:90px;height:90px;left:18px;top:-36px;box-shadow:inherit;}
        .matelas-cloud::after{width:120px;height:120px;left:92px;top:-56px;box-shadow:inherit;}
        .matelas-cloud--a{left:-70px;top:88px;transform:rotate(-4deg);animation-duration:14s;}
        .matelas-cloud--b{right:-90px;top:56px;transform:rotate(6deg);width:260px;height:96px;animation-duration:16s;}
        .matelas-cloud--c{left:12%;bottom:64px;transform:rotate(2deg);width:240px;height:92px;animation-duration:18s;opacity:.85;}
        .matelas-cloud--d{right:14%;bottom:34px;transform:rotate(-3deg);width:190px;height:78px;animation-duration:13s;opacity:.75;}
        @keyframes maCloudFloat{0%,100%{transform:translate3d(0,0,0) rotate(var(--r,0deg));}50%{transform:translate3d(18px,-10px,0) rotate(var(--r,0deg));}}
        .matelas-hero__inner{text-align:center;max-width:960px;margin:0 auto;position:relative;}
        .matelas-hero__title{font-size:46px;line-height:1.06;margin:0 0 10px;color:#fff;letter-spacing:-.04em;font-weight:1000;text-shadow:0 18px 40px rgba(0,0,0,.25);}
        .matelas-hero__subtitle{font-size:13px;line-height:1.5;color:rgba(241,245,249,.86);max-width:62ch;margin:0 auto;font-weight:700;}
        .matelas-hero__cta{display:flex;gap:10px;flex-wrap:wrap;justify-content:center;margin-top:18px;}

        .matelas-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;border-radius:999px;padding:12px 16px;font-weight:900;text-decoration:none;}
        .matelas-btn--primary{background:linear-gradient(135deg,var(--ma-rose),#ff2e72);color:#fff;box-shadow:0 22px 48px rgba(255,58,127,.28);}
        .matelas-btn--ghost{background:rgba(255,255,255,.75);backdrop-filter: blur(10px);color:var(--ma-navy);border:1px solid var(--ma-border);}

        .matelas-btn--navy{background:rgba(9,16,34,.70);color:#fff;border:1px solid rgba(255,255,255,.18);box-shadow:0 18px 40px rgba(0,0,0,.22);}
        .matelas-btn--navy:hover{filter:brightness(1.06);}

        a:focus-visible, button:focus-visible, [role="tab"]:focus-visible{outline:none;box-shadow:0 0 0 3px rgba(255,58,127,.22), 0 0 0 6px rgba(11,27,58,.14);border-radius:999px;}
        .matelas-btn, .matelas-tab, .product-card, .matelas-mini, .matelas-banner__media{transition:transform .18s ease, box-shadow .18s ease, filter .18s ease;}
        .matelas-btn:active, .matelas-tab:active, .matelas-mini__add:active, .product-card__btn:active{transform:translateY(1px);}

        [data-reveal]{opacity:0;transform:translateY(10px);filter:blur(1.5px);transition:opacity .55s ease, transform .55s ease, filter .55s ease;will-change:opacity, transform, filter;}
        [data-reveal].is-revealed{opacity:1;transform:none;filter:none;}

        .matelas-subnav{position:sticky;top:0;z-index:20;background:rgba(255,255,255,.75);backdrop-filter: blur(10px);border-top:1px solid #f1f5f9;border-bottom:1px solid #e2e8f0;}
        .matelas-subnav__inner{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:12px 0;}
        .matelas-subnav__title{font-weight:950;color:var(--ma-navy);font-size:13px;letter-spacing:-.01em;}
        .matelas-subnav__links{display:flex;gap:8px;overflow:auto;scrollbar-width:none;}
        .matelas-subnav__links::-webkit-scrollbar{display:none;}
        .matelas-chip{display:inline-flex;align-items:center;gap:8px;padding:10px 12px;border-radius:999px;border:1px solid var(--ma-border);background:#fff;color:var(--ma-navy);font-weight:900;font-size:12px;text-decoration:none;white-space:nowrap;}
        .matelas-chip:hover{border-color:#cbd5e1;}

        .matelas-section{padding:54px 0;}
        .matelas-section--alt{background:linear-gradient(180deg,var(--ma-navy),#050b18);}
        .matelas-section__grid{display:grid;grid-template-columns:1fr 1fr;gap:22px;align-items:center;}
        .matelas-section__eyebrow{font-weight:950;color:var(--ma-muted);text-transform:uppercase;letter-spacing:.10em;font-size:12px;}
        .matelas-section__name{font-weight:1000;color:var(--ma-ink);font-size:34px;line-height:1.05;letter-spacing:-.02em;margin:10px 0 10px;}
        .matelas-section--alt .matelas-section__name{color:#fff;}
        .matelas-section__desc{color:#475569;font-weight:700;max-width:60ch;margin:0;}
        .matelas-section--alt .matelas-section__desc{color:rgba(241,245,249,.82);}
        .matelas-bullets{display:grid;gap:10px;margin:18px 0 0;padding:0;list-style:none;}
        .matelas-bullets li{display:flex;gap:10px;align-items:flex-start;font-weight:800;color:#0b1220;}
        .matelas-section--alt .matelas-bullets li{color:#fff;}
        .matelas-bullets li span{color:#64748b;font-weight:700;display:block;margin-top:2px;}
        .matelas-section--alt .matelas-bullets li span{color:rgba(241,245,249,.72);}
        .matelas-media{border-radius:28px;overflow:hidden;border:1px solid #e2e8f0;background:linear-gradient(135deg,#f8fafc,#fff);box-shadow:0 30px 70px rgba(2,6,23,.08);}
        .matelas-section--alt .matelas-media{border-color:rgba(148,163,184,.2);box-shadow:0 30px 70px rgba(0,0,0,.35);}
        .matelas-media img{width:100%;height:100%;object-fit:cover;display:block;aspect-ratio: 4 / 3;}
        .matelas-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:18px;}
        .matelas-link{display:inline-flex;align-items:center;gap:8px;font-weight:950;text-decoration:none;color:var(--ma-rose);}
        .matelas-section--alt .matelas-link{color:var(--ma-sky);}
        .matelas-actions form{margin:0;}
        .matelas-cartbtn{border:0;cursor:pointer;}

        .matelas-block{padding:22px 0;}
        .matelas-block__head{position:relative;text-align:center;margin-bottom:18px;padding:46px 16px 22px;border-radius:28px;background:linear-gradient(180deg, rgba(11,27,58,.07), rgba(11,27,58,0));overflow:hidden;border:1px solid rgba(226,232,240,.85);}
        .matelas-block__head::before{content:"";position:absolute;inset:-2px;background:radial-gradient(760px 260px at 18% 30%, rgba(255,58,127,.18), rgba(255,58,127,0) 60%), radial-gradient(760px 320px at 82% 20%, rgba(110,231,255,.14), rgba(110,231,255,0) 62%);pointer-events:none;}
        .matelas-block__head::after{content:"PETIT PRIX";position:absolute;left:50%;top:50%;transform:translate(-50%,-55%);font-weight:1000;letter-spacing:.18em;text-transform:uppercase;font-size:72px;line-height:1;color:rgba(11,27,58,.06);white-space:nowrap;pointer-events:none;}
        .matelas-block__head > *{position:relative;}
        .matelas-marquee{position:absolute;left:-8%;right:-8%;top:14px;height:32px;display:flex;align-items:center;overflow:hidden;opacity:.9;pointer-events:none;transform:none;}
        .matelas-marquee__track{display:flex;gap:18px;align-items:center;white-space:nowrap;will-change:transform;animation:maMarquee 16s linear infinite;transform:translateY(0);}
        .matelas-marquee__item{display:inline-flex;align-items:center;gap:10px;font-weight:1000;letter-spacing:.10em;text-transform:uppercase;font-size:11px;line-height:1;color:rgba(11,27,58,.62);}
        .matelas-marquee__dot{width:6px;height:6px;border-radius:999px;background:linear-gradient(135deg,var(--ma-rose),rgba(110,231,255,.9));box-shadow:0 10px 20px rgba(255,58,127,.18);}
        .matelas-block__pill{display:inline-flex;align-items:center;justify-content:center;padding:10px 16px;border-radius:999px;background:linear-gradient(135deg,var(--ma-rose),#ff2e72);color:#fff;font-weight:1000;text-transform:uppercase;letter-spacing:.08em;font-size:10px;box-shadow:0 18px 46px rgba(255,58,127,.25);}
        .matelas-block__title{margin:18px 0 10px;font-weight:1000;letter-spacing:-.06em;line-height:.98;font-size:48px;color:var(--ma-ink);}
        .matelas-block__title span{background:linear-gradient(135deg,var(--ma-navy),#0b1b3a 35%, var(--ma-rose));-webkit-background-clip:text;background-clip:text;color:transparent;}
        .matelas-block__outline{display:inline-block;-webkit-text-stroke:1px rgba(11,27,58,.25);color:transparent;}
        .matelas-block__subtitle{margin:0 auto;max-width:70ch;color:#475569;font-weight:800;font-size:13px;line-height:1.6;}
        .matelas-block__cta{display:flex;gap:10px;justify-content:center;flex-wrap:wrap;margin-top:14px;}
        .matelas-block__stats{display:flex;justify-content:center;flex-wrap:wrap;gap:8px;margin-top:14px;}
        .matelas-stat{display:inline-flex;align-items:center;gap:8px;padding:9px 12px;border-radius:999px;background:rgba(255,255,255,.80);border:1px solid rgba(226,232,240,.95);font-weight:950;color:rgba(11,27,58,.92);font-size:12px;box-shadow:0 14px 34px rgba(2,6,23,.06);}
        .matelas-stat strong{font-weight:1000;}
        .matelas-stat i{width:10px;height:10px;border-radius:999px;background:linear-gradient(135deg,var(--ma-rose),rgba(110,231,255,.9));display:inline-block;}

        .matelas-block__title::after{content:"";display:block;height:4px;width:min(260px, 70%);margin:14px auto 0;border-radius:999px;background:linear-gradient(90deg, rgba(255,58,127,0), rgba(255,58,127,.95), rgba(110,231,255,.55), rgba(255,58,127,0));filter:blur(.2px);animation:maSweep 2.8s ease-in-out infinite;}

        .matelas-orb{position:absolute;width:220px;height:220px;border-radius:999px;filter:blur(26px);opacity:.55;pointer-events:none;}
        .matelas-orb--a{left:-60px;top:-70px;background:radial-gradient(circle at 30% 30%, rgba(255,58,127,.55), rgba(255,58,127,0) 60%);animation:maFloatA 8s ease-in-out infinite;}
        .matelas-orb--b{right:-70px;bottom:-80px;background:radial-gradient(circle at 30% 30%, rgba(110,231,255,.40), rgba(110,231,255,0) 60%);animation:maFloatB 10s ease-in-out infinite;}

        @keyframes maSweep{0%,100%{transform:translateX(-18px);opacity:.75}50%{transform:translateX(18px);opacity:1}}
        @keyframes maMarquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
        @keyframes maFloatA{0%,100%{transform:translate(0,0)}50%{transform:translate(18px,22px)}}
        @keyframes maFloatB{0%,100%{transform:translate(0,0)}50%{transform:translate(-22px,-16px)}}
        .matelas-quick{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:10px 12px;border-radius:999px;background:#0a1733;color:#fff;font-weight:950;border:0;cursor:pointer;}
        .matelas-quick:hover{filter:brightness(1.06);}

        .matelas-banner{padding:54px 0;background:linear-gradient(135deg, #0b1b3a 0%, #071126 100%);color:#fff;position:relative;overflow:hidden;}
        .matelas-banner::before{content:"";position:absolute;inset:-2px;background:radial-gradient(900px 520px at 18% 30%, rgba(255,58,127,.16), rgba(255,58,127,0) 62%), radial-gradient(900px 520px at 82% 14%, rgba(110,231,255,.10), rgba(110,231,255,0) 60%);pointer-events:none;}
        .matelas-banner__grid{display:grid;grid-template-columns:1.08fr .92fr;gap:18px;align-items:center;position:relative;}
        .matelas-banner__card{border-radius:26px;padding:22px 22px 20px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);box-shadow:0 34px 90px rgba(0,0,0,.36);}
        .matelas-banner__eyebrow{display:inline-flex;align-items:center;gap:8px;font-weight:950;letter-spacing:.12em;text-transform:uppercase;font-size:11px;color:rgba(241,245,249,.80);}
        .matelas-banner__eyebrow i{width:8px;height:8px;border-radius:999px;background:var(--ma-rose);display:inline-block;}
        .matelas-banner__title{margin:10px 0 8px;font-weight:1000;letter-spacing:-.05em;line-height:1.02;font-size:34px;}
        .matelas-banner__title strong{color:var(--ma-rose);font-weight:1000;}
        .matelas-banner__title::after{content:"";display:block;height:3px;width:84px;margin:12px 0 0;border-radius:999px;background:linear-gradient(90deg, var(--ma-rose), rgba(110,231,255,.75));}
        .matelas-banner__desc{margin:10px 0 0;color:rgba(241,245,249,.82);font-weight:750;font-size:13px;max-width:70ch;}
        .matelas-banner__meta{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px;}
        .matelas-badge{display:inline-flex;align-items:center;gap:8px;padding:8px 10px;border-radius:999px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);font-weight:950;font-size:11px;color:rgba(241,245,249,.92);}
        .matelas-banner__cta{display:flex;gap:10px;flex-wrap:wrap;margin-top:16px;align-items:center;}
        .matelas-banner__price{font-weight:1000;color:rgba(241,245,249,.92);}
        .matelas-banner__media{border-radius:26px;overflow:hidden;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.04);box-shadow:0 34px 90px rgba(0,0,0,.38);}
        .matelas-banner__media img{width:100%;height:100%;display:block;object-fit:cover;aspect-ratio: 4 / 3;}

        .matelas-tabs{padding:30px 0 10px;}
        .matelas-tabs__wrap{background:#fff;border:1px solid var(--ma-border);border-radius:26px;padding:18px;box-shadow:0 18px 50px rgba(2,6,23,.06);}
        .matelas-tabs__head{position:relative;padding:34px 18px 18px;border-radius:24px;background:linear-gradient(180deg, rgba(11,27,58,.06), rgba(11,27,58,0));border:1px solid rgba(226,232,240,.92);overflow:hidden;}
        .matelas-tabs__head::before{content:"";position:absolute;inset:-2px;background:radial-gradient(760px 260px at 18% 30%, rgba(255,58,127,.12), rgba(255,58,127,0) 60%), radial-gradient(760px 320px at 82% 20%, rgba(110,231,255,.12), rgba(110,231,255,0) 62%);pointer-events:none;}
        .matelas-tabs__head::after{content:"CONFORT";position:absolute;left:18px;top:14px;font-weight:1000;letter-spacing:.20em;text-transform:uppercase;font-size:66px;line-height:1;color:rgba(11,27,58,.06);pointer-events:none;}
        .matelas-tabs__head > *{position:relative;}
        .matelas-tabs__headgrid{display:grid;grid-template-columns:1.2fr .8fr;gap:14px;align-items:center;}
        .matelas-tabs__kicker{display:inline-flex;align-items:center;gap:8px;font-weight:1000;letter-spacing:.12em;text-transform:uppercase;font-size:11px;color:rgba(11,27,58,.70);}
        .matelas-tabs__kicker i{width:8px;height:8px;border-radius:999px;background:linear-gradient(135deg,var(--ma-rose),rgba(110,231,255,.95));display:inline-block;}
        .matelas-tabs__hero{margin:10px 0 10px;font-weight:1000;letter-spacing:-.07em;line-height:1.00;font-size:42px;color:var(--ma-ink);}
        .matelas-tabs__hero span{background:linear-gradient(135deg,var(--ma-navy),#0b1b3a 35%, var(--ma-rose));-webkit-background-clip:text;background-clip:text;color:transparent;}
        .matelas-tabs__hero::after{content:"";display:block;height:4px;width:min(360px, 92%);margin:14px 0 0;border-radius:999px;background:linear-gradient(90deg, rgba(255,58,127,0), rgba(255,58,127,.95), rgba(110,231,255,.55), rgba(255,58,127,0));filter:blur(.2px);animation:maSweep 2.8s ease-in-out infinite;}
        .matelas-tabs__sub{margin:0;max-width:72ch;color:#475569;font-weight:750;font-size:13px;line-height:1.6;}
        .matelas-tabs__stats{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
        .matelas-tabs__stat{display:flex;flex-direction:column;align-items:flex-start;gap:6px;padding:12px 12px;border-radius:18px;background:rgba(255,255,255,.85);border:1px solid rgba(226,232,240,.95);font-weight:950;color:rgba(11,27,58,.92);font-size:12px;box-shadow:0 14px 34px rgba(2,6,23,.06);min-height:74px;}
        .matelas-tabs__stat strong{font-weight:1000;}
        .matelas-tabs__stat span{color:#64748b;font-weight:800;}
        .matelas-tabs__title{text-align:center;margin:14px 0 0;font-weight:1000;color:var(--ma-rose);letter-spacing:-.02em;font-size:14px;}
        .matelas-tabs__bar{display:flex;gap:10px;justify-content:center;flex-wrap:wrap;margin-top:12px;}
        .matelas-tab{border:0;background:#eef2ff;color:var(--ma-navy);font-weight:1000;border-radius:999px;padding:10px 14px;cursor:pointer;}
        .matelas-tab.is-active{background:var(--ma-rose);color:#fff;}
        .matelas-tabs__grid{margin-top:16px;display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;}
        .matelas-tabs__panel{display:none;}
        .matelas-tabs__panel.is-active{display:block;animation:maFadeUp .28s ease both;}

        .matelas-page .best-modern__grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;}

        .matelas-modal{position:fixed;inset:0;display:flex;align-items:flex-end;justify-content:center;z-index:60;opacity:0;visibility:hidden;pointer-events:none;transition:opacity .22s ease, visibility 0s linear .22s;}
        .matelas-modal.is-open{opacity:1;visibility:visible;pointer-events:auto;transition:opacity .22s ease;}
        .matelas-modal__backdrop{position:absolute;inset:0;background:rgba(2,6,23,.55);backdrop-filter: blur(6px);opacity:0;transition:opacity .22s ease;}
        .matelas-modal.is-open .matelas-modal__backdrop{opacity:1;}
        .matelas-modal__panel{position:relative;width:min(860px, calc(100% - 24px));margin:12px 12px 18px;border-radius:24px;overflow:hidden;background:#fff;border:1px solid var(--ma-border);box-shadow:0 30px 90px rgba(0,0,0,.28);}
        .matelas-modal__panel{transform:translateY(18px) scale(.985);opacity:0;transition:transform .24s ease, opacity .24s ease;}
        .matelas-modal.is-open .matelas-modal__panel{transform:translateY(0) scale(1);opacity:1;}
        .matelas-modal__bar{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:14px 16px;background:linear-gradient(135deg,rgba(255,58,127,.10),rgba(11,27,58,.10));border-bottom:1px solid var(--ma-border);}
        .matelas-modal__title{font-weight:1000;color:var(--ma-ink);margin:0;font-size:14px;}
        .matelas-modal__close{border:0;background:#fff;color:var(--ma-navy);font-weight:1000;border-radius:999px;padding:10px 12px;cursor:pointer;border:1px solid var(--ma-border);}
        .matelas-modal__content{display:grid;grid-template-columns:1fr 1fr;gap:14px;padding:16px;}
        .matelas-modal__media{border-radius:18px;overflow:hidden;border:1px solid var(--ma-border);background:linear-gradient(135deg,#f8fafc,#fff);}
        .matelas-modal__media img{width:100%;height:100%;object-fit:cover;display:block;aspect-ratio: 4 / 3;}
        .matelas-modal__form{display:grid;gap:10px;align-content:start;}
        .matelas-field label{display:block;font-weight:950;color:var(--ma-navy);font-size:12px;margin-bottom:6px;}
        .matelas-select{width:100%;border:1px solid var(--ma-border);border-radius:14px;padding:12px 12px;font-weight:800;color:var(--ma-ink);background:#fff;}
        .matelas-modal__cta{display:flex;gap:10px;flex-wrap:wrap;margin-top:4px;}
        .matelas-modal__hint{color:#64748b;font-weight:800;font-size:12px;margin:0;}
        .matelas-modal__price{font-weight:1000;color:var(--ma-ink);font-size:18px;}

        .matelas-chip.is-active{border-color:rgba(255,58,127,.45);box-shadow:0 12px 24px rgba(255,58,127,.14);}

        .matelas-all{padding:40px 0 58px;}
        .matelas-all__head{position:relative;margin-bottom:16px;padding:26px 18px;border-radius:26px;background:linear-gradient(180deg, rgba(11,27,58,.08), rgba(11,27,58,0));border:1px solid rgba(226,232,240,.92);overflow:hidden;}
        .matelas-all__head::before{content:"";position:absolute;inset:-2px;background:radial-gradient(760px 260px at 18% 30%, rgba(255,58,127,.16), rgba(255,58,127,0) 60%), radial-gradient(760px 320px at 82% 20%, rgba(110,231,255,.14), rgba(110,231,255,0) 62%);pointer-events:none;}
        .matelas-all__head::after{content:"TOUS";position:absolute;left:18px;top:12px;font-weight:1000;letter-spacing:.20em;text-transform:uppercase;font-size:62px;line-height:1;color:rgba(11,27,58,.06);pointer-events:none;}
        .matelas-all__head > *{position:relative;}
        .matelas-all__kicker{display:inline-flex;align-items:center;gap:8px;font-weight:1000;letter-spacing:.12em;text-transform:uppercase;font-size:11px;color:rgba(11,27,58,.68);}
        .matelas-all__kicker i{width:8px;height:8px;border-radius:999px;background:linear-gradient(135deg,var(--ma-rose),rgba(110,231,255,.95));display:inline-block;}
        .matelas-all__title{font-size:34px;font-weight:1000;letter-spacing:-.05em;color:var(--ma-ink);margin:10px 0 8px;line-height:1.02;}
        .matelas-all__title span{background:linear-gradient(135deg,var(--ma-navy),#0b1b3a 35%, var(--ma-rose));-webkit-background-clip:text;background-clip:text;color:transparent;}
        .matelas-all__title::after{content:"";display:block;height:4px;width:min(320px, 80%);margin:12px 0 0;border-radius:999px;background:linear-gradient(90deg, rgba(255,58,127,0), rgba(255,58,127,.95), rgba(110,231,255,.55), rgba(255,58,127,0));filter:blur(.2px);animation:maSweep 2.8s ease-in-out infinite;}
        .matelas-all__desc{color:var(--ma-muted);font-weight:750;margin:8px 0 0;max-width:70ch;}
        .matelas-all__stats{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px;}
        .matelas-all__stat{display:inline-flex;align-items:center;gap:8px;padding:9px 12px;border-radius:999px;background:#fff;border:1px solid rgba(226,232,240,.95);font-weight:950;color:rgba(11,27,58,.92);font-size:12px;box-shadow:0 14px 34px rgba(2,6,23,.06);}
        .matelas-all__stat strong{font-weight:1000;}

        .matelas-all__grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;margin-top:18px;}
        .matelas-mini{background:#fff;border:1px solid #e2e8f0;border-radius:22px;overflow:hidden;display:flex;flex-direction:column;min-height:310px;transition:transform .18s ease, box-shadow .18s ease;}
        .matelas-mini:hover{transform:translateY(-2px);box-shadow:0 18px 40px rgba(2,6,23,.08);}
        .matelas-mini__media{aspect-ratio: 1.1 / 1;background:linear-gradient(135deg,#f8fafc,#fff);}
        .matelas-mini__media img{width:100%;height:100%;object-fit:cover;display:block;}
        .matelas-mini__body{padding:14px 14px 16px;display:flex;flex-direction:column;gap:10px;flex:1;}
        .matelas-mini__name{font-weight:1000;color:#0b1220;margin:0;font-size:14px;line-height:1.15;}
        .matelas-mini__meta{color:#64748b;font-weight:700;font-size:12px;line-height:1.25;margin:0;min-height:30px;}
        .matelas-mini__footer{margin-top:auto;display:flex;align-items:center;justify-content:space-between;gap:10px;}
        .matelas-mini__price{font-weight:1000;color:var(--ma-ink);font-size:16px;}
        .matelas-mini__footer form{margin:0;}
        .matelas-mini__add{position:relative;isolation:isolate;display:inline-flex;align-items:center;gap:10px;padding:10px 14px;border-radius:999px;background:linear-gradient(135deg, var(--ma-rose), #ff2e72);color:#fff;font-weight:1000;border:0;cursor:pointer;box-shadow:0 18px 44px rgba(255,58,127,.26);overflow:hidden;}
        .matelas-mini__add::after{content:"+";display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:999px;background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.22);font-weight:1000;line-height:1;}
        .matelas-mini__add::before{content:"";position:absolute;inset:-40% -60%;background:linear-gradient(120deg, rgba(255,255,255,0) 0%, rgba(255,255,255,.34) 45%, rgba(255,255,255,0) 70%);transform:translateX(-55%) rotate(8deg);opacity:.0;transition:opacity .22s ease, transform .55s ease;z-index:-1;}
        .matelas-mini__add:hover{filter:saturate(1.06);box-shadow:0 20px 52px rgba(255,58,127,.32);}
        .matelas-mini__add:hover::before{opacity:.9;transform:translateX(55%) rotate(8deg);}
        .matelas-mini__add:active{transform:translateY(1px);}

        @keyframes maFadeUp{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}

        @media (max-width: 991px){
            .matelas-hero{padding:110px 0 86px;min-height:460px;}
            .matelas-hero__title{font-size:36px;}
            .matelas-section__grid{grid-template-columns:1fr;}
            .matelas-all__grid{grid-template-columns:repeat(2,minmax(0,1fr));}
            .matelas-modal__content{grid-template-columns:1fr;}
            .matelas-tabs__grid{grid-template-columns:repeat(2,minmax(0,1fr));}
            .matelas-banner__grid{grid-template-columns:1fr;}
            .matelas-cloud--a{top:70px;}
            .matelas-cloud--b{top:44px;}
            .matelas-page .best-modern__grid{grid-template-columns:repeat(2,minmax(0,1fr));}
        }
        @media (max-width: 520px){
            .matelas-hero{padding:96px 0 66px;min-height:420px;}
            .matelas-hero__title{font-size:30px;}
            .matelas-all__grid{grid-template-columns:1fr;}
            .matelas-tabs__grid{grid-template-columns:1fr;}
            .matelas-page .best-modern__grid{grid-template-columns:1fr;}
            .matelas-block__head{padding:36px 14px 18px;}
            .matelas-block__head::after{font-size:46px;}
            .matelas-marquee{top:10px;height:28px;}
            .matelas-block__title{font-size:34px;}
            .matelas-cloud{transform:none !important;}
            .matelas-cloud--c,.matelas-cloud--d{display:none;}
            .matelas-all__head{padding:22px 14px;}
            .matelas-all__head::after{font-size:44px;}
            .matelas-all__title{font-size:28px;}
            .matelas-tabs__head{padding:22px 12px 12px;}
            .matelas-tabs__head::after{font-size:44px;}
            .matelas-tabs__headgrid{grid-template-columns:1fr;}
            .matelas-tabs__hero{font-size:30px;}
            .matelas-tabs__stats{grid-template-columns:1fr;}
        }
        @media (prefers-reduced-motion: reduce){
            .matelas-orb--a,.matelas-orb--b,.matelas-block__title::after,.matelas-marquee__track,.matelas-cloud{animation:none !important;}
            .matelas-banner__title::after{animation:none !important;}
            .matelas-all__title::after{animation:none !important;}
            .matelas-tabs__hero::after{animation:none !important;}
            [data-reveal]{opacity:1 !important;transform:none !important;filter:none !important;transition:none !important;}
            .matelas-mini__add::before{transition:none !important;}
            .matelas-tabs__panel.is-active{animation:none !important;}
            .matelas-modal, .matelas-modal__backdrop, .matelas-modal__panel{transition:none !important;}
        }
    </style>

    <div class="matelas-page">
        <section class="matelas-hero" aria-label="{{ $pageTitle }}">
            <div class="matelas-clouds" aria-hidden="true">
                <span class="matelas-cloud matelas-cloud--a"></span>
                <span class="matelas-cloud matelas-cloud--b"></span>
                <span class="matelas-cloud matelas-cloud--c"></span>
                <span class="matelas-cloud matelas-cloud--d"></span>
            </div>
            <div class="container">
                <div class="matelas-hero__inner" data-reveal>
                    <h1 class="matelas-hero__title">Quatre Modèles,<br>Un sommeil meilleur</h1>
                    <p class="matelas-hero__subtitle">Choisis le niveau de fermeté qui te correspond. Puis sélectionne l’épaisseur et le nombre de places pour commander.</p>

                    <div class="matelas-hero__cta">
                        <a class="matelas-btn matelas-btn--primary" href="#petit-prix">Nos matelas à petit prix</a>
                        <a class="matelas-btn matelas-btn--navy" href="#differents">Nos différents matelas</a>
                    </div>
                </div>
            </div>
        </section>

        @php
            $allMatelas = collect($matelasCategoryGroups ?? [])->flatMap(function ($g) {
                return $g['products'] ?? [];
            })->filter()->unique('id')->values();

            $priceFor = function ($p) {
                $v = $p?->variants?->sortBy('price')->first();
                return $v?->price ?? $p?->price;
            };

            $cheapMatelas = $allMatelas->sortBy(function ($p) use ($priceFor) {
                return (float) ($priceFor($p) ?? 0);
            })->take(6)->values();
        @endphp

        <section class="matelas-block" id="petit-prix" aria-label="Nos matelas à petit prix">
            <div class="container">
                <div class="matelas-block__head" data-reveal>
                    <span class="matelas-orb matelas-orb--a" aria-hidden="true"></span>
                    <span class="matelas-orb matelas-orb--b" aria-hidden="true"></span>
                    <div class="matelas-marquee" aria-hidden="true">
                        <div class="matelas-marquee__track">
                            <span class="matelas-marquee__item"><span class="matelas-marquee__dot"></span>CONFORT</span>
                            <span class="matelas-marquee__item"><span class="matelas-marquee__dot"></span>SOUTIEN</span>
                            <span class="matelas-marquee__item"><span class="matelas-marquee__dot"></span>PETIT PRIX</span>
                            <span class="matelas-marquee__item"><span class="matelas-marquee__dot"></span>AJOUT RAPIDE</span>
                            <span class="matelas-marquee__item"><span class="matelas-marquee__dot"></span>CONFORT</span>
                            <span class="matelas-marquee__item"><span class="matelas-marquee__dot"></span>SOUTIEN</span>
                            <span class="matelas-marquee__item"><span class="matelas-marquee__dot"></span>PETIT PRIX</span>
                            <span class="matelas-marquee__item"><span class="matelas-marquee__dot"></span>AJOUT RAPIDE</span>
                        </div>
                    </div>
                    <span class="matelas-block__pill">Nos matelas à petit prix</span>
                    @php
                        $cheapMinPrice = $cheapMatelas->min(function ($p) use ($priceFor) {
                            return (float) ($priceFor($p) ?? 0);
                        });
                        $cheapCount = (int) ($cheapMatelas?->count() ?? 0);
                    @endphp
                    <h2 class="matelas-block__title"><span class="matelas-block__outline">Le confort</span> <span>au prix</span> qui fait plaisir</h2>
                    <p class="matelas-block__subtitle">Des modèles sélectionnés pour t’offrir un excellent soutien, au meilleur prix. Ajoute au panier en 2 clics, puis choisis l’épaisseur et le nombre de places.</p>
                    <div class="matelas-block__stats" role="list" aria-label="Points forts">
                        <span class="matelas-stat" role="listitem"><i aria-hidden="true"></i><strong>Dès</strong> {{ $cheapMinPrice ? number_format((float) $cheapMinPrice, 0, ',', '.') . 'F' : '—' }}</span>
                        <span class="matelas-stat" role="listitem"><i aria-hidden="true"></i><strong>Ajout</strong> en 2 clics</span>
                        <span class="matelas-stat" role="listitem"><i aria-hidden="true"></i><strong>{{ $cheapCount }}</strong> best deals</span>
                    </div>
                    <div class="matelas-block__cta">
                        <a class="matelas-btn matelas-btn--primary" href="#differents">Voir les 4 modèles</a>
                        <a class="matelas-btn matelas-btn--navy" href="#tous">Tous les matelas</a>
                    </div>
                </div>

                <section class="best-modern" aria-label="Nos matelas à petit prix">
                    <div class="best-modern__grid">
                        @foreach($cheapMatelas as $product)
                            @php
                                $img = $product->image;
                                $defaultVariant = $product?->variants?->sortBy('price')->first();
                                $price = $product?->price;
                                $titleVariant = ($product?->variants ?? collect())
                                    ->filter(fn ($v) => $v && $v->price !== null)
                                    ->sortBy(fn ($v) => abs(((float) $v->price) - ((float) ($price ?? 0))))
                                    ->first();
                                $displayName = $product->name;
                                if ($titleVariant && $titleVariant->places && $titleVariant->thickness_cm) {
                                    $placesValue = (float) $titleVariant->places;
                                    $placesLabel = fmod($placesValue, 1.0) === 0.0
                                        ? (string) (int) $placesValue
                                        : str_replace('.', ',', number_format($placesValue, 1, '.', ''));
                                    $displayName = $product->name
                                        . ' - '
                                        . str_pad((string) $placesLabel, 2, '0', STR_PAD_LEFT)
                                        . ' places épasseurs '
                                        . (int) $titleVariant->thickness_cm
                                        . ' CM';
                                }
                                $variantsData = ($product?->variants ?? collect())->map(fn($v) => [
                                    'id' => (int) $v->id,
                                    'thickness_cm' => $v->thickness_cm,
                                    'places' => $v->places,
                                    'price' => (float) $v->price,
                                    'stock' => $v->stock,
                                ])->values();
                            @endphp

                            <article class="product-card" aria-label="{{ $product->name }}">
                                @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                                    <div class="product-card__badge">-{{ (int) $product->discount_percent }}%</div>
                                @elseif(!empty($product->badge_type) && $product->badge_type === 'new')
                                    <div class="product-card__badge product-card__badge--new">NEW</div>
                                @elseif(!empty($product->badge_type) && $product->badge_type === 'hot')
                                    <div class="product-card__badge product-card__badge--hot">HOT</div>
                                @endif

                                <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                    <div class="product-card__media">
                                        <img src="@image_url($img)" alt="{{ $product->name }}" loading="lazy" />
                                    </div>
                                </a>

                                <div class="product-card__body">
                                    <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                        <h3 class="product-card__name">{{ $displayName }}</h3>
                                    </a>
                                    <div class="product-card__footer">
                                        <div class="product-card__prices">
                                            <span class="product-card__price">{{ $price !== null ? number_format((float) $price, 0, ',', '.') . 'F' : '' }}</span>
                                            @if(!empty($product->formatted_old_price))
                                                <span class="product-card__old">{{ $product->formatted_old_price }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <form action="{{ route('cart.add') }}" method="POST" class="product-card__cta" style="margin:0">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="product-card__buy" type="submit">Ajouter au panier</button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <div style="display:flex;justify-content:center;margin-top:14px;">
                    <a class="matelas-btn matelas-btn--navy" href="#tous">Charger</a>
                </div>
            </div>
        </section>

        @php
            $supportPick = $allMatelas->first(function ($p) {
                $name = \Illuminate\Support\Str::lower((string) ($p->name ?? ''));
                $firm = \Illuminate\Support\Str::lower((string) ($p->firmness ?? ''));
                return str_contains($name, 'medicosoins') || $firm === 'medicosoins';
            }) ?: $allMatelas->first();

            $supportDefaultVariant = $supportPick?->variants?->sortBy('price')->first();
            $supportPrice = $supportDefaultVariant?->price ?? $supportPick?->price;
            $supportVariantsData = ($supportPick?->variants ?? collect())->map(fn($v) => [
                'id' => (int) $v->id,
                'thickness_cm' => $v->thickness_cm,
                'places' => $v->places,
                'price' => (float) $v->price,
                'stock' => $v->stock,
            ])->values();

            $supportTag = $supportPick?->firmness ? strtoupper(str_replace('_', '-', (string) $supportPick->firmness)) : null;
        @endphp

        @if($supportPick)
            <section class="matelas-banner" aria-label="Le soutien qui prend soin de votre dos">
                <div class="container">
                    <div class="matelas-banner__grid">
                        <div class="matelas-banner__card" data-reveal>
                            <div class="matelas-banner__eyebrow"><i aria-hidden="true"></i>Le soutien qui change tes nuits</div>
                            <h2 class="matelas-banner__title"><strong>Soutien</strong> & confort, pour ton dos</h2>
                            <p class="matelas-banner__desc">{{ $supportPick->short_description ?: 'Un maintien optimal pour soulager les tensions, améliorer la posture et retrouver un sommeil réparateur.' }}</p>

                            <div class="matelas-banner__meta">
                                @php
                                    $supportBadges = collect([
                                        $supportTag ? (string) $supportTag : null,
                                        !empty($supportPick->material) ? (string) $supportPick->material : null,
                                        !empty($supportPick->reviews_count) ? ((int) $supportPick->reviews_count) . ' avis' : null,
                                    ])->filter()->take(2)->values();
                                @endphp
                                @foreach($supportBadges as $b)
                                    <span class="matelas-badge">{{ $b }}</span>
                                @endforeach
                            </div>

                            <div class="matelas-banner__cta">
                                <button
                                    class="matelas-btn matelas-btn--primary"
                                    type="button"
                                    data-quick-add
                                    data-product-id="{{ $supportPick->id }}"
                                    data-product-name="{{ e($supportPick->name) }}"
                                    data-product-image="@image_url($supportPick->image)"
                                    data-product-slug="{{ $supportPick->slug }}"
                                    data-default-variant-id="{{ $supportDefaultVariant?->id }}"
                                    data-variants='@json($supportVariantsData)'
                                >Commander</button>

                                <button
                                    class="matelas-btn matelas-btn--navy"
                                    type="button"
                                    data-quick-add
                                    data-product-id="{{ $supportPick->id }}"
                                    data-product-name="{{ e($supportPick->name) }}"
                                    data-product-image="@image_url($supportPick->image)"
                                    data-product-slug="{{ $supportPick->slug }}"
                                    data-default-variant-id="{{ $supportDefaultVariant?->id }}"
                                    data-variants='@json($supportVariantsData)'
                                >Ajouter au panier</button>

                                <div class="matelas-banner__price">
                                    {{ $supportPrice !== null ? number_format((float) $supportPrice, 0, ',', '.') . 'F' : '' }}
                                </div>
                            </div>
                        </div>

                        <a class="matelas-banner__media" data-reveal href="{{ route('product.show', $supportPick->slug) }}" style="text-decoration:none;color:inherit">
                            <img src="@image_url($supportPick->image)" alt="{{ $supportPick->name }}" loading="lazy">
                        </a>
                    </div>
                </div>
            </section>
        @endif

        @php
            $tabDefs = [
                ['key' => 'medicosoins', 'label' => 'MEDICOSOINS', 'tokens' => ['medicosoins']],
                ['key' => 'confort_soft', 'label' => 'CONFORT SOFT', 'tokens' => ['confort', 'soft']],
                ['key' => 'addict', 'label' => 'ADDICT', 'tokens' => ['addict']],
                ['key' => 'luxury', 'label' => 'LUXURY', 'tokens' => ['luxury']],
            ];
        @endphp

        <section class="matelas-tabs" id="differents" aria-label="Nos différents matelas">
            <div class="container">
                <div class="matelas-tabs__wrap">
                    @php
                        $tabsCount = (int) (collect($tabDefs)->count());
                        $modelsCount = (int) ($allMatelas?->count() ?? 0);
                    @endphp
                    <header class="matelas-tabs__head" data-reveal>
                        <div class="matelas-tabs__headgrid">
                            <div>
                                <div class="matelas-tabs__kicker"><i aria-hidden="true"></i>Nos différents matelas</div>
                                <h2 class="matelas-tabs__hero">Un <span>confort</span> pour chaque nuit</h2>
                                <p class="matelas-tabs__sub">Sélectionne une gamme, compare les modèles, puis ajoute au panier. Tu choisis ensuite l’épaisseur et le nombre de places.</p>
                            </div>
                            <div class="matelas-tabs__stats" role="list" aria-label="Indicateurs">
                                <div class="matelas-tabs__stat" role="listitem"><strong>{{ $tabsCount }} gammes</strong><span>un ressenti, une solution</span></div>
                                <div class="matelas-tabs__stat" role="listitem"><strong>{{ $modelsCount }} modèles</strong><span>disponibles dans le catalogue</span></div>
                                <div class="matelas-tabs__stat" role="listitem"><strong>Ajout rapide</strong><span>en 2 clics, sans friction</span></div>
                                <div class="matelas-tabs__stat" role="listitem"><strong>Choix précis</strong><span>épaisseur & places</span></div>
                            </div>
                        </div>
                    </header>
                    <div class="matelas-tabs__title">Parcourir les gammes</div>
                    <div class="matelas-tabs__bar" role="tablist">
                        @foreach($tabDefs as $idx => $tab)
                            <button class="matelas-tab{{ $idx === 0 ? ' is-active' : '' }}" type="button" data-tab="{{ $tab['key'] }}" role="tab" aria-selected="{{ $idx === 0 ? 'true' : 'false' }}" tabindex="{{ $idx === 0 ? '0' : '-1' }}">{{ $tab['label'] }}</button>
                        @endforeach
                    </div>

                    @foreach($tabDefs as $idx => $tab)
                        @php
                            $items = $allMatelas->filter(function ($p) use ($tab) {
                                $name = \Illuminate\Support\Str::lower((string) ($p->name ?? ''));
                                foreach (($tab['tokens'] ?? []) as $t) {
                                    if (!str_contains($name, \Illuminate\Support\Str::lower($t))) return false;
                                }
                                return true;
                            })->take(6)->values();
                        @endphp

                        <div class="matelas-tabs__panel{{ $idx === 0 ? ' is-active' : '' }}" data-tab-panel="{{ $tab['key'] }}" role="tabpanel">
                            <section class="best-modern" aria-label="{{ $tab['label'] }}">
                                <div class="best-modern__grid">
                                @foreach($items as $product)
                                    @php
                                        $img = !empty($product->image) ? asset($product->image) : 'https://via.placeholder.com/400x400?text=Produit';
                                        $defaultVariant = $product?->variants?->sortBy('price')->first();
                                        $price = $product?->price;
                                        $titleVariant = ($product?->variants ?? collect())
                                            ->filter(fn ($v) => $v && $v->price !== null)
                                            ->sortBy(fn ($v) => abs(((float) $v->price) - ((float) ($price ?? 0))))
                                            ->first();
                                        $displayName = $product->name;
                                        if ($titleVariant && $titleVariant->places && $titleVariant->thickness_cm) {
                                            $displayName = $product->name
                                                . ' - '
                                                . str_pad((string) (int) $titleVariant->places, 2, '0', STR_PAD_LEFT)
                                                . ' places épasseurs '
                                                . (int) $titleVariant->thickness_cm
                                                . ' CM';
                                        }
                                        $variantsData = ($product?->variants ?? collect())->map(fn($v) => [
                                            'id' => (int) $v->id,
                                            'thickness_cm' => $v->thickness_cm,
                                            'places' => $v->places,
                                            'price' => (float) $v->price,
                                            'stock' => $v->stock,
                                        ])->values();
                                    @endphp

                                    <article class="product-card" aria-label="{{ $product->name }}">
                                        @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                                            <div class="product-card__badge">-{{ (int) $product->discount_percent }}%</div>
                                        @elseif(!empty($product->badge_type) && $product->badge_type === 'new')
                                            <div class="product-card__badge product-card__badge--new">NEW</div>
                                        @elseif(!empty($product->badge_type) && $product->badge_type === 'hot')
                                            <div class="product-card__badge product-card__badge--hot">HOT</div>
                                        @endif

                                        <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                            <div class="product-card__media">
                                                <img src="{{ $img }}" alt="{{ $product->name }}" loading="lazy" />
                                            </div>
                                        </a>

                                        <div class="product-card__body">
                                            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                                <h3 class="product-card__name">{{ $displayName }}</h3>
                                            </a>
                                            <div class="product-card__footer">
                                                <div class="product-card__prices">
                                                    <span class="product-card__price">{{ $price !== null ? number_format((float) $price, 0, ',', '.') . 'F' : '' }}</span>
                                                    @if(!empty($product->formatted_old_price))
                                                        <span class="product-card__old">{{ $product->formatted_old_price }}</span>
                                                    @endif
                                                </div>
                                                <form action="{{ route('cart.add') }}" method="POST" class="product-card__cta" style="margin:0">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button class="product-card__buy" type="submit">Ajouter au panier</button>
                                                </form>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                                </div>
                            </section>

                            <div style="display:flex;justify-content:center;margin-top:14px;">
                                <a class="matelas-btn matelas-btn--navy" href="#tous">Charger</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="matelas-all" id="tous" aria-label="Tous les matelas">
            <div class="container">
                @php $allCount = (int) (($products ?? collect())->count()); @endphp
                <div class="matelas-all__head" data-reveal>
                    <div class="matelas-all__kicker"><i aria-hidden="true"></i>Catalogue matelas</div>
                    <h2 class="matelas-all__title">Trouve <span>le bon</span> matelas</h2>
                    <p class="matelas-all__desc">Explore l’ensemble des modèles et trouve celui qui correspond à ton confort.</p>
                    <div class="matelas-all__stats" role="list" aria-label="Indicateurs">
                        <span class="matelas-all__stat" role="listitem"><strong>{{ $allCount }}</strong> modèles</span>
                        <span class="matelas-all__stat" role="listitem"><strong>Choix</strong> épaisseur & places</span>
                        <span class="matelas-all__stat" role="listitem"><strong>Ajout</strong> rapide au panier</span>
                    </div>
                </div>

                <div class="matelas-all__grid">
                    @foreach(($products ?? collect()) as $product)
                        @php
                            $specsParts = [];
                            if (!empty($product->size)) $specsParts[] = $product->size;
                            if (!empty($product->thickness)) $specsParts[] = 'Ép. ' . $product->thickness;
                            if (!empty($product->material)) $specsParts[] = $product->material;
                            $specs = implode(' • ', $specsParts);
                            $gridDefaultVariant = $product?->variants?->sortBy('price')->first();
                            $gridPrice = $gridDefaultVariant?->price ?? $product->price;
                        @endphp
                        <article class="matelas-mini" data-reveal>
                            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                <div class="matelas-mini__media">
                                    <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&h=700&fit=crop' }}" alt="{{ $product->name }}" loading="lazy" />
                                </div>
                            </a>
                            <div class="matelas-mini__body">
                                <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                    <h3 class="matelas-mini__name">{{ $product->name }}</h3>
                                </a>
                                <p class="matelas-mini__meta">{{ $specs ?: ($product->short_description ?: ' ') }}</p>
                                <div class="matelas-mini__footer">
                                    <div class="matelas-mini__price">{{ number_format((float) $gridPrice, 0, ',', '.') }}F</div>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="product_variant_id" value="{{ $gridDefaultVariant?->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="matelas-mini__add" type="submit">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if(method_exists($products, 'links'))
                    <div class="univers-pagination" style="margin-top: 22px">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </section>

        <div class="matelas-modal" id="matelasQuickAdd" aria-hidden="true">
            <div class="matelas-modal__backdrop" data-quick-close></div>
            <div class="matelas-modal__panel" role="dialog" aria-modal="true" aria-label="Ajouter au panier">
                <div class="matelas-modal__bar">
                    <p class="matelas-modal__title" id="quickTitle">Ajouter au panier</p>
                    <button class="matelas-modal__close" type="button" data-quick-close>Fermer</button>
                </div>
                <div class="matelas-modal__content">
                    <div class="matelas-modal__media"><img id="quickImage" alt="" src=""></div>
                    <div>
                        <form class="matelas-modal__form" action="{{ route('cart.add') }}" method="POST" id="quickForm">
                            @csrf
                            <input type="hidden" name="product_id" id="quickProductId" value="">
                            <input type="hidden" name="product_variant_id" id="quickVariantId" value="">
                            <input type="hidden" name="quantity" value="1">

                            <p class="matelas-modal__hint">Sélectionne une épaisseur et le nombre de places. Le prix se met à jour instantanément.</p>

                            <div class="matelas-field">
                                <label for="quickThickness">Épaisseur</label>
                                <select class="matelas-select" id="quickThickness"></select>
                            </div>

                            <div class="matelas-field">
                                <label for="quickPlaces">Places</label>
                                <select class="matelas-select" id="quickPlaces"></select>
                            </div>

                            <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
                                <div class="matelas-modal__price" id="quickPrice"></div>
                                <a class="matelas-link" id="quickLink" href="#">Voir le produit <span aria-hidden="true">→</span></a>
                            </div>

                            <div class="matelas-modal__cta">
                                <button class="matelas-btn matelas-btn--primary matelas-cartbtn" type="submit">Ajouter au panier</button>
                                <a class="matelas-btn matelas-btn--ghost" id="quickWhats" href="#" target="_blank" rel="noopener">Commander via WhatsApp</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function(){
            const tabButtons = Array.from(document.querySelectorAll('[data-tab]'));
            const tabPanels = Array.from(document.querySelectorAll('[data-tab-panel]'));
            tabButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const key = btn.getAttribute('data-tab');
                    tabButtons.forEach(b => {
                        const isActive = (b === btn);
                        b.classList.toggle('is-active', isActive);
                        b.setAttribute('aria-selected', isActive ? 'true' : 'false');
                        b.setAttribute('tabindex', isActive ? '0' : '-1');
                    });
                    tabPanels.forEach(p => p.classList.toggle('is-active', p.getAttribute('data-tab-panel') === key));
                });
            });

            const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const revealEls = Array.from(document.querySelectorAll('[data-reveal]'));
            if (revealEls.length) {
                if (prefersReduced || !('IntersectionObserver' in window)) {
                    revealEls.forEach(el => el.classList.add('is-revealed'));
                } else {
                    const io = new IntersectionObserver((entries, obs) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('is-revealed');
                                obs.unobserve(entry.target);
                            }
                        });
                    }, {root:null, rootMargin:'0px 0px -8% 0px', threshold:0.12});
                    revealEls.forEach(el => io.observe(el));
                }
            }

            const modal = document.getElementById('matelasQuickAdd');
            const form = document.getElementById('quickForm');
            const title = document.getElementById('quickTitle');
            const img = document.getElementById('quickImage');
            const pid = document.getElementById('quickProductId');
            const vid = document.getElementById('quickVariantId');
            const thick = document.getElementById('quickThickness');
            const places = document.getElementById('quickPlaces');
            const price = document.getElementById('quickPrice');
            const link = document.getElementById('quickLink');
            const whats = document.getElementById('quickWhats');

            let currentVariants = [];

            function money(v){
                try { return (Number(v) || 0).toLocaleString('fr-FR', {maximumFractionDigits:0}) + 'F'; } catch(e) { return v + 'F'; }
            }

            function uniq(arr){
                return Array.from(new Set(arr.filter(v => v !== null && v !== undefined && v !== '')));
            }

            function renderOptions(select, values, fmt){
                select.innerHTML = '';
                values.forEach(v => {
                    const opt = document.createElement('option');
                    opt.value = String(v);
                    opt.textContent = fmt ? fmt(v) : String(v);
                    select.appendChild(opt);
                });
            }

            function findVariant(th, pl){
                const t = th === null ? null : String(th);
                const p = pl === null ? null : String(pl);
                return currentVariants.find(v => String(v.thickness_cm) === t && String(v.places) === p) || null;
            }

            function syncFromSelection(){
                if (!currentVariants.length) {
                    vid.value = '';
                    price.textContent = '';
                    return;
                }

                let v = findVariant(thick.value, places.value);
                if (!v) {
                    const first = currentVariants[0];
                    renderOptions(thick, uniq(currentVariants.map(x => x.thickness_cm)).sort((a,b) => Number(a)-Number(b)), (x) => String(x) + ' cm');
                    renderOptions(places, uniq(currentVariants.map(x => x.places)).sort((a,b) => Number(a)-Number(b)), (x) => String(x) + ' places');
                    thick.value = String(first.thickness_cm);
                    places.value = String(first.places);
                    v = first;
                }

                vid.value = String(v.id);
                price.textContent = money(v.price);
            }

            function openModal(btn){
                const productId = btn.getAttribute('data-product-id');
                const productName = btn.getAttribute('data-product-name') || 'Produit';
                const productImage = btn.getAttribute('data-product-image') || '';
                const productSlug = btn.getAttribute('data-product-slug') || '';
                const variantsRaw = btn.getAttribute('data-variants') || '[]';

                try { currentVariants = JSON.parse(variantsRaw) || []; } catch(e) { currentVariants = []; }

                title.textContent = 'Ajouter — ' + productName;
                img.src = productImage;
                img.alt = productName;
                pid.value = productId || '';
                link.href = productSlug ? (window.location.origin + '/produit/' + productSlug) : '#';
                whats.href = 'https://wa.me/2250700000000?text=' + encodeURIComponent('Bonjour, je veux commander ' + productName + '.');

                if (!currentVariants.length) {
                    thick.innerHTML = '<option value="">—</option>';
                    places.innerHTML = '<option value="">—</option>';
                    vid.value = '';
                    price.textContent = '';
                } else {
                    const thicknesses = uniq(currentVariants.map(v => v.thickness_cm)).sort((a,b) => Number(a)-Number(b));
                    const placesList = uniq(currentVariants.map(v => v.places)).sort((a,b) => Number(a)-Number(b));
                    renderOptions(thick, thicknesses, (v) => String(v) + ' cm');
                    renderOptions(places, placesList, (v) => String(v) + ' places');
                    const cheapest = currentVariants.slice().sort((a,b) => Number(a.price)-Number(b.price))[0];
                    thick.value = String(cheapest.thickness_cm);
                    places.value = String(cheapest.places);
                    syncFromSelection();
                }

                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden','false');
            }

            function closeModal(){
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden','true');
            }

            document.addEventListener('click', (e) => {
                const btn = e.target.closest('[data-quick-add]');
                if (btn) {
                    e.preventDefault();
                    openModal(btn);
                    return;
                }
                if (e.target.closest('[data-quick-close]')) {
                    e.preventDefault();
                    closeModal();
                }
            });

            thick && thick.addEventListener('change', syncFromSelection);
            places && places.addEventListener('change', syncFromSelection);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
            });

            if (form) {
                form.addEventListener('submit', (e) => {
                    if (currentVariants.length && !vid.value) {
                        e.preventDefault();
                    }
                });
            }
        })();
    </script>
@else
    <section class="collection" aria-label="{{ $pageTitle }}">
        <div class="container">
            <div class="collection__header">
                <div class="collection__intro">
                    <span class="collection__badge">📌 Menu</span>
                    <h1 class="collection__title">{{ $pageTitle }}</h1>
                    <p class="collection__subtitle">Découvrez tous les produits disponibles pour cette rubrique.</p>
                </div>
            </div>

            @if(($products ?? collect())->isEmpty())
                <div style="padding:24px;border:1px solid #e2e8f0;border-radius:16px;background:#fff">
                    Aucun produit trouvé.
                </div>
            @endif

            <div class="collection__grid">
                @foreach(($products ?? collect()) as $product)
                    @php
                        $isFeatured = (bool) ($product->is_bestseller ?? false);
                        $tag = $product->firmness ? strtoupper(str_replace('_', '-', $product->firmness)) : null;
                        $specsParts = [];
                        if (!empty($product->size)) $specsParts[] = $product->size;
                        if (!empty($product->thickness)) $specsParts[] = 'Ép. ' . $product->thickness;
                        if (!empty($product->material)) $specsParts[] = $product->material;
                        $specs = implode(' • ', $specsParts);
                    @endphp

                    <article class="collection-card{{ $isFeatured ? ' collection-card--featured' : '' }}">
                        @if($isFeatured)
                            <div class="collection-card__badge">Best Seller</div>
                        @endif

                        <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                            <div class="collection-card__media">
                                <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=500&h=500&fit=crop' }}" alt="{{ $product->name }}" loading="lazy" />
                                @if($tag)
                                    <span class="collection-card__tag">{{ $tag }}</span>
                                @endif
                            </div>
                        </a>

                        <div class="collection-card__body">
                            <div class="collection-card__rating">
                                <span class="collection-card__stars">★★★★★</span>
                                <span class="collection-card__reviews">({{ (int) ($product->reviews_count ?? 0) }} avis)</span>
                            </div>

                            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                <h2 class="collection-card__name">{{ $product->name }}</h2>
                            </a>

                            @if($specs)
                                <p class="collection-card__specs">{{ $specs }}</p>
                            @else
                                <p class="collection-card__specs">&nbsp;</p>
                            @endif

                            <div class="collection-card__footer">
                                <span class="collection-card__price">{{ number_format((float) $product->price, 0, ',', '.') }}<small>F</small></span>

                                <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="collection-card__btn" type="submit" aria-label="Ajouter au panier">
                                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if(method_exists($products, 'links'))
                <div class="univers-pagination" style="margin-top: 24px">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>
@endif
@endsection
