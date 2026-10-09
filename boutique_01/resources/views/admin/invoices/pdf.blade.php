<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture {{ $invoice->number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #00234D;
            margin: 0;
            padding: 0;
        }
        .top-bar {
            background: #00234D;
            height: 8px;
            border-bottom: 3px solid #ec4899;
        }
        .container {
            padding: 30px 40px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .header-table td {
            vertical-align: middle;
            border: none;
            padding: 0;
        }
        .logo-box {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 16px;
            display: inline-block;
        }
        .logo-box img {
            height: 55px;
        }
        .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #00234D;
        }
        .company-tagline {
            color: #ec4899;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .invoice-title {
            font-size: 26px;
            font-weight: bold;
            color: #ec4899;
            text-align: right;
            letter-spacing: 2px;
        }
        .invoice-number {
            font-size: 13px;
            font-weight: bold;
            color: #00234D;
            text-align: right;
        }
        .invoice-date {
            font-size: 11px;
            color: #6b7280;
            text-align: right;
        }
        .header-divider {
            border-bottom: 2px solid #00234D;
            margin-bottom: 30px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .info-table td {
            width: 50%;
            vertical-align: top;
            border: none;
            padding: 0 10px 0 0;
        }
        .info-table td.last {
            padding: 0 0 0 10px;
        }
        .info-box {
            background: #f0f4f9;
            border-left: 4px solid #ec4899;
            padding: 15px;
            border-radius: 4px;
        }
        .info-box h3 {
            margin: 0 0 10px 0;
            font-size: 12px;
            color: #ec4899;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .info-box p {
            margin: 4px 0;
            color: #00234D;
        }
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table.items th {
            background: #00234D;
            color: #ffffff;
            padding: 10px 12px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        table.items th.right, table.items td.right {
            text-align: right;
        }
        table.items th.center, table.items td.center {
            text-align: center;
        }
        table.items td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            color: #00234D;
        }
        table.items tbody tr:nth-child(even) td {
            background: #fdf2f8;
        }
        .totals-table {
            width: 300px;
            border-collapse: collapse;
            margin-left: auto;
            margin-bottom: 30px;
        }
        .totals-table td {
            padding: 8px 12px;
            border: none;
            color: #00234D;
        }
        .totals-table .label {
            font-weight: bold;
            text-align: left;
        }
        .totals-table .value {
            font-weight: bold;
            text-align: right;
        }
        .totals-table tr.grand-total td {
            background: #00234D;
            color: #ffffff;
            font-size: 14px;
            padding: 12px;
        }
        .totals-table tr.grand-total td.value {
            color: #ec4899;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-paid {
            background: #ec4899;
            color: #ffffff;
        }
        .status-draft, .status-sent {
            background: #f0f4f9;
            color: #00234D;
            border: 1px solid #00234D;
        }
        .status-canceled {
            background: #ffffff;
            color: #dc2626;
            border: 1px solid #dc2626;
        }
        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #00234D;
            text-align: center;
            color: #6b7280;
            font-size: 10px;
        }
        .footer .brand {
            color: #ec4899;
            font-weight: bold;
        }
        .footer .social {
            color: #00234D;
        }
    </style>
</head>
<body>
    <div class="top-bar"></div>
    <div class="container">
        @php
            $logoPath = public_path('assets/logo/desktop/logo.png');
            $logoBase64 = is_file($logoPath)
                ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
                : null;
            $statusKey = strtolower((string) $invoice->status);
            $statusLabels = [
                'draft' => 'Brouillon',
                'sent' => 'Envoyée',
                'paid' => 'Payée',
                'canceled' => 'Annulée',
            ];
            $statusLabel = $statusLabels[$statusKey] ?? ucfirst((string) $invoice->status);
            $statusClass = in_array($statusKey, ['paid', 'draft', 'sent', 'canceled'], true) ? $statusKey : 'sent';
        @endphp

        <table class="header-table">
            <tr>
                <td style="width: 55%;">
                    @if($logoBase64)
                        <span class="logo-box"><img src="{{ $logoBase64 }}" alt="Mobilier Addict"></span>
                    @else
                        <div class="company-name">Mobilier Addict</div>
                    @endif
                    <div class="company-tagline" style="margin-top: 8px;">Mobilier, literie &amp; électroménager</div>
                </td>
                <td style="width: 45%;">
                    <div class="invoice-title">FACTURE</div>
                    <div class="invoice-number">{{ $invoice->number }}</div>
                    <div class="invoice-date">
                        Émise le {{ \Carbon\Carbon::parse($invoice->issued_at)->format('d/m/Y') }}
                    </div>
                    <div style="text-align: right; margin-top: 6px;">
                        <span class="status-badge status-{{ $statusClass }}">{{ $statusLabel }}</span>
                    </div>
                </td>
            </tr>
        </table>

        <div class="header-divider"></div>

        <table class="info-table">
            <tr>
                <td>
                    <div class="info-box">
                        <h3>Informations client</h3>
                        <p><strong>{{ trim($invoice->firstnames . ' ' . $invoice->lastname) }}</strong></p>
                        @if($invoice->phone)
                        <p>Téléphone : {{ $invoice->phone }}</p>
                        @endif
                        @if($invoice->whatsapp)
                        <p>WhatsApp : {{ $invoice->whatsapp }}</p>
                        @endif
                    </div>
                </td>
                <td class="last">
                    <div class="info-box">
                        <h3>Livraison</h3>
                        <p>{{ $invoice->delivery_place ?: 'À convenir' }}</p>
                        @if($invoice->delivery_day)
                        <p>Date : {{ \Carbon\Carbon::parse($invoice->delivery_day)->format('d/m/Y') }}</p>
                        @endif
                        @if($invoice->paid_at)
                        <p>Payée le : {{ \Carbon\Carbon::parse($invoice->paid_at)->format('d/m/Y') }}</p>
                        @endif
                    </div>
                </td>
            </tr>
        </table>

        <table class="items">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th class="right">Prix unitaire</th>
                    <th class="center">Quantité</th>
                    <th class="right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td class="right">{{ number_format($item->unit_price, 0, ',', '.') }} F</td>
                    <td class="center">{{ $item->quantity }}</td>
                    <td class="right">{{ number_format($item->line_total, 0, ',', '.') }} F</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals-table">
            <tr>
                <td class="label">Sous-total</td>
                <td class="value">{{ number_format($invoice->subtotal, 0, ',', '.') }} F</td>
            </tr>
            <tr>
                <td class="label">Frais de livraison</td>
                <td class="value">{{ number_format($invoice->shipping_amount, 0, ',', '.') }} F</td>
            </tr>
            <tr class="grand-total">
                <td class="label">TOTAL</td>
                <td class="value">{{ number_format($invoice->total, 0, ',', '.') }} F</td>
            </tr>
        </table>

        @if($invoice->details)
        <div class="info-box">
            <h3>Notes</h3>
            <p>{{ $invoice->details }}</p>
        </div>
        @endif

        <div class="footer">
            <p><span class="brand">Mobilier Addict</span> — Abidjan, Côte d'Ivoire</p>
            <p class="social">facebook.com/mobilier225 &nbsp;•&nbsp; instagram.com/mobiliermaison &nbsp;•&nbsp; linkedin.com/showcase/76503826</p>
            <p>Merci de votre confiance.</p>
        </div>
    </div>
</body>
</html>
