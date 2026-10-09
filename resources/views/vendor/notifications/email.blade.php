@php
$configuredName = trim((string) config('app.name'));
$brandName = $configuredName !== '' && strtolower($configuredName) !== 'laravel' ? $configuredName : 'Mobilier Addict';
$navy = '#00234D';
$pink = '#ec4899';
$text = '#172033';
$muted = '#64748b';
$bg = '#f4f6f8';
$border = '#e4e9ef';
$logo = asset('assets/logo/desktop/logo-2.png');
$buttonColor = ($level ?? 'primary') === 'error' ? '#dc2626' : $pink;
@endphp
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $brandName }}</title>
</head>
<body style="margin:0;padding:0;background:{{ $bg }};font-family:Arial,Helvetica,sans-serif;color:{{ $text }};-webkit-text-size-adjust:100%;">
<div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">Une nouvelle information vous attend de la part de {{ $brandName }}.</div>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;background:{{ $bg }};">
    <tr>
        <td align="center" style="padding:32px 12px;">
            <table role="presentation" width="620" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:620px;">
                <tr>
                    <td align="center" style="background:{{ $navy }};padding:26px 24px;border-radius:22px 22px 0 0;border-bottom:5px solid {{ $pink }};">
                        <img src="{{ $logo }}" width="210" alt="{{ $brandName }}" style="display:block;width:210px;max-width:70%;height:auto;border:0;">
                    </td>
                </tr>
                <tr>
                    <td style="background:#ffffff;border:1px solid {{ $border }};border-top:0;padding:36px 38px 30px;">
                        @if(!empty($greeting))
                            <h1 style="margin:0 0 20px;color:{{ $navy }};font-size:24px;line-height:1.3;font-weight:800;">{{ $greeting }}</h1>
                        @endif

                        @foreach($introLines as $line)
                            <div style="margin:0 0 14px;color:{{ $text }};font-size:15px;line-height:1.7;">{{ $line }}</div>
                        @endforeach

                        @isset($actionText)
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin:26px 0;">
                                <tr>
                                    <td bgcolor="{{ $buttonColor }}" style="border-radius:999px;">
                                        <a href="{{ $actionUrl }}" style="display:inline-block;padding:14px 28px;color:#ffffff;text-decoration:none;font-size:14px;font-weight:800;letter-spacing:.02em;">{{ $actionText }}</a>
                                    </td>
                                </tr>
                            </table>
                        @endisset

                        @foreach($outroLines as $line)
                            <div style="margin:14px 0 0;color:{{ $text }};font-size:15px;line-height:1.7;">{{ $line }}</div>
                        @endforeach

                        @if(!empty($salutation))
                            <div style="margin-top:24px;color:{{ $navy }};font-size:15px;line-height:1.6;font-weight:700;white-space:pre-line;">{{ $salutation }}</div>
                        @else
                            <div style="margin-top:24px;color:{{ $navy }};font-size:15px;line-height:1.6;font-weight:700;">Bien cordialement,<br>L’équipe Mobilier Addict</div>
                        @endif
                    </td>
                </tr>

                @isset($actionText)
                    <tr>
                        <td style="background:#ffffff;border:1px solid {{ $border }};border-top:0;padding:0 38px 28px;">
                            <div style="border-top:1px solid {{ $border }};padding-top:20px;color:{{ $muted }};font-size:12px;line-height:1.6;">
                                Si le bouton ne fonctionne pas, copiez ce lien dans votre navigateur :<br>
                                <a href="{{ $actionUrl }}" style="color:{{ $pink }};word-break:break-all;text-decoration:none;">{{ $actionUrl }}</a>
                            </div>
                        </td>
                    </tr>
                @endisset

                @if(!empty($subcopy))
                    <tr>
                        <td style="padding:18px 28px;color:{{ $muted }};font-size:12px;line-height:1.6;">{{ $subcopy }}</td>
                    </tr>
                @endif

                <tr>
                    <td align="center" style="background:{{ $navy }};border-radius:0 0 22px 22px;padding:24px;color:rgba(255,255,255,.72);font-size:12px;line-height:1.7;">
                        <strong style="display:block;color:#ffffff;font-size:13px;margin-bottom:5px;">{{ $brandName }}</strong>
                        Abidjan, Côte d’Ivoire · <a href="tel:+2250799140356" style="color:#ffffff;text-decoration:none;">+225 07 99 14 03 56</a><br>
                        <a href="{{ url('/') }}" style="color:{{ $pink }};text-decoration:none;font-weight:700;">mobilier-addict.com</a>
                        <div style="margin-top:12px;color:rgba(255,255,255,.48);">© {{ date('Y') }} {{ $brandName }}. Tous droits réservés.</div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
