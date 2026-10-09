@php
$configuredName = (string) (config('app.name') ?: '');
$brandName = trim($configuredName) !== '' && strtolower(trim($configuredName)) !== 'laravel'
    ? $configuredName
    : 'Mobilier Addict';
$blue = '#2563eb';
$pink = '#ec4899';
$text = '#0f172a';
$muted = '#64748b';
$bg = '#f8fafc';
$border = '#e2e8f0';
@endphp
<!doctype html>
<html lang="fr"><body style="margin:0;background:{{ $bg }};font-family:Arial,sans-serif;color:{{ $text }};">
<div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">
    {{ !empty($greeting) ? $greeting . ' ' : '' }}Votre accès {{ $brandName }} est prêt.
</div>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="padding:24px 12px;background:{{ $bg }};"><tr><td align="center">
<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">
<tr><td style="padding:0 0 12px 0;font-weight:900;font-size:20px;letter-spacing:.2px;color:{{ $blue }};">{{ $brandName }}<div style="height:4px;margin-top:10px;border-radius:999px;background:linear-gradient(90deg,{{ $pink }},{{ $blue }});"></div></td></tr>
<tr><td style="background:#fff;border:1px solid {{ $border }};border-radius:18px;padding:22px;">
@if(!empty($greeting))<h1 style="margin:0 0 10px 0;font-size:20px;">{{ $greeting }}</h1>@endif
@foreach($introLines as $line)<p style="margin:0 0 10px 0;color:{{ $muted }};font-size:14px;line-height:1.6;">{{ $line }}</p>@endforeach
@isset($actionText)
@php($btn = $level==='error' ? '#ef4444' : $blue)
<p style="margin:16px 0 8px 0;"><a href="{{ $actionUrl }}" style="display:inline-block;background:{{ $btn }};color:#fff;text-decoration:none;padding:12px 18px;border-radius:12px;font-weight:800;font-size:14px;">{{ $actionText }}</a></p>
<p style="margin:0;color:{{ $muted }};font-size:12px;line-height:1.6;">Lien direct : <a href="{{ $actionUrl }}" style="color:{{ $blue }};word-break:break-all;">{{ $actionUrl }}</a></p>
@endisset
@foreach($outroLines as $line)<p style="margin:10px 0 0 0;color:{{ $muted }};font-size:14px;line-height:1.6;">{{ $line }}</p>@endforeach
<div style="margin-top:16px;padding-top:14px;border-top:1px solid {{ $border }};color:{{ $muted }};font-size:12px;line-height:1.6;">
    Besoin d’aide ? Réponds simplement à cet email ou contacte-nous via <a href="{{ url('/') }}" style="color:{{ $blue }};text-decoration:none;">{{ url('/') }}</a>.
</div>
</td></tr>
</table></td></tr></table>
</body></html>
