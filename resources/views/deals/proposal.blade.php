<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Teklif</title>
    <!-- Bu sürüm, DomPDF ile tam uyumlu: harici CSS & font yok, tüm stiller inline -->
    <style>
        /* ---------- FONTS & RESET ---------- */
        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            font-weight: 600;
        }

        p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
        }

        /* ---------- LAYOUT ---------- */
        .wrapper {
            padding: 20px 28px;
        }

        .header {
            background: #003d9c;
            color: #fff;
            border-radius: 6px 6px 0 0;
            padding: 24px;
            position: relative;
        }

        .header-logo {
            height: 50px;
        }

        .header .tax {
            position: absolute;
            right: 24px;
            top: 30px;
            font-weight: 500;
            font-size: 14px;
        }

        .section {
            margin-top: 24px;
        }

        .divider {
            height: 1px;
            background: #e4e6ef;
            margin: 24px 0;
        }

        /* ---------- INFO BLOCKS ---------- */
        .info-row {
            display: flex;
            justify-content: space-between;
        }

        .info-box {
            width: 48%;
        }

        .info-title {
            color: #003d9c;
            font-size: 14px;
            margin-bottom: 6px;
        }

        /* ---------- TABLE ---------- */
        .items thead th {
            background: #003d9c;
            color: #fff;
            font-size: 12px;
            text-transform: uppercase;
        }

        .items tbody td {
            border: 1px solid #dee2e6;
            font-size: 12px;
        }

        .items tfoot td {
            font-weight: 600;
            background: #f1f3f6;
        }

        /* ---------- FOOTER ---------- */
        .pay-notes {
            display: flex;
            justify-content: space-between;
            margin-top: 32px;
        }

        .pay {
            width: 48%;
        }

        .notes {
            width: 48%;
            background: #003d9c;
            color: #fff;
            padding: 12px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- HEADER -->
        <div class="header">
            <img src="{{ public_path('images/logo.png') }}" class="header-logo" alt="Logo">
            <div class="tax">Vergi No: {{ $deal->company->tax_number }}</div>
        </div>

        <!-- COMPANY & CONTACT -->
        <div class="section info-row">
            <div class="info-box">
                <h3 class="info-title">Şirket</h3>
                <p><strong>{{ $deal->company->name }}</strong></p>
                <p>{{ $deal->company->address }}</p>
                <p>Tel: {{ $deal->company->phone }}</p>
                <p>Tarih: {{ $deal->created_at->format('d.m.Y') }}</p>
            </div>
            <div class="info-box" style="margin-left:auto;text-align:right;">
                <h3 class="info-title">Muhatap</h3>
                <p><strong>{{ $deal->contact?->first_name }} {{ $deal->contact?->last_name }}</strong></p>
                <p>Tel: {{ $deal->contact?->phone }}</p>
                <p>E-mail: {{ $deal->contact?->email }}</p>
            </div>
        </div>

        <!-- ITEMS TABLE -->
        <div class="section">
            <table class="items">
                <thead>
                    <tr>
                        <th>Ürün / Hizmet</th>
                        <th style="width:60px;text-align:center;">Adet</th>
                        <th style="width:100px;text-align:right;">Birim Fiyat</th>
                        <th style="width:100px;text-align:right;">Toplam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deal->items ?? [] as $item)
                        <tr>
                            <td>{{ $item['name'] ?? '' }}</td>
                            <td style="text-align:center;">{{ $item['quantity'] ?? '' }}</td>
                            <td style="text-align:right;">
                                {{ isset($item['unit_price']) ? number_format($item['unit_price'], 2) . ' TL' : '' }}
                            </td>
                            <td style="text-align:right;">
                                {{ isset($item['quantity'], $item['unit_price']) ? number_format($item['quantity'] * $item['unit_price'], 2) . ' TL' : '' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align:right;">KDV Toplam</td>
                        <td style="text-align:right;">{{ number_format($deal->vat_total ?? 0, 2) }} TL</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="divider"></div>
        <div class="pay-notes">
            <div class="pay">
                <h4 class="info-title">Ödeme Bilgileri</h4>
                <p><strong>Banka:</strong> {{ $deal->bank_name }}</p>
                <p><strong>IBAN:</strong> {{ $deal->iban }}</p>
                <p><strong>E-mail:</strong> {{ $deal->contact_email }}</p>
            </div>
            <div class="notes">
                <h4 style="color:#fff;margin-bottom:6px;">Notlar</h4>
                <p style="color:#fff;">{{ $deal->notes }}</p>
            </div>
        </div>
    </div>
</body>

</html>
