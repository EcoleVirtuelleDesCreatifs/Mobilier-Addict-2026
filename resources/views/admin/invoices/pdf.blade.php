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
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
        }
        .invoice-number {
            font-size: 18px;
            font-weight: bold;
            color: #666;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        .info-box {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
        }
        .info-box h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #666;
        }
        .info-box p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            background: #333;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        .total-section {
            text-align: right;
            margin-top: 30px;
        }
        .total-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 10px;
        }
        .total-label {
            margin-right: 20px;
            font-weight: bold;
        }
        .total-value {
            font-weight: bold;
            font-size: 16px;
        }
        .grand-total {
            background: #333;
            color: white;
            padding: 15px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <div class="company-name">Mobilier Addict</div>
                <div>Votre partenaire mobilier</div>
            </div>
            <div class="invoice-number">FACTURE {{ $invoice->number }}</div>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <h3>Informations client</h3>
                <p><strong>Nom :</strong> {{ $invoice->lastname }} {{ $invoice->firstnames }}</p>
                <p><strong>Téléphone :</strong> {{ $invoice->phone }}</p>
                <p><strong>WhatsApp :</strong> {{ $invoice->whatsapp }}</p>
            </div>
            <div class="info-box">
                <h3>Détails facture</h3>
                <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($invoice->issued_at)->format('d/m/Y') }}</p>
                <p><strong>Statut :</strong> {{ ucfirst($invoice->status) }}</p>
                @if($invoice->paid_at)
                <p><strong>Payée le :</strong> {{ \Carbon\Carbon::parse($invoice->paid_at)->format('d/m/Y') }}</p>
                @endif
            </div>
        </div>

        @if($invoice->delivery_place)
        <div class="info-box" style="margin-bottom: 30px;">
            <h3>Lieu de livraison</h3>
            <p>{{ $invoice->delivery_place }}</p>
            @if($invoice->delivery_day)
            <p><strong>Jour de livraison :</strong> {{ \Carbon\Carbon::parse($invoice->delivery_day)->format('d/m/Y') }}</p>
            @endif
        </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ number_format($item->unit_price, 0, ',', '.') }}F</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->line_total, 0, ',', '.') }}F</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <span class="total-label">Sous-total :</span>
                <span class="total-value">{{ number_format($invoice->subtotal, 0, ',', '.') }}F</span>
            </div>
            <div class="total-row">
                <span class="total-label">Frais de livraison :</span>
                <span class="total-value">{{ number_format($invoice->shipping_amount, 0, ',', '.') }}F</span>
            </div>
            <div class="grand-total">
                <span class="total-label" style="color: white;">TOTAL :</span>
                <span class="total-value" style="color: white;">{{ number_format($invoice->total, 0, ',', '.') }}F</span>
            </div>
        </div>

        @if($invoice->details)
        <div class="info-box" style="margin-top: 30px;">
            <h3>Notes</h3>
            <p>{{ $invoice->details }}</p>
        </div>
        @endif

        <div class="footer">
            <p>Mobilier Addict - Votre satisfaction est notre priorité</p>
            <p>Contactez-nous pour toute question</p>
        </div>
    </div>
</body>
</html>
