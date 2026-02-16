@php
$brandName = config('app.name') ?: 'Mobilier Addict';
$blue = '#2563eb';
$pink = '#ec4899';
$text = '#0f172a';
$muted = '#64748b';
$bg = '#f8fafc';
$border = '#e2e8f0';
@endphp
<!doctype html>
<html lang="fr"><body style="margin:0;background:{{ $bg }};font-family:Arial,sans-serif;color:{{ $text }};">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="padding:24px 12px;background:{{ $bg }};"><tr><td align="center">
<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">
<tr><td style="padding:0 0 12px 0;font-weight:800;font-size:18px;color:{{ $blue }};">{{ $brandName }}<div style="height:4px;margin-top:10px;border-radius:999px;background:linear-gradient(90deg,{{ $pink }},{{ $blue }});"></div></td></tr>
<tr><td style="background:#fff;border:1px solid {{ $border }};border-radius:16px;padding:20px;">
@if(!empty($greeting))<h1 style="margin:0 0 10px 0;font-size:20px;">{{ $greeting }}</h1>@endif
@foreach($introLines as $line)<p style="margin:0 0 10px 0;color:{{ $muted }};font-size:14px;line-height:1.6;">{{ $line }}</p>@endforeach
@isset($actionText)
@php($btn = $level==='error' ? '#ef4444' : $blue)
<p style="margin:14px 0 6px 0;"><a href="{{ $actionUrl }}" style="display:inline-block;background:{{ $btn }};color:#fff;text-decoration:none;padding:12px 16px;border-radius:12px;font-weight:700;font-size:14px;">{{ $actionText }}</a></p>
<p style="margin:0;color:{{ $muted }};font-size:12px;line-height:1.6;">Lien direct : <a href="{{ $actionUrl }}" style="color:{{ $blue }};word-break:break-all;">{{ $actionUrl }}</a></p>
@endisset
@foreach($outroLines as $line)<p style="margin:10px 0 0 0;color:{{ $muted }};font-size:14px;line-height:1.6;">{{ $line }}</p>@endforeach
</td></tr>
</table></td></tr></table>
</body></html>
